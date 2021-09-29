<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $beers = $this->getDoctrine()->getRepository(Beer::class)->findAll();

        return $this->render('bar/index.html.twig', [
            'beers' => $beers,
            'title' => "Page d'accueil"
        ]);
    }

    // L'injection de dépendance SF est capable de récupérer l'id et de le passer à l'entité, et il retournera une instance de Country correspondant à son ID, voir le composant SF installé pour cela sensio/framework-extra-bundle
    /**
     * @Route("/country/{id}", name="show_country_beer")
     */
    public function showBeerByCountry(Country $country): Response
    {
        // dump($country); die;

        return $this->render('country/index.html.twig', [
          'beers' => $country->getBeers() ?? [],
          'title' => $country->getName()
        ]);
    }
}
