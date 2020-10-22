<?php

namespace App\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping;

trait EndTimeEntity
{
    /**
     * Entity's end time
     *
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endTime;

    /**
     * Get entity's end time
     *
     * @return DateTime|null
     */
    public function getEndTime(): ?DateTime
    {
        return $this->endTime;
    }

    /**
     * Set entity's end time
     *
     * @param DateTime $endTime
     * @return self
     */
    public function setEndTime(?DateTime $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }
}
