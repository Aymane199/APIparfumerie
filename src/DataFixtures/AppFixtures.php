<?php

namespace App\DataFixtures;

use App\Entity\Agent;
use App\Entity\Client;
use App\Entity\Entreprise;
use App\Entity\Fournisseur;
use App\Entity\Produit;
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
                ->setTelephoneClient($faker->phoneNumber)
                ->setZipCodeClient($faker->randomNumber(5))
                ->setCountryClient($faker->country);
            $manager->persist($client);
        }
        //fournisseur
        for($i = 0 ; $i<8 ;$i++) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomFournisseur($faker->company)
                ->setAdresseFournisseur($faker->address)
                ->setZipCodeFournisseur($faker->randomNumber(5));
            $manager->persist($fournisseur);
        }
        //produit
        for($i = 0 ; $i<10 ;$i++) {
            $produit= new Produit();
            $produit
                ->setLibelleProduit($faker->company)
                ->setPrixuProduit($faker->randomFloat(3,1,600))
                ->setAttributesProduit(array (
                    'image' =>
                        array (
                            0 => 'https://empiric-bats.000webhostapp.com/Image1.png',
                        ),
                    'genre' => 'homme',
                    'volume' => '50ml',
                ))
                ->setType("parfum")
                ->setMarque($faker->company)
                ->setDiscountProduit($faker->randomFloat(3,1,70))
                ->setProfitProduit($faker->randomFloat(3,1,50))
                ->setShippingcostProduit($faker->randomFloat(3,0,50))
                ->setUrlProduit($faker->domainName);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
