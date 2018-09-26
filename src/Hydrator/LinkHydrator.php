<?php

namespace Chetkov\YaMapsParser\Hydrator;

use Chetkov\YaMapsParser\Model\Link;

/**
 * Class LinkHydrator
 * @package Chetkov\YaMapsParser\Hydrator
 */
class LinkHydrator
{
    /**
     * @param \Chetkov\YaMapsParser\Model\Link $link
     * @return array
     */
    public static function extract(Link $link): array
    {
        return [
            'type' => $link->getType(),
            'aref' => $link->getAref(),
            'href' => $link->getHref(),
        ];
    }
}
