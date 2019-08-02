# Health Check

A controller which checks all the containers implementing `HealthCheckInterface`.
It will call the `checkHealth` method of each and will display a JSON output:

```json
{
  "status": true,
  "timestamp": "2019-07-15 12:34:12 UTC"
}
```

JSON payload values:

| name      | type    | description         |
|-----------|---------|---------------------|
| status    | boolean | health check status |
| timestamp | string  | current date        |

## Installation

Install with composer:

```
composer require tseguier/health-check
```

Add the bundle to your bundles.php

```
Tseguier\HealthCheckBundle\HealthCheckBundle::class => ['all' => true],
```

Configure the controller route in your routes.yaml

```
health_check:
  resource: "@HealthCheckBundle/Controller/HealthCheckController.php"
  prefix: /
  type: annotation
```

## Configuration

The timestamp format can be configured in the `date_format` configuration field, default is 'Y-m-d H:i:s T'

## Health Checkers

To check the health of a service, you just need to create a checker that implements `HealthCheckInterface` interface.

e.g. :
```
use Tseguier\HealthCheckBundle\CheckResult\CheckResult;
use Tseguier\HealthCheckBundle\CheckResult\FailedCheck;
use Tseguier\HealthCheckBundle\CheckResult\SuccessfulCheck;
use Tseguier\HealthCheckBundle\HealthCheckInterface;

final class HealthChecker implements HealthCheckInterface
{
    public function checkHealth(): CheckResult
    {
        if ($this->somethingToCheck->isWorking()) {
            return new SuccessfulCheck();
        } else {
            return new FailedCheck();
        }
    }
}
```

## Next Release

- additional data on checked services
- route for detailled informations
