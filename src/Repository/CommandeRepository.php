<?php


namespace App\Repository;


use App\Entity\Agent;
use App\Entity\Commande;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use MongoDB\Driver\Command;

class CommandeRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commande::class);
    }

    public function findAllByEmailAgent($value)
    {

        return $this->createQueryBuilder('p')
            ->leftJoin(Agent::class,'a',Join::WITH,'a.idAgent = p.idAgent')
            ->andWhere('a.email = :val')
            ->setParameter('val', $value)
            ->orderBy('p.dateCmd', 'DESC')
            ->getQuery()
            ->getResult()
            ;

    }

}