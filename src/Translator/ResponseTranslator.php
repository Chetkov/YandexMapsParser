<?php

namespace Chetkov\YaMapsParser\Translator;

use Chetkov\YaMapsParser\Hydrator\PlaceHydrator;
use Chetkov\YaMapsParser\Model\Place;
use stdClass;

/**
 * Class ResponseTranslator
 * @package Chetkov\YaMapsParser\Translator
 */
class ResponseTranslator
{
    /**
     * @var PlaceHydrator
     */
    private $placeHydrator;

    /**
     * ResponseTranslator constructor.
     * @param PlaceHydrator $placeHydrator
     */
    public function __construct(PlaceHydrator $placeHydrator)
    {
        $this->placeHydrator = $placeHydrator;
    }

    /**
     * @param stdClass[] $features
     * @return Place[]
     */
    public function translate(array $features): array
    {
        $places = [];
        foreach ($features as $feature) {
            if (empty($feature->properties->CompanyMetaData)) {
                continue;
            }

            $places[] = $this->placeHydrator->hydrate($feature->properties->CompanyMetaData);
        }
        return $places;
    }
}
