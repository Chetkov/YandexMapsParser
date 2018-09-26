<?php

namespace Chetkov\YaMapsParser\Model;

/**
 * Class Link
 * @package Chetkov\YaMapsParser\Model
 */
class Link
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $aref;

    /**
     * @var string
     */
    private $href;

    /**
     * Link constructor.
     * @param string $type
     * @param string $href
     */
    public function __construct(string $type, string $href)
    {
        $this->type = $type;
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }

    /**
     * @return null|string
     */
    public function getAref(): ?string
    {
        return $this->aref;
    }

    /**
     * @param string $aref
     * @return Link
     */
    public function setAref(string $aref): Link
    {
        $this->aref = $aref;
        return $this;
    }
}
