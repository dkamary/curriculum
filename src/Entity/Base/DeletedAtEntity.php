<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping;

trait DeletedAtEntity
{
    /**
     * Enitity's deleted Datetime
     *
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * Flag to indicate if the entity is active or inactive
     *
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

    /**
     * Get Entity's deleted datetime
     *
     * @return DateTime
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * Set inactive the entity
     *
     * @return self
     */
    public function delete(): self
    {
        $this->isActive = false;
        $this->deletedAt = new DateTime('Y-m-d H:i:s');

        return $this;
    }

    /**
     * Set Is Active
     *
     * @param boolean $isActive
     * @return self
     */
    public function setIsActive(bool $isActive): self
    {
        if (!$isActive) {
            return $this->delete();
        } else {
            $this->isActive = $isActive;
            $this->deletedAt = null;
        }
        return $this;
    }

    /**
     * Get Is Active
     *
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }
}
