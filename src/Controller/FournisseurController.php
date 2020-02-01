<?php


namespace App\Controller;


use App\Entity\Fournisseur;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class FournisseurController extends AbstractController
{

    private $serializer;
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/fournisseurs", name="fournisseur_show")
     */
    public function index()
    {
        $fournisseurRep = $this->getDoctrine()->getManager()
            ->getRepository(Fournisseur::class);
        $fournisseur  = $fournisseurRep->findAll();

        $serializer = SerializerBuilder::create()->build();
        $JMSfournisseur=$serializer->serialize($fournisseur , 'json');

        $response = new Response($JMSfournisseur);
            $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/fournisseur/create", name="fournisseur_create",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();
        dump($data);
        $fournisseur = $this->serializer->deserialize($data, 'App\Entity\Fournisseur', 'json');

        $em = $this->getDoctrine()->getManager();
        $em->persist($fournisseur);
        //$em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

}