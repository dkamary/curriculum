<?php

namespace App\Entity;

use App\Entity\Base\NamedEntity;
use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 */
class Job
{
    use NamedEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=UserMotivation::class, mappedBy="job")
     */
    private $userMotivations;

    public function __construct()
    {
        $this->userMotivations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|UserMotivation[]
     */
    public function getUserMotivations(): Collection
    {
        return $this->userMotivations;
    }

    public function addUserMotivation(UserMotivation $userMotivation): self
    {
        if (!$this->userMotivations->contains($userMotivation)) {
            $this->userMotivations[] = $userMotivation;
            $userMotivation->setJob($this);
        }

        return $this;
    }

    public function removeUserMotivation(UserMotivation $userMotivation): self
    {
        if ($this->userMotivations->contains($userMotivation)) {
            $this->userMotivations->removeElement($userMotivation);
            // set the owning side to null (unless already changed)
            if ($userMotivation->getJob() === $this) {
                $userMotivation->setJob(null);
            }
        }

        return $this;
    }
}
