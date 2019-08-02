<?php

declare(strict_types=1);

namespace Tseguier\HealthCheckBundle\Dto;

class HealthData
{
    /**
     * @var bool
     */
    private $status;

    public function __construct(bool $status)
    {
        $this->status = $status;
    }

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }
}
