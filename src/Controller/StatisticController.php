<?php

namespace App\Controller;
use App\Entity\Statistic;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController
{
    /**
     * @Route("/statistic", name="statistic")
     */
    public function index(): Response
    {
        $statistic = $this->getDoctrine()->getRepository(Statistic::class)->findAll();
    
      $clients = $this->getDoctrine()->getRepository(Client::class)->findAll();  

        
        return $this->render('statistic/index.html.twig', [
            'statistic' => $statistic,
            'clients' => $clients,
            'title' => "Statistic"
        ]);
    }
}
