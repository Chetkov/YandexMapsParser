<?php

namespace Chetkov\YaMapsParser;

use Chetkov\YaMapsParser\Request\CircleSearchRequest;
use Chetkov\YaMapsParser\Model\Place;

/**
 * Class CircleSearchService
 * @package Chetkov\YaMapsParser
 */
class CircleSearchService extends BaseSearchService
{
    /**
     * @param CircleSearchRequest $request
     * @return Place[]
     */
    public function search(CircleSearchRequest $request): array
    {
        return $this->getPlaces($request);
    }
}
