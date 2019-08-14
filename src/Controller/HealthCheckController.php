<?php

namespace Tseguier\HealthCheckBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

/**
 * @Route("/healthcheck")
 */
final class HealthCheckController
{
    /**
     * @var array|iterable
     */
    private $healthCheckers = [];

    /**
     * @var string
     */
    private $dateFormat;

    public function __construct(iterable $healthCheckers, string $dateFormat)
    {
        $this->dateFormat = $dateFormat;
        $this->healthCheckers = $healthCheckers;
    }

    /**
     * Get system health
     *
     * @Route("", methods={"GET"})
     *
     * @SWG\Get(
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="Healthy system",
     *         @SWG\Schema(
     *             required={"status", "timestamp"},
     *             @SWG\Property(property="status", type="boolean"),
     *             @SWG\Property(property="timestamp", type="string")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=503,
     *         description="Unhealthy system",
     *         @SWG\Schema(
     *             required={"status", "timestamp"},
     *             @SWG\Property(property="status", type="boolean"),
     *             @SWG\Property(property="timestamp", type="string")
     *         ),
     *     ),
     * )
     */
    public function getHealth(): JsonResponse
    {
        $data = [
          'status' => true,
          'timestamp' => date($this->dateFormat),
        ];

        foreach ($this->healthCheckers as $healthService) {
            $info = $healthService->checkHealth();
            if (!$info->getStatus()) {
                $data['status'] = false;
            }
        }

        return new JsonResponse($data, $data['status'] ? 200 : 503);
    }
}
