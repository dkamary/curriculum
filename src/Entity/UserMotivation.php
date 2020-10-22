<?php

namespace App\Entity;

use App\Repository\UserMotivationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserMotivationRepository::class)
 */
class UserMotivation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userMotivations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $presentation;

    /**
     * @ORM\ManyToOne(targetEntity=Job::class, inversedBy="userMotivations")
     */
    private $job;

    /**
     * @ORM\Column(type="boolean")
     */
    private $travel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $destinations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getTravel(): ?bool
    {
        return $this->travel;
    }

    public function setTravel(bool $travel): self
    {
        $this->travel = $travel;

        return $this;
    }

    public function getDestinations(): ?string
    {
        return $this->destinations;
    }

    public function setDestinations(?string $destinations): self
    {
        $this->destinations = $destinations;

        return $this;
    }
}
