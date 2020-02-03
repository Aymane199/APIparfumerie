<?php


namespace App\Controller;


use App\Entity\Client;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Service\Tools;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;



/**
 * @Route("api/produit")
 */
class ProduitController extends AbstractController
{
    private $maxProductPerPage = 10;
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
     * @Route("", name="produits_filter",methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function filter(Request $request)
    {

        $dataJSON = json_decode($request->getContent(),true);
        if($dataJSON == null )
            $dataJSON['page'] = 0;
        if(!array_key_exists('page',$dataJSON))
            $dataJSON['page'] = 0;
        //remplir les champs non existant ( 'brand','search...) avec une valeur null
        $this->tools->fieldIfNotExist($dataJSON,['brand','search','gender','type']);

        //envoie de la requete
        $product = $this->produitRep
            ->getProduit_search_brand_gender_type($dataJSON['brand'],
                $dataJSON['search'],
                $dataJSON['gender'],
                $dataJSON['type']);
        //dd($product);
        $responseJSON['total'] = count($product);
        $responseJSON['page'] = $dataJSON['page'];
        $responseJSON['data'] =array_slice($product,($dataJSON['page'])*$this->maxProductPerPage,10);

        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($responseJSON, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

            return $response;
    }

    /**
     * @Route("/all", name="produits_filter_all",methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function getallfilter(Request $request)
    {

        $dataJSON = json_decode($request->getContent(),true);
        if($dataJSON == null )
            $dataJSON['page'] = 0;
        if(!array_key_exists('page',$dataJSON))
            $dataJSON['page'] =1;
        //remplir les champs non existant ( 'brand','search...) avec une valeur null
        $this->tools->fieldIfNotExist($dataJSON,['brand','search','gender','type']);

        //envoie de la requete
        $product = $this->produitRep
            ->getAllProduct_search_brand_gender_type($dataJSON['brand'],
                $dataJSON['search'],
                $dataJSON['gender'],
                $dataJSON['type']);
        $responseJSON['total'] = count($product);
        $responseJSON['page'] = $dataJSON['page'];
        $responseJSON['data'] =array_slice($product,($dataJSON['page'])*$this->maxProductPerPage,10);
        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($responseJSON, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if(is_null($data)) {
            return new JsonResponse([
                'error' => 'Body required'
            ], Response::HTTP_UNAUTHORIZED);
        }
        if(!array_key_exists('libelle_produit', $data)
            || !array_key_exists('marque', $data)
            || !array_key_exists('type', $data)
            || !array_key_exists('prixu_produit', $data)
            || !array_key_exists('discount_produit', $data)
            || !array_key_exists('url_produit', $data)
            || !array_key_exists('shippingcost_produit', $data)
            || !array_key_exists('profit_produit', $data)
            || !array_key_exists('attributes_produit', $data)
            || !array_key_exists('desc_produit', $data)) {
            return new JsonResponse([
                'error' => 'Attributes required'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $em = $this->getDoctrine()->getManager();
        $product=new Produit();

        $product->setLibelleProduit($data['libelle_produit'])
            ->setMarque($data['marque'])
            ->setType($data['type'])
            ->setPrixuProduit($data['prixu_produit'])
            ->setDiscountProduit($data['discount_produit'])
            ->setUrlProduit( $data['url_produit'])
            ->setShippingcostProduit($data['shippingcost_produit'])
            ->setProfitProduit($data['profit_produit'])
            ->setAttributesProduit($data['attributes_produit'])
            ->setDescProduit($data['desc_produit']);

        $em->persist($product);
        $em->flush();

        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($product, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/{idProduit}", name="getproduit", methods={"GET","POST"})
     * @param Produit $produit
     * @return Response
     */
    public function  getProduit(Request $request){

        $em = $this->getDoctrine()->getManager();
        $produit=$em->getRepository(Produit::class)->find($request->get('idProduit'));
        if(is_null($produit)) {
            return new JsonResponse([
                'error' => 'id not found'
            ], Response::HTTP_NOT_FOUND);
        }
        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($produit, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/{idProduit}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if(is_null($data)) {
            return new JsonResponse([
                'error' => 'Body required'
            ], Response::HTTP_UNAUTHORIZED);
        }
        if(!array_key_exists('libelle_produit', $data)
            || !array_key_exists('marque', $data)
            || !array_key_exists('type', $data)
            || !array_key_exists('prixu_produit', $data)
            || !array_key_exists('discount_produit', $data)
            || !array_key_exists('url_produit', $data)
            || !array_key_exists('shippingcost_produit', $data)
            || !array_key_exists('profit_produit', $data)
            || !array_key_exists('attributes_produit', $data)
            || !array_key_exists('desc_produit', $data)) {
            return new JsonResponse([
                'error' => 'Attributes required'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $em = $this->getDoctrine()->getManager();
        $product=$em->getRepository(Produit::class)->find($request->get('idProduit'));

        $product->setLibelleProduit($data['libelle_produit'])
            ->setMarque($data['marque'])
            ->setType($data['type'])
            ->setPrixuProduit($data['prixu_produit'])
            ->setDiscountProduit($data['discount_produit'])
            ->setUrlProduit( $data['url_produit'])
            ->setShippingcostProduit($data['shippingcost_produit'])
            ->setProfitProduit($data['profit_produit'])
            ->setAttributesProduit($data['attributes_produit'])
            ->setDescProduit($data['desc_produit']);

        $em->flush();
        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSproduct=$serializer->serialize($product, 'json');

        //construction de la response json
        $response = new Response($JMSproduct);
        $response->headers->set('Content-Type', 'application/json');

        return $response;

    }

    /**
     * @Route("/{idProduit}", name="produit_delete", methods={"DELETE"})
     */
    public function delete(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();
        $produit=$em->getRepository(Produit::class)->find($request->get('idProduit'));
        if(is_null($produit)) {
            return new JsonResponse([
                'error' => 'id not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $em->remove($produit);
        $em->flush();
        return new Response('delete success',Response::HTTP_OK);
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



}
