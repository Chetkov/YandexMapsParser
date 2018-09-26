<?php

namespace Chetkov\YaMapsParser;

use Chetkov\YaMapsParser\Request\BBoxSearchRequest;
use Chetkov\YaMapsParser\Model\Place;

/**
 * Class BBoxSearchService
 * @package Chetkov\YaMapsParser
 */
class BBoxSearchService extends BaseSearchService
{
    /**
     * @param BBoxSearchRequest $request
     * @return Place[]
     */
    public function search(BBoxSearchRequest $request): array
    {
        return $this->getPlaces($request);
    }
}
