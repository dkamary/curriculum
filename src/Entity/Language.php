<?php

namespace App\Entity;

use App\Entity\Base\DeletedAtEntity;
use App\Entity\Base\NamedEntity;
use App\Repository\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageRepository::class)
 */
class Language
{
    use NamedEntity;
    use DeletedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="smallint", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Asset::class)
     */
    private $icon;

    public function getId(): ?int
    {
        return $this->id;
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
}
