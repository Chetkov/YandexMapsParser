<?php

namespace Chetkov\YaMapsParser\Hydrator;

use Chetkov\YaMapsParser\Request\BaseRequest;

/**
 * Class BaseRequestHydrator
 * @package Chetkov\YaMapsParser\Hydrator
 */
abstract class BaseRequestHydrator
{
    /**
     * @param BaseRequest $request
     * @return array
     */
    public function extract(BaseRequest $request): array
    {
        $result = [
            'text' => $request->getSearchText(),
            'lang' => $request->getLang(),
            'results' => $request->getLimit(),
            'skip' => $request->getOffset(),
        ];

        return array_merge($result, $this->extractSpecificFields($request));
    }

    /**
     * @param BaseRequest $request
     * @return array
     */
    abstract protected function extractSpecificFields($request): array;
}
