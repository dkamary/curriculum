<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @ORM\HasLifecycleCallbacks()
 */
trait CreatedAtEntity
{
    /**
     * Entity's creation datetime
     *
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * Get Entity's creation date
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Callback when entity is about to be created
     *
     * @return void
     * @PrePersist
     */
    public function create()
    {
        $this->createdAt = new DateTime('Y-m-d H:i:s');
    }
}
