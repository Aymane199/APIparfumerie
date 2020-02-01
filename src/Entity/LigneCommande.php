<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Table(name="lignecommande")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandeRepository")
 */
class LigneCommande
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Produit")
     * @JoinColumn(name="num_produit", referencedColumnName="num_produit")
     */
    private $produit;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Commande")
     * @JoinColumn(name="num_cmd", referencedColumnName="num_cmd")
     */
    private $commande;

    /**
     * @ORM\Column(type="integer")
     */
    private $qty = 1;

    /**
     *
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct(Commande $commande, Produit $produit, $qty = 1)
    {
        $this->produit = $produit;
        $this->commande = $commande;
        $this->prix = $produit->getPrixuProduit();
        $this->qty = $qty;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }


}
