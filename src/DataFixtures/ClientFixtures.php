<?php

namespace App\DataFixtures;
use Faker;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ClientFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $count = 20;
         while($count > 0){
             $client = new Client;
             $client->setEmail($faker->email);
             $client->setWeight($faker->randomFloat(2, 1, 30));
             $client->setName($faker->name);
             $client->setNumberBeer($faker->randomDigit);
             $count--;
             $manager->persist($client);
         }

        $manager->flush();
    }
     public function getOrder(){

        return 4;
    }
}
