# Health Check
A controller which checks all the containers implementing `HealthCheckInterface`.
It will call the `checkHealth` method of each and will display a JSON output:
{
  "status": true if all containers returned a `HealthData` with status true, false else.
  "timestamp": actual date
}

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

## Health Checker Services

To check the health of a service you just need to implements `HealthCheckInterface` into it.

e.g. :
```
use Tseguier\HealthCheckBundle\Dto\HealthData;
use Tseguier\HealthCheckBundle\HealthCheckInterface;

final class HealthCheckerService implements HealthCheckInterface
{

    public function checkHealth(): HealthData
    {
        if ($this->somethingToCheck->isWorking()) {
          return new HealthData(true);
        } else {
          return new HealthData(false);
        }
    }
}
```

## Next Release
- additional data on checked services
- route for detailled informations
