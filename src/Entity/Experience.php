<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\DescriptionEntity512;
use App\Entity\Base\EndTimeEntity;
use App\Entity\Base\StartTimeEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    use DescriptionEntity512;
    use StartTimeEntity;
    use EndTimeEntity;
    use CreatedAtEntity;
    use UpdatedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="experiences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity=ExperienceSkill::class, mappedBy="experience")
     */
    private $experienceSkills;

    public function __construct()
    {
        $this->experienceSkills = new ArrayCollection();
    }

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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|ExperienceSkill[]
     */
    public function getExperienceSkills(): Collection
    {
        return $this->experienceSkills;
    }

    public function addExperienceSkill(ExperienceSkill $experienceSkill): self
    {
        if (!$this->experienceSkills->contains($experienceSkill)) {
            $this->experienceSkills[] = $experienceSkill;
            $experienceSkill->setExperience($this);
        }

        return $this;
    }

    public function removeExperienceSkill(ExperienceSkill $experienceSkill): self
    {
        if ($this->experienceSkills->contains($experienceSkill)) {
            $this->experienceSkills->removeElement($experienceSkill);
            // set the owning side to null (unless already changed)
            if ($experienceSkill->getExperience() === $this) {
                $experienceSkill->setExperience(null);
            }
        }

        return $this;
    }
}
