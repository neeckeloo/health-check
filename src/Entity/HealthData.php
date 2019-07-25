<?php

namespace Tseguier\HealthCheckBundle\Entity;

class HealthData
{
    private $status;

    public function __construct(int $status)
    {
        $this->status = $status;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

}
