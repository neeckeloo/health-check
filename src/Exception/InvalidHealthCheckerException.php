<?php

declare(strict_types=1);

namespace Tseguier\HealthCheckBundle\Exception;

use InvalidArgumentException;
use Tseguier\HealthCheckBundle\HealthCheckInterface;

class InvalidHealthCheckerException extends InvalidArgumentException implements ExceptionInterface
{
    public function __construct($value)
    {
        $message = \sprintf(
            'Health checker expected to be a %s instance; %s given.',
            HealthCheckInterface::class,
            \is_object($value)
                ? \sprintf('%s instance', \get_class($value))
                : \gettype($value)
        );

        parent::__construct($message);
    }
}
