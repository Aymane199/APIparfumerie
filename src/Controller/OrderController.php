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

class OrderController extends AbstractController
{
    /**
     * Create an order for a user
     * @Route("/api/order/add", name="add_order", methods={"POST"})
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
        if(!array_key_exists('id_produit', $data)
        && !array_key_exists('id_client', $data)
        && !array_key_exists('qty', $data)) {
            return new JsonResponse([
                'error' => 'Attributes required'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $id_product = $data['id_produit'];
        $id_client = $data['id_client'];
        $qty = $data['qty'];
        if($qty < 1) {
            return new JsonResponse([
                'error' => 'Qty must be at least equal 1'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // agent
        $user = $this->getUser();

        // product
        $productRepository = $this->getDoctrine()->getManager()->getRepository(Produit::class);
        $product = $productRepository->find($id_product);
        if(is_null($product)) {
            return new JsonResponse([
                'error' => 'Product is not found'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // client
        $clientRepository = $this->getDoctrine()->getManager()->getRepository(Client::class);
        $client = $clientRepository->find($id_client);
        if(is_null($client)) {
            return new JsonResponse([
                'error' => 'Client is not found'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $em = $this->getDoctrine()->getManager();

        // create order
        $unit = $product->getPrixuProduit();
        $discount = $product->getDiscountProduit();
        $shipping = $product->getShippingcostProduit();

        $amount = ($unit - (($unit * $discount) / 100) +  $shipping) * $qty;

        $order = new Commande();
        //$order->addItem($product);
        $order->setIdAgent($user);
        $order->setDateCmd(new \DateTime());
        $order->setIdClient($client);
        $order->setMontantCmd($amount);
        $em->persist($order);
        $em->flush();

        // create LigneCommande to store qty
        $orderItem = new LigneCommande($order, $product, $qty);
        $em->persist($orderItem);
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $jms = $serializer->serialize($orderItem, 'json');

        $response = new Response($jms);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
