<?php

namespace Chetkov\YaMapsParser\Translator;

use Chetkov\YaMapsParser\Model\Point;

/**
 * Class DistanceTranslator
 * @package Chetkov\YaMapsParser\Translator
 */
abstract class DistanceTranslator
{
    /**
     * Переопределить в наследниках
     * @var array
     */
    protected const KM_IN_ONE_DEGREE = [];

    /**
     * @param float $distance
     * @param \Chetkov\YaMapsParser\Model\Point $startPoint
     * @return float
     */
    public function translateKmToDegrees(float $distance, Point $startPoint): float
    {
        $kmInOneDegree = $this->getKmInOneDegree($startPoint->getLatitude());
        if (!$kmInOneDegree) {
            // К примеру на широтах 90 и -90, в 1-м градусе параллели 0км.
            return 0;
        }

        return 1 / $kmInOneDegree * $distance;
    }

    /**
     * @param float $latitude
     * @return float|null
     */
    abstract public function getKmInOneDegree(float $latitude): ?float;
}