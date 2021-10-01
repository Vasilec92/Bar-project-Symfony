<?php

namespace App\DataFixtures;
use App\Entity\Beer;
use App\Entity\Client;
use App\Entity\Statistic;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
class StatisticFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $beers = $manager->getRepository(Beer::class)->findAll();
        $client = $manager->getRepository(Client::class)->findAll();
        $count = 40;
       
        while($count > 0){
            $statistic = new Statistic();
            shuffle($beers); // mélange le tableau par référence
            shuffle($client);
            $statistic->setBeerId($beers[0]);
            $statistic->setClientId($client[0]);
            $count--;
            $manager->persist($statistic);
        }
        

        $manager->flush();
    }

     public function getOrder(){
        return 5;
    }
}
