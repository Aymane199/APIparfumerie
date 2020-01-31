<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Client;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AgentController extends AbstractController
{

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
