<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticRepository::class)
 */
class Statistic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Beer::class, inversedBy="statistics")
     */
    private $beer_id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="statistics")
     */
    private $client_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBeerId(): ?Beer
    {
        return $this->beer_id;
    }

    public function setBeerId(?Beer $beer_id): self
    {
        $this->beer_id = $beer_id;

        return $this;
    }

    public function getClientId(): ?Client
    {
        return $this->client_id;
    }

    public function setClientId(?Client $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }
}
