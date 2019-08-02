<?php

declare(strict_types=1);

namespace Tseguier\HealthCheckBundle;

use Tseguier\HealthCheckBundle\CheckResult\CheckResult;

interface HealthCheckInterface
{
    public const TAG = 'health_checker.service';

    public function checkHealth(): CheckResult;
}
