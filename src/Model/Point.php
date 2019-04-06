<?php

namespace Chetkov\YaMapsParser\Model;

use RuntimeException;

/**
 * Class Point
 * @package Chetkov\YaMapsParser\Model
 */
class Point
{
    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * Point constructor.
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        if (abs($latitude) > 90 || abs($longitude) > 180) {
            throw new RuntimeException("Incorrect geo-coordinates: [$latitude, $longitude]");
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }
}
