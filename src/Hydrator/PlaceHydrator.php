<?php

namespace Chetkov\YaMapsParser\Hydrator;

use Chetkov\YaMapsParser\Helper\Singleton;
use Chetkov\YaMapsParser\Model\Link;
use Chetkov\YaMapsParser\Model\Place;

/**
 * Class PlaceHydrator
 * @package Chetkov\YaMapsParser\Hydrator
 */
class PlaceHydrator
{
    use Singleton;

    /**
     * @param Place $place
     * @return array
     */
    public function extract(Place $place): array
    {
        $links = [];
        foreach ($place->getLinks() as $link) {
            $links[] = $link->getHref();
        }

        return [
            'name'          => '"' . $place->getName() . '"',
            'short_name'    => '"' . $place->getShortName() . '"',
            'postal_code'   => '"' . $place->getPostalCode() . '"',
            'address'       => '"' . $place->getAddress() . '"',
            'url'           => '"' . $place->getUrl() . '"',
            'phones'        => '"' . implode(PHP_EOL, $place->getPhones()) . '"',
            'categories'    => '"' . implode(PHP_EOL, $place->getCategories()) . '"',
            'work_hours'    => '"' . $place->getWorkHours() . '"',
            'links'         => '"' . implode(PHP_EOL, $links) . '"',
        ];
    }

    /**
     * @param \stdClass $companyMetaData
     * @return Place
     */
    public function hydrate(\stdClass $companyMetaData): Place
    {
        $place = new Place($companyMetaData->id);

        if (!empty($companyMetaData->name)) {
            $place->setName($companyMetaData->name);
        }

        if (!empty($companyMetaData->shortName)) {
            $place->setShortName($companyMetaData->shortName);
        }

        if (!empty($companyMetaData->address)) {
            $place->setAddress($companyMetaData->address);
        }

        if (!empty($companyMetaData->postalCode)) {
            $place->setPostalCode($companyMetaData->postalCode);
        }

        if (!empty($companyMetaData->url)) {
            $place->setUrl($companyMetaData->url);
        }

        if (!empty($companyMetaData->Hours->text)) {
            $place->setWorkHours($companyMetaData->Hours->text);
        }

        if (!empty($companyMetaData->Categories)) {
            $categories = [];
            foreach ($companyMetaData->Categories as $category) {
                $categories[] = $category->name;
            }
            $place->setCategories($categories);
        }

        if (!empty($companyMetaData->Phones)) {
            $phones = [];
            foreach ($companyMetaData->Phones as $phone) {
                $phones[] = $phone->formatted;
            }
            $place->setPhones($phones);
        }

        if (!empty($companyMetaData->Links)) {
            $links = [];
            foreach ($companyMetaData->Links as $linkData) {
                $link = new Link($linkData->type, $linkData->href);
                if (isset($linkData->aref)) {
                    $link->setAref($linkData->aref);
                }
                $links[] = $link;
            }
            $place->setLinks($links);
        }

        return $place;
    }
}
