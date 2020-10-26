<?php

namespace App\Entity;

use App\Entity\Base\DescriptionEntity255;
use App\Entity\Base\NamedEntity;
use App\Repository\SkillCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillCategoryRepository::class)
 */
class SkillCategory
{
    use NamedEntity;
    use DescriptionEntity255;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Skill::class, mappedBy="category")
     */
    private $skills;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $icon;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $banner;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setCategory($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            // set the owning side to null (unless already changed)
            if ($skill->getCategory() === $this) {
                $skill->setCategory(null);
            }
        }

        return $this;
    }

    public function getIcon(): ?Asset
    {
        return $this->icon;
    }

    public function setIcon(?Asset $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getBanner(): ?Asset
    {
        return $this->banner;
    }

    public function setBanner(?Asset $banner): self
    {
        $this->banner = $banner;

        return $this;
    }
}
