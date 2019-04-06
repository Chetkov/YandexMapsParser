<?php

namespace Chetkov\YaMapsParser;

use Chetkov\YaMapsParser\Model\Place;
use Chetkov\YaMapsParser\Request\BBoxSearchRequest;
use RuntimeException;

/**
 * Class BBoxSearchService
 * @package Chetkov\YaMapsParser
 */
class BBoxSearchService extends BaseSearchService
{
    /**
     * @param BBoxSearchRequest $request
     * @return Place[]
     * @throws Exception\EmptyResultException
     * @throws RuntimeException
     */
    public function search(BBoxSearchRequest $request): array
    {
        return $this->getPlaces($request);
    }
}
