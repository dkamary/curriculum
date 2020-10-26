<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\DeletedAtEntity;
use App\Entity\Base\DescriptionEntity512;
use App\Entity\Base\EndTimeEntity;
use App\Entity\Base\NamedEntity;
use App\Entity\Base\StartTimeEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\ProposalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProposalRepository::class)
 */
class Proposal
{
    use NamedEntity;
    use DescriptionEntity512;
    use StartTimeEntity;
    use EndTimeEntity;
    use CreatedAtEntity;
    use UpdatedAtEntity;
    use DeletedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=Applier::class, mappedBy="proposal")
     */
    private $appliers;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $banner;

    public function __construct()
    {
        $this->appliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|Applier[]
     */
    public function getAppliers(): Collection
    {
        return $this->appliers;
    }

    public function addApplier(Applier $applier): self
    {
        if (!$this->appliers->contains($applier)) {
            $this->appliers[] = $applier;
            $applier->setProposal($this);
        }

        return $this;
    }

    public function removeApplier(Applier $applier): self
    {
        if ($this->appliers->contains($applier)) {
            $this->appliers->removeElement($applier);
            // set the owning side to null (unless already changed)
            if ($applier->getProposal() === $this) {
                $applier->setProposal(null);
            }
        }

        return $this;
    }

    public function getImage(): ?Asset
    {
        return $this->image;
    }

    public function setImage(?Asset $image): self
    {
        $this->image = $image;

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
