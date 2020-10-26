<?php

namespace App\Entity;

use App\Entity\Base\DeletedAtEntity;
use App\Entity\Base\NamedEntity;
use App\Repository\AssetTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AssetTypeRepository::class)
 */
class AssetType
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
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extensions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMime(): ?string
    {
        return $this->mime;
    }

    public function setMime(?string $mime): self
    {
        $this->mime = $mime;

        return $this;
    }

    public function getExtensions(): ?string
    {
        return $this->extensions;
    }

    public function setExtensions(string $extensions): self
    {
        $this->extensions = $extensions;

        return $this;
    }
}
