<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Fournisseur;
use App\Entity\LigneCommande;
use App\Entity\Produit;
use Carbon\Carbon;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("api/order");
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/add", name="add_order", methods={"POST"})
     * Create an order for a user
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function addOrder(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if(is_null($data)) {
            return new JsonResponse([
                'error' => 'Body required'
            ], Response::HTTP_UNAUTHORIZED);
        }
        // check attributes
        if(!array_key_exists('products', $data)
        || !array_key_exists('id_client', $data)) {
            return new JsonResponse([
                'error' => 'Attributes required'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $products = $data['products'];
        $id_client = $data['id_client'];
        // Agent
        $user = $this->getUser();

        // Product
        $productRepository = $this->getDoctrine()->getManager()->getRepository(Produit::class);

        // Client
        $clientRepository = $this->getDoctrine()->getManager()->getRepository(Client::class);
        $client = $clientRepository->find($id_client);
        if(is_null($client)) {
            return new JsonResponse([
                'error' => 'Client is not found'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $em = $this->getDoctrine()->getManager();

        // create order
        $order = new Commande($client, $user);

        // order add items
        foreach ($products as $pr) {

            $product = $productRepository->find($pr['id_produit']);
            if(is_null($product)) {
                return new JsonResponse([
                    'error' => 'Product '. $pr['id_produit'] .' not found'
                ], Response::HTTP_UNAUTHORIZED);
            }
            $qty = $pr['qty'];
            if($qty < 1) {
                return new JsonResponse([
                    'error' => 'Qty must be at least equal 1'
                ], Response::HTTP_UNAUTHORIZED);
            }

            $unit = $product->getPrixuProduit();
            $discount = $product->getDiscountProduit();
            $shipping = $product->getShippingcostProduit();
            $amount = ($unit - (($unit * $discount) / 100) +  $shipping) * $qty;

            $orderItem = new LigneCommande($order, $product, $qty);

            $order->setMontantCmd($amount);
            $order->addItem($orderItem);
        }

        $em->persist($order);
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $jms = $serializer->serialize($order, 'json');

        $response = new Response($jms);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
