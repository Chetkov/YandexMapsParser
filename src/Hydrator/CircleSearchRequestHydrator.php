<?php

namespace Chetkov\YaMapsParser\Hydrator;

use Chetkov\YaMapsParser\Helper\Singleton;
use Chetkov\YaMapsParser\Request\CircleSearchRequest;
use Chetkov\YaMapsParser\Translator\LatitudeDistanceTranslator;
use Chetkov\YaMapsParser\Translator\LongitudeDistanceTranslator;

/**
 * Class CircleSearchRequestHydrator
 * @package Chetkov\YaMapsParser\Hydrator
 */
class CircleSearchRequestHydrator extends BaseRequestHydrator
{
    use Singleton;

    /**
     * @param CircleSearchRequest $request
     * @return array
     */
    protected function extractSpecificFields($request): array
    {
        $latDistanceTranslator = new LatitudeDistanceTranslator();
        $lonDistanceTranslator = new LongitudeDistanceTranslator();
        $centerPoint = $request->getCenterPoint();
        $radius = $request->getRadius();
        return [
            'll' => "{$centerPoint->getLongitude()},{$centerPoint->getLatitude()}",
            'spn' => "{$lonDistanceTranslator->translateKmToDegrees($radius, $centerPoint)},{$latDistanceTranslator->translateKmToDegrees($radius, $centerPoint)}",
            'rspn' => (int)$request->isLimitedByRadius(),
        ];
    }
}
