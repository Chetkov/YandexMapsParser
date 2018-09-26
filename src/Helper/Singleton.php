<?php

namespace Chetkov\YaMapsParser\Helper;

/**
 * Trait Singleton
 * @package Chetkov\YaMapsParser\Helper
 */
trait Singleton
{
    /**
     * @var static
     */
    private static $instance;

    private function __construct()
    {
    }

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}