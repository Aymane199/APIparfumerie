<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Commande;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AgentController extends AbstractController
{

    /**
     * @Route(name="api_login", path="/api/login_check")
     * @return JsonResponse
     */
    public function api_login(): JsonResponse
    {
        $user = $this->getUser();

        return new JsonResponse([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Route("/api/agent", name="agent", methods={"GET"})
     */
    public function index()
    {
        $agentRep = $this->getDoctrine()->getManager()
            ->getRepository(Agent::class);
        $agent = $agentRep->findAll();

        $arrayResponse['total'] = count($agent);
        $arrayResponse['agent'] = $agent;
        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSResponse=$serializer->serialize($arrayResponse, 'json');

        //construction de la response json
        $response = new Response($JMSResponse);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     * @Route("/api/agent/{idAgent}", name="agent_show", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function show(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $agent=$em->getRepository(Agent::class)->find($request->get('idAgent'));
        if(is_null($agent)) {
            return new JsonResponse([
                'error' => 'id not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $serializer = SerializerBuilder::create()->build();
        $JMSAgent=$serializer->serialize($agent, 'json');

        //construction de la response json
        $response = new Response($JMSAgent,Response::HTTP_CREATED);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    /**
     * @Route("/api/agent/{idAgent}/orders", name="show_orders", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function show_orders(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        //get orders by idAgent
        $orders=$em->getRepository(Commande::class)->findBy(array('idAgent' => $request->get('idAgent')), array('dateCmd' => 'ASC'));
        if(is_null($orders)) {
            return new JsonResponse([
                'error' => 'id not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $arrayResponse['total'] = count($orders);
        $arrayResponse['order'] = $orders;
        //serialisation
        $serializer = SerializerBuilder::create()->build();
        $JMSResponse=$serializer->serialize($arrayResponse, 'json');

        //construction de la response json
        $response = new Response($JMSResponse);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
