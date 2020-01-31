<?php

namespace App\Controller;

use App\Entity\Agent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AgentController extends AbstractController
{

    /**
     * @Route("/agent", name="agent")
     */
    public function index()
    {
        $employeeRepository = $this->getDoctrine()->getManager()
            ->getRepository(Agent::class);
        $employee = $employeeRepository->findAll();
        dump($employee);
        return new Response('<html><body>response dump</body></html>');
    }
}
