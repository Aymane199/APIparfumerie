<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prospectcommmande
 *
 * @ORM\Table(name="prospectcommmande", indexes={@ORM\Index(name="ProspectCommmande_Client0_FK", columns={"id_client"}), @ORM\Index(name="ProspectCommmande_Agent_FK", columns={"id_agent"})})
 * @ORM\Entity
 */
class Prospectcommmande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_prospect", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProspect;

    /**
     * @var string
     *
     * @ORM\Column(name="note_prospect", type="text", length=65535, nullable=false)
     */
    private $noteProspect;

    /**
     * @var \Agent
     *
     * @ORM\ManyToOne(targetEntity="Agent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_agent", referencedColumnName="id_agent")
     * })
     */
    private $idAgent;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="id_client")
     * })
     */
    private $idClient;

    public function getIdProspect(): ?int
    {
        return $this->idProspect;
    }

    public function getNoteProspect(): ?string
    {
        return $this->noteProspect;
    }

    public function setNoteProspect(string $noteProspect): self
    {
        $this->noteProspect = $noteProspect;

        return $this;
    }

    public function getIdAgent(): ?Agent
    {
        return $this->idAgent;
    }

    public function setIdAgent(?Agent $idAgent): self
    {
        $this->idAgent = $idAgent;

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }


}
