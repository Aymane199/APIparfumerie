<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity
 */
class Entreprise
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_entr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEntr;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_entr", type="string", length=50, nullable=false)
     */
    private $nomEntr;

    /**
     * @var string
     *
     * @ORM\Column(name="fb_page", type="string", length=50, nullable=false)
     */
    private $fbPage;

    /**
     * @var string
     *
     * @ORM\Column(name="email_entr", type="string", length=50, nullable=false)
     */
    private $emailEntr;

    /**
     * @var string
     *
     * @ORM\Column(name="website_entr", type="string", length=50, nullable=false)
     */
    private $websiteEntr;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_entr", type="string", length=50, nullable=false)
     */
    private $logoEntr;

    public function getIdEntr(): ?int
    {
        return $this->idEntr;
    }

    public function getNomEntr(): ?string
    {
        return $this->nomEntr;
    }

    public function setNomEntr(string $nomEntr): self
    {
        $this->nomEntr = $nomEntr;

        return $this;
    }

    public function getFbPage(): ?string
    {
        return $this->fbPage;
    }

    public function setFbPage(string $fbPage): self
    {
        $this->fbPage = $fbPage;

        return $this;
    }

    public function getEmailEntr(): ?string
    {
        return $this->emailEntr;
    }

    public function setEmailEntr(string $emailEntr): self
    {
        $this->emailEntr = $emailEntr;

        return $this;
    }

    public function getWebsiteEntr(): ?string
    {
        return $this->websiteEntr;
    }

    public function setWebsiteEntr(string $websiteEntr): self
    {
        $this->websiteEntr = $websiteEntr;

        return $this;
    }

    public function getLogoEntr(): ?string
    {
        return $this->logoEntr;
    }

    public function setLogoEntr(string $logoEntr): self
    {
        $this->logoEntr = $logoEntr;

        return $this;
    }


}
