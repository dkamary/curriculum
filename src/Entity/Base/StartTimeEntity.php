<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping;

trait StartTimeEntity
{
    /**
     * Entity's start time
     *
     * @var DateTime
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * Get entity's start time
     *
     * @return DateTime
     */
    public function getStartTime(): DateTime
    {
        return $this->startTime;
    }

    /**
     * Set entity's start time
     *
     * @param DateTime $startTime
     * @return self
     */
    public function setStartTime(DateTime $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }
}
