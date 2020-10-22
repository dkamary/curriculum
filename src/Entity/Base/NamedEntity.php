<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

trait NamedEntity
{

    /**
     * Entity Name
     *
     * @var string
     * @ORM\Column(type="string", length=150, nullable=true, unique=true)
     */
    private $name;

    /**
     * Get Entity Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set Entity Name
     *
     * @param string|null $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
