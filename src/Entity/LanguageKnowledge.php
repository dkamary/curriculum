<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtEntity;
use App\Entity\Base\UpdatedAtEntity;
use App\Repository\LanguageKnowledgeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LanguageKnowledgeRepository::class)
 */
class LanguageKnowledge
{
    use CreatedAtEntity;
    use UpdatedAtEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", options={"unsigned":true})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=LanguageList::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $language;

    /**
     * @ORM\ManyToOne(targetEntity=LanguageLevel::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguage(): ?LanguageList
    {
        return $this->language;
    }

    public function setLanguage(?LanguageList $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getLevel(): ?LanguageLevel
    {
        return $this->level;
    }

    public function setLevel(?LanguageLevel $level): self
    {
        $this->level = $level;

        return $this;
    }
}
