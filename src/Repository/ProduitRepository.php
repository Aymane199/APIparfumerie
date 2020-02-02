<?php


namespace App\Repository;


use App\Entity\Client;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProduitRepository  extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function findAllQuery($value)
    {

        return $this->createQueryBuilder('p')
            ->andWhere('p.prixuProduit < :val')
            ->setParameter('val', $value)
            ->orderBy('p.prixuProduit', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;

    }

    /**
     * @param null $brand
     * @param null $search
     * @param null $gender
     * @param null $type
     * @return mixed
     */
    public function getProduit_search_brand_gender_type($brand=null, $search=null, $gender=null, $type=null ){
        $famillesProd = $this->getDisctProduitName_search_brand_gender_type($brand, $search, $gender,  $type);
        $results[0] = 0;
        for($i=0; $i<count($famillesProd) ;$i++){
            $query = $this->createQueryBuilder('p')
                ->andWhere('p.libelleProduit = :lib ')
                ->setParameter('lib',  $famillesProd[$i]['libelleProduit'] )
                ->orderBy('p.prixuProduit','ASC')
                ->setMaxResults(1);
            $results[$i] = $query->getQuery()->getResult()[0];
            }
                    return $results;
    }

    /**
     * @param null $brand
     * @param null $search
     * @param null $gender
     * @param null $type
     * @return array
     */
    public function getDisctProduitName_search_brand_gender_type($brand=null, $search=null, $gender=null, $type=null ){
        $query = $this->createQueryBuilder('p')
            ->select('p.libelleProduit');
        if($brand != null){
            $query->andWhere('p.marque = :brand')
                ->setParameter('brand',$brand);
        }if($search != null){
            $query->andWhere('p.libelleProduit LIKE :searchTerm OR p.attributesProduit LIKE :searchTerm')
                ->setParameter('searchTerm','%'. $search .'%');
        }if($gender != null){
            $query->andWhere('p.attributesProduit LIKE :gender')
                ->setParameter('gender','%'. $gender .'%');
        }if($type != null){
            $query->andWhere('p.type = :type')
                ->setParameter('type',$type);
        }
        $query->groupBy('p.libelleProduit');
        return  $query->getQuery()->getScalarResult();

    }
    public function getAllProduct_search_brand_gender_type($brand=null, $search=null, $gender=null, $type=null ){
        $query = $this->createQueryBuilder('p');
        if($brand != null){
            $query->andWhere('p.marque = :brand')
                ->setParameter('brand',$brand);
        }if($search != null){
            $query->andWhere('p.libelleProduit LIKE :searchTerm OR p.attributesProduit LIKE :searchTerm')
                ->setParameter('searchTerm','%'. $search .'%');
        }if($gender != null){
            $query->andWhere('p.attributesProduit LIKE :gender')
                ->setParameter('gender','%'. $gender .'%');
        }if($type != null) {
            $query->andWhere('p.type = :type')
                ->setParameter('type', $type);
        }
        return  $query->getQuery()->getResult();

    }
    /**
     * @param Produit $produit
     */
    public function getSimilaires(Produit $produit){
        return $this->createQueryBuilder('p')
            ->andWhere('p.libelleProduit LIKE :lib')
            ->setParameter('lib', '%' . $produit->getLibelleProduit() . '%')
            ->andWhere('p.numProduit != :numProd')
            ->setParameter('numProd', $produit->getNumProduit())
            ->orderBy('p.prixuProduit', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;

    }


    public function getDisctProduitName_search_brand_gender_typeQuery(){

    }
}