<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="Facture_Entreprise0_FK", columns={"id_entr"}), @ORM\Index(name="Facture_Commande_FK", columns={"num_cmd"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="num_fct", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numFct;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fct", type="datetime", nullable=false)
     */
    private $dateFct;

    /**
     * @var float
     *
     * @ORM\Column(name="service_fct", type="float", precision=10, scale=0, nullable=false)
     */
    private $serviceFct;

    /**
     * @var float
     *
     * @ORM\Column(name="frais_livraison_fct", type="float", precision=10, scale=0, nullable=false)
     */
    private $fraisLivraisonFct;

    /**
     * @var float
     *
     * @ORM\Column(name="promotion_fct", type="float", precision=10, scale=0, nullable=false)
     */
    private $promotionFct;

    /**
     * @var float
     *
     * @ORM\Column(name="depot_fct", type="float", precision=10, scale=0, nullable=false)
     */
    private $depotFct;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="num_cmd", referencedColumnName="num_cmd")
     * })
     */
    private $numCmd;

    /**
     * @var \Entreprise
     *
     * @ORM\ManyToOne(targetEntity="Entreprise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_entr", referencedColumnName="id_entr")
     * })
     */
    private $idEntr;

    public function getNumFct(): ?int
    {
        return $this->numFct;
    }

    public function getDateFct(): ?\DateTimeInterface
    {
        return $this->dateFct;
    }

    public function setDateFct(\DateTimeInterface $dateFct): self
    {
        $this->dateFct = $dateFct;

        return $this;
    }

    public function getServiceFct(): ?float
    {
        return $this->serviceFct;
    }

    public function setServiceFct(float $serviceFct): self
    {
        $this->serviceFct = $serviceFct;

        return $this;
    }

    public function getFraisLivraisonFct(): ?float
    {
        return $this->fraisLivraisonFct;
    }

    public function setFraisLivraisonFct(float $fraisLivraisonFct): self
    {
        $this->fraisLivraisonFct = $fraisLivraisonFct;

        return $this;
    }

    public function getPromotionFct(): ?float
    {
        return $this->promotionFct;
    }

    public function setPromotionFct(float $promotionFct): self
    {
        $this->promotionFct = $promotionFct;

        return $this;
    }

    public function getDepotFct(): ?float
    {
        return $this->depotFct;
    }

    public function setDepotFct(float $depotFct): self
    {
        $this->depotFct = $depotFct;

        return $this;
    }

    public function getNumCmd(): ?Commande
    {
        return $this->numCmd;
    }

    public function setNumCmd(?Commande $numCmd): self
    {
        $this->numCmd = $numCmd;

        return $this;
    }

    public function getIdEntr(): ?Entreprise
    {
        return $this->idEntr;
    }

    public function setIdEntr(?Entreprise $idEntr): self
    {
        $this->idEntr = $idEntr;

        return $this;
    }


}
