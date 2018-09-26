<?php

namespace Chetkov\YaMapsParser\Request;

use Chetkov\YaMapsParser\Model\Point;

/**
 * Class CircleSearchRequest
 * @package Chetkov\YaMapsParser\Request
 */
class CircleSearchRequest extends BaseRequest
{
    /**
     * @var Point
     */
    private $centerPoint;

    /**
     * @var string
     */
    private $radius;

    /**
     * @var bool
     */
    private $isLimitedByRadius;

    /**
     * CircleSearchRequest constructor.
     * @param string $searchText
     * @param Point $centerPoint
     * @param string $radius
     * @param bool $isLimitedByRadius
     */
    public function __construct(string $searchText, Point $centerPoint, string $radius, bool $isLimitedByRadius = true)
    {
        parent::__construct($searchText);
        $this->centerPoint = $centerPoint;
        $this->radius = $radius;
        $this->isLimitedByRadius = $isLimitedByRadius;
    }

    /**
     * @return Point
     */
    public function getCenterPoint(): Point
    {
        return $this->centerPoint;
    }

    /**
     * @return string
     */
    public function getRadius(): string
    {
        return $this->radius;
    }

    /**
     * @return bool
     */
    public function isLimitedByRadius(): bool
    {
        return $this->isLimitedByRadius;
    }
}
