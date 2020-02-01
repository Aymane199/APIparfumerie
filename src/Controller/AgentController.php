<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
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
     * @Route("/api/agents", name="agent")
     */
    public function index()
    {
        $employeeRepository = $this->getDoctrine()->getManager()
            ->getRepository(Agent::class);
        $employee = $employeeRepository->findAll();
        $serializer = SerializerBuilder::create()->build();
        $JMSemployee=$serializer->serialize($employee, 'json');
        dump($JMSemployee);
        return new Response('<html><body></body></html>');
    }

}
