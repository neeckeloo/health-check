<?php

declare(strict_types=1);

namespace HealthCheckTest\Controller;

use PHPUnit\Framework\TestCase;
use Tseguier\HealthCheckBundle\CheckResult\CheckResult;
use Tseguier\HealthCheckBundle\CheckResult\FailedCheck;
use Tseguier\HealthCheckBundle\CheckResult\SuccessfulCheck;
use Tseguier\HealthCheckBundle\Controller\HealthCheckController;
use Tseguier\HealthCheckBundle\HealthCheckInterface;

class SuccessfulChecker implements HealthCheckInterface
{
    public function checkHealth(): CheckResult
    {
        return new SuccessfulCheck();
    }
}

class FailedChecker implements HealthCheckInterface
{
    public function checkHealth(): CheckResult
    {
        return new FailedCheck();
    }
}

class ControllerTest extends TestCase
{
    public function testSuccess()
    {
        $checker = new SuccessfulChecker();
        $controller = new HealthCheckController([$checker], 'Y-m-d H:i:s T');
        $result = $controller->getHealth();
        $body = \json_decode($result->getContent());

        $this->assertEquals($result->getStatusCode(), 200);
        $this->assertEquals($body->status, true);

    }

    public function testFail()
    {
        $checker = new FailedChecker();
        $controller = new HealthCheckController([$checker], 'Y-m-d H:i:s T');
        $result = $controller->getHealth();
        $body = \json_decode($result->getContent());

        $this->assertEquals($result->getStatusCode(), 503);
        $this->assertEquals($body->status, false);

    }
}
