<?php


namespace App\Controller;


use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Service\Tools;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("api/client")
 */
class ClientController extends AbstractController
{

    private $serializer;
    private $clientRep;
    private $tools;
    public function __construct(SerializerInterface $serializer,ClientRepository $clientRep ,Tools $tools)
    {
        $this->serializer = $serializer;
        $this->clientRep = $clientRep;
        $this->tools=$tools;
    }
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $dataJSON = json_decode($request->getContent(),true);

        //remplir les champs non existantes ( 'search'...) avec la valeur null
        $this->tools->fieldIfNotExist($dataJSON,['search']);

        //get client from db
        $clients = $this->clientRep->getClient_search($dataJSON['search']);

        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($clients, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    /**
     * @Route("/new", name="client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $data = $request->getContent();
        $client = $this->serializer->deserialize($data, 'App\Entity\Client', 'json');
        //dump($client);

        $em = $this->getDoctrine()->getManager();
        $em->persist($client );
        $em->flush();

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @Route("/{idClient}", name="client_show", methods={"GET"})
     */
    public function show(Client $client): Response
    {}

    /**
     * @Route("/{idClient}/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $client=$em->getRepository(Client::class)->find($request->get('idClient'));
        $client->setNomClient($data['nom_client'])
            ->setPrenomClient($data['prenom_client'])
            ->setEmailClient($data['email_client'])
            ->setTelephoneClient( $data['telephone_client'])
            ->setCountryClient($data['country_client'])
            ->setZipCodeClient($data['zip_code_client'])
            ->setAdresseClient($data['adresse_client']);

        $em->flush();

        return new Response('', Response::HTTP_OK);

    }

    /**
     * @Route("/{idClient}", name="client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Client $client): Response
    {

    }




}