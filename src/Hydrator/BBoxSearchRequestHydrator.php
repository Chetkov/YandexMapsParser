<?php

namespace Chetkov\YaMapsParser\Hydrator;

use Chetkov\YaMapsParser\Helper\Singleton;
use Chetkov\YaMapsParser\Request\BBoxSearchRequest;

/**
 * Class BBoxSearchRequestHydrator
 * @package Chetkov\YaMapsParser\Hydrator
 */
class BBoxSearchRequestHydrator extends BaseRequestHydrator
{
    use Singleton;

    /**
     * @param BBoxSearchRequest $request
     * @return array
     */
    protected function extractSpecificFields($request): array
    {
        $leftBottom = $request->getLeftBottomPoint();
        $rightTop = $request->getRightTopPoint();
        return [
            'bbox' => "{$leftBottom->getLongitude()},{$leftBottom->getLatitude()}~{$rightTop->getLongitude()},{$rightTop->getLatitude()}",
        ];
    }
}
