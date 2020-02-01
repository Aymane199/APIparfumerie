<?php


namespace App\Repository;


use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    /**
     * @param null $search
     * @return array
     */
    public function getClient_search($search=null){
        $query = $this->createQueryBuilder('p');
       if($search != null){
            $query->andWhere('p.nomClient LIKE :searchTerm 
            OR p.prenomClient LIKE :searchTerm 
            OR p.countryClient LIKE :searchTerm 
            OR p.telephoneClient LIKE :searchTerm 
            OR p.emailClient LIKE :searchTerm 
            OR p.zipCodeClient LIKE :searchTerm')
                ->setParameter('searchTerm','%'. $search .'%');
        }
        return  $query->getQuery()->getResult();

    }
}