<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping;

trait DescriptionEntity255
{
    /**
     * Entity's description
     *
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $description;

    /**
     * Get Entity's Description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set Entity's description
     *
     * @param string|null $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
