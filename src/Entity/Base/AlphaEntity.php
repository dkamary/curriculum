<?php

namespace App\Entity\Base;

use Doctrine\ORM\Mapping;

trait AlphaEntity
{
    /**
     * Entity's alpha2
     *
     * @var string
     * @ORM\Column(type="string", length=2, unique=true)
     */
    private $alpha2;

    /**
     * Entity's alpha3
     *
     * @var string
     * @ORM\Column(type="string", length=3, unique=true)
     */
    private $alpha3;

    /**
     * Get Entity's alpha2
     *
     * @return string
     */
    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    /**
     * Get Entity's alpha3
     *
     * @return string
     */
    public function getAlpha3(): string
    {
        return $this->alpha3;
    }

    /**
     * Set Entity's alpha2
     *
     * @param string $alpha2
     * @return self
     */
    public function setAlpha2(string $alpha2): self
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    /**
     * Set Entity's alpha3
     *
     * @param string $alpha3
     * @return self
     */
    public function setAlpha3(string $alpha3): self
    {
        $this->alpha3 = $alpha3;

        return $this;
    }
}
