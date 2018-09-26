<?php

namespace Chetkov\YaMapsParser;

use Chetkov\YaMapsParser\Hydrator\BBoxSearchRequestHydrator;
use Chetkov\YaMapsParser\Hydrator\CircleSearchRequestHydrator;
use Chetkov\YaMapsParser\Hydrator\PlaceHydrator;
use Chetkov\YaMapsParser\Translator\ResponseTranslator;

/**
 * Class SearchServiceFactory
 * @package Chetkov\YaMapsParser
 */
class SearchServiceFactory
{
    /**
     * @param string $apiKey
     * @return BBoxSearchService
     */
    public static function createBBoxSearchService(string $apiKey): BBoxSearchService
    {
        $requestHydrator = BBoxSearchRequestHydrator::getInstance();
        $placeHydrator = PlaceHydrator::getInstance();
        $responseTranslator = new ResponseTranslator($placeHydrator);
        return new BBoxSearchService(
            $requestHydrator,
            $responseTranslator,
            $apiKey
        );
    }

    /**
     * @param string $apiKey
     * @return CircleSearchService
     */
    public static function createCircleSearchService(string $apiKey): CircleSearchService
    {
        $requestHydrator = CircleSearchRequestHydrator::getInstance();
        $placeHydrator = PlaceHydrator::getInstance();
        $responseTranslator = new ResponseTranslator($placeHydrator);
        return new CircleSearchService(
            $requestHydrator,
            $responseTranslator,
            $apiKey
        );
    }
}
