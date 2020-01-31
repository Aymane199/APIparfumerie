<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="num_produit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_produit", type="string", length=50, nullable=false)
     */
    private $libelleProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=50, nullable=false)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="prixU_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixuProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="discount_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $discountProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="url_produit", type="string", length=50, nullable=false)
     */
    private $urlProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="shippingcost_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $shippingcostProduit;

    /**
     * @var float
     *
     * @ORM\Column(name="profit_produit", type="float", precision=10, scale=0, nullable=false)
     */
    private $profitProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="attributes_produit", type="text", length=65535, nullable=false)
     */
    private $attributesProduit;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Fournisseur", mappedBy="numProduit")
     */
    private $idFournisseur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Commande", inversedBy="numProduit")
     * @ORM\JoinTable(name="lignecommande",
     *   joinColumns={
     *     @ORM\JoinColumn(name="num_produit", referencedColumnName="num_produit")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="num_cmd", referencedColumnName="num_cmd")
     *   }
     * )
     */
    private $numCmd;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idFournisseur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->numCmd = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getNumProduit(): ?int
    {
        return $this->numProduit;
    }

    public function getLibelleProduit(): ?string
    {
        return $this->libelleProduit;
    }

    public function setLibelleProduit(string $libelleProduit): self
    {
        $this->libelleProduit = $libelleProduit;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrixuProduit(): ?float
    {
        return $this->prixuProduit;
    }

    public function setPrixuProduit(float $prixuProduit): self
    {
        $this->prixuProduit = $prixuProduit;

        return $this;
    }

    public function getDiscountProduit(): ?float
    {
        return $this->discountProduit;
    }

    public function setDiscountProduit(float $discountProduit): self
    {
        $this->discountProduit = $discountProduit;

        return $this;
    }

    public function getUrlProduit(): ?string
    {
        return $this->urlProduit;
    }

    public function setUrlProduit(string $urlProduit): self
    {
        $this->urlProduit = $urlProduit;

        return $this;
    }

    public function getShippingcostProduit(): ?float
    {
        return $this->shippingcostProduit;
    }

    public function setShippingcostProduit(float $shippingcostProduit): self
    {
        $this->shippingcostProduit = $shippingcostProduit;

        return $this;
    }

    public function getProfitProduit(): ?float
    {
        return $this->profitProduit;
    }

    public function setProfitProduit(float $profitProduit): self
    {
        $this->profitProduit = $profitProduit;

        return $this;
    }

    public function getAttributesProduit(): ?string
    {
        return $this->attributesProduit;
    }

    public function setAttributesProduit(string $attributesProduit): self
    {
        $this->attributesProduit = $attributesProduit;

        return $this;
    }

    /**
     * @return Collection|Fournisseur[]
     */
    public function getIdFournisseur(): Collection
    {
        return $this->idFournisseur;
    }

    public function addIdFournisseur(Fournisseur $idFournisseur): self
    {
        if (!$this->idFournisseur->contains($idFournisseur)) {
            $this->idFournisseur[] = $idFournisseur;
            $idFournisseur->addNumProduit($this);
        }

        return $this;
    }

    public function removeIdFournisseur(Fournisseur $idFournisseur): self
    {
        if ($this->idFournisseur->contains($idFournisseur)) {
            $this->idFournisseur->removeElement($idFournisseur);
            $idFournisseur->removeNumProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getNumCmd(): Collection
    {
        return $this->numCmd;
    }

    public function addNumCmd(Commande $numCmd): self
    {
        if (!$this->numCmd->contains($numCmd)) {
            $this->numCmd[] = $numCmd;
        }

        return $this;
    }

    public function removeNumCmd(Commande $numCmd): self
    {
        if ($this->numCmd->contains($numCmd)) {
            $this->numCmd->removeElement($numCmd);
        }

        return $this;
    }

}
