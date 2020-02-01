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
     * @param Request
     */
    public function addOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

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

        // agent
        $user = $this->getUser();

        // product
        $productRepository = $this->getDoctrine()->getManager()->getRepository(Produit::class);
        $product = $productRepository->find($id_product);

        // client
        $clientRepository = $this->getDoctrine()->getManager()->getRepository(Client::class);
        $client = $clientRepository->find($id_client);

        $em = $this->getDoctrine()->getManager();

        // create order
        $unit = $product->getPrixuProduit();
        $discount = $product->getDiscountProduit();
        $shipping = $product->getShippingcostProduit();

        $amount = ($unit - ($unit * $discount) +  $shipping) * $qty;

        $order = new Commande();
        $order->addProducts($product);
        $order->setIdAgent($user);
        $order->setDateCmd(Carbon::now());
        $order->setIdClient($client);
        $order->setMontantCmd($amount);
        $em->persist($order);
        $em->flush();

        // create LigneCommande to store qty
        $orderItem = new LigneCommande($order, $product, $qty);
        $em->persist($orderItem);
        $em->flush();

        $serializer = SerializerBuilder::create()->build();
        $jms = $serializer->serialize($order, 'json');

        return new JsonResponse($jms, Response::HTTP_ACCEPTED);
    }
}
