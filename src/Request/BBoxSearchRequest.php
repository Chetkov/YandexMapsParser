<?php

namespace Chetkov\YaMapsParser\Request;

use Chetkov\YaMapsParser\Model\Point;

/**
 * Class BBoxSearchRequest
 * @package Chetkov\YaMapsParser\Request
 */
class BBoxSearchRequest extends BaseRequest
{
    /**
     * @var Point
     */
    private $leftBottomPoint;

    /**
     * @var Point
     */
    private $rightTopPoint;

    /**
     * BBoxSearchRequest constructor.
     * @param string $searchText
     * @param Point $leftBottomPoint
     * @param Point $rightTopPoint
     */
    public function __construct(string $searchText, Point $leftBottomPoint, Point $rightTopPoint)
    {
        parent::__construct($searchText);
        $this->leftBottomPoint = $leftBottomPoint;
        $this->rightTopPoint = $rightTopPoint;
    }

    /**
     * @return Point
     */
    public function getLeftBottomPoint(): Point
    {
        return $this->leftBottomPoint;
    }

    /**
     * @return Point
     */
    public function getRightTopPoint(): Point
    {
        return $this->rightTopPoint;
    }
}
