<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\Entreprise;
use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('en');
        //Entreprise
        $entreprise = new Entreprise();
        $entreprise->setNomEntr($faker->company)
            ->setEmailEntr($faker->email)
            ->setWebsiteEntr($faker->domainName)
            ->setFbPage($faker->domainName)
            ->setLogoEntr('https://empiric-bats.000webhostapp.com/Image1.png')
            ;
        $manager->persist($entreprise);
        //Agent
        for($i = 0 ; $i<5 ;$i++) {
            $agent = new Agent();
            $manager->persist($agent);
        }
        //client
        for($i = 0 ; $i<50 ;$i++) {
            $client = new Client();
            $client->setNomClient($faker->firstName())
                ->setPrenomClient($faker->lastName)
                ->setAdresseClient($faker->address)
                ->setEmailClient($faker->email)
                ->setTelephoneClient($faker->phoneNumber);
            $manager->persist($client);
        }
        //fournisseur
        for($i = 0 ; $i<8 ;$i++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomFournisseur($faker->company);
            $manager->persist($fournisseur);
        }
        $manager->flush();
    }
}
