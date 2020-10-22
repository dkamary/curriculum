<?php

namespace App\Entity;

use App\Repository\UserStatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserStatRepository::class)
 */
class UserStat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userStats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned":true})
     */
    private $views;

    /**
     * @ORM\Column(type="smallint", nullable=true, options={"unsigned":true})
     */
    private $searches;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastConnection;

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

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getSearches(): ?int
    {
        return $this->searches;
    }

    public function setSearches(?int $searches): self
    {
        $this->searches = $searches;

        return $this;
    }

    public function getLastConnection(): ?\DateTimeInterface
    {
        return $this->lastConnection;
    }

    public function setLastConnection(?\DateTimeInterface $lastConnection): self
    {
        $this->lastConnection = $lastConnection;

        return $this;
    }
}
