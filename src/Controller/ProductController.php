<?php


namespace App\Controller;


use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Service\Tools;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



/**
 * @Route("api/produit")
 */
class ProductController extends AbstractController
{

    private $produitRep;
    private  $serializer;
    private $tools;

    public function __construct(ProduitRepository  $produitRep,SerializerInterface $serializer,Tools $tools)
    {
        $this->produitRep=$produitRep;
        $this->serializer = $serializer;
        $this->tools = $tools;
    }

    /**
     * @Route("/", name="produits_filter")
     * @param Request $request
     * @return Response
     */
    public function filter(Request $request)
    {

        $dataJSON = json_decode($request->getContent(),true);

        if($dataJSON == null)
            $dataJSON['brand'] = null;

        //remplir les champs non existant ( 'brand','search...) avec une valeur null
        $this->tools->fieldIfNotExist($dataJSON,['brand','search','gender','type']);
        //dump($dataJSON);

        //envoie de la requete
        $product = $this->produitRep
            ->getProduit_search_brand_gender_type($dataJSON['brand'],
                $dataJSON['search'],
                $dataJSON['gender'],
                $dataJSON['type']);

        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($product, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

            return $response;
    }
    /**
     * @Route("/similar/{id}", name="produit_similaire")
     * @param Produit $produit
     * @return Response
     */
    public function  getSimilare(Produit $produit){
        //getsimilaire
        $produits = $this->produitRep->getSimilaires($produit);

        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($produits, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
     * @Route("/{id}", name="getproduit")
     * @param Produit $produit
     * @return Response
     */
    public function  getProduit(Produit $produit){

        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($produit, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }



}