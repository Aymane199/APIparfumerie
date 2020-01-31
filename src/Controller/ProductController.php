<?php


namespace App\Controller;


use App\Entity\Agent;
use App\Entity\Produit;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    /**
     * @Route("/api/produits", name="produit")
     */
    public function index()
    {
        $productRepository = $this->getDoctrine()->getManager()
            ->getRepository(Produit::class);
        $product = $productRepository->findAll();
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($product, 'json');
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }



}