<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agent
 *
 * @ORM\Table(name="agent")
 * @ORM\Entity
 */
class Agent
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_agent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAgent;

    public function getIdAgent(): ?int
    {
        return $this->idAgent;
    }


}
