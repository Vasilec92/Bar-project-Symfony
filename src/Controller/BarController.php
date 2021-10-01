<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Country;
use App\Entity\Like;
use App\Entity\User;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $likes = "";

        $hasAccess = $this->isGranted('ROLE_USER');
      

        if($hasAccess){
            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $likes = $this->getDoctrine()->getRepository(Like::class)->findByuser($user->getId());

        }
        dump($hasAccess);
        dump($likes);
        dump($beers);
        
        return $this->render('bar/index.html.twig', [
            'beers' => $beers,
            'likes' => $likes,
            'title' => "Page d'accueil"
        ]);
    }


     /**
     * @Route("/like/{id}", name="home_like")
     */
    public function like($id, EntityManagerInterface $entityManager): Response
    {
        $beers = $this->getDoctrine()->getRepository(Beer::class)->findAll();
        $beer = $this->getDoctrine()->getRepository(Beer::class)->find($id);

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $likes = $this->getDoctrine()->getRepository(Like::class)->findByuser($user->getId());
       
        $existant = false;
        foreach($likes as $value ){

            dump($value);
            if($user->getId() == $value->getUser()->getId() && $value->getBeer()->getId() == $id ){
                $existant = true;
            }
        }
        if(!$existant){
            $like = new Like();
            $like->setBeer($beer);
            $like->setUser($user);

            $entityManager->persist($like);
            $entityManager->flush();
        }else{

            $likeExistant = $this->getDoctrine()->getRepository(Like::class)->findByCorrespondance($user->getId() , $id );
            $entityManager->remove($likeExistant[0]);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
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
