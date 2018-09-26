<?php

namespace Chetkov\YaMapsParser\Translator;

use Chetkov\YaMapsParser\Model\Place;
use Chetkov\YaMapsParser\Hydrator\PlaceHydrator;

/**
 * Class ResponseTranslator
 * @package Chetkov\YaMapsParser\Translator
 */
class ResponseTranslator
{
    /**
     * @var \Chetkov\YaMapsParser\Hydrator\PlaceHydrator
     */
    private $placeHydrator;

    /**
     * ResponseTranslator constructor.
     * @param \Chetkov\YaMapsParser\Hydrator\PlaceHydrator $placeHydrator
     */
    public function __construct(PlaceHydrator $placeHydrator)
    {
        $this->placeHydrator = $placeHydrator;
    }

    /**
     * @param \stdClass[] $features
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
