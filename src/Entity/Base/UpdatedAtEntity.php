<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping;

/**
 * @Entity @ORM\HasLifecycleCallbacks()
 */
trait UpdatedAtEntity
{
    /**
     * Entity's updating datetime
     *
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * Get entity's updating datetime
     *
     * @return DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * Callback when the entity is about to updated
     *
     * @return void
     * @PreUpdate
     */
    public function update()
    {
        $this->updatedAt = new DateTime('Y-m-d H:i:s');
    }
}
