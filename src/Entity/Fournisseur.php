<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_fournisseur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fournisseur", type="string", length=50, nullable=false)
     */
    private $nomFournisseur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produit", inversedBy="idFournisseur")
     * @ORM\JoinTable(name="fournisseurproduit",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_fournisseur", referencedColumnName="id_fournisseur")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="num_produit", referencedColumnName="num_produit")
     *   }
     * )
     */
    private $numProduit;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->numProduit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdFournisseur(): ?int
    {
        return $this->idFournisseur;
    }

    public function getNomFournisseur(): ?string
    {
        return $this->nomFournisseur;
    }

    public function setNomFournisseur(string $nomFournisseur): self
    {
        $this->nomFournisseur = $nomFournisseur;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getNumProduit(): Collection
    {
        return $this->numProduit;
    }

    public function addNumProduit(Produit $numProduit): self
    {
        if (!$this->numProduit->contains($numProduit)) {
            $this->numProduit[] = $numProduit;
        }

        return $this;
    }

    public function removeNumProduit(Produit $numProduit): self
    {
        if ($this->numProduit->contains($numProduit)) {
            $this->numProduit->removeElement($numProduit);
        }

        return $this;
    }

}
