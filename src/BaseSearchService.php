<?php

namespace Chetkov\YaMapsParser;

use Chetkov\YaMapsParser\Hydrator\BaseRequestHydrator;
use Chetkov\YaMapsParser\Request\BaseRequest;
use Chetkov\YaMapsParser\Translator\ResponseTranslator;
use Chetkov\YaMapsParser\Model\Place;

/**
 * Class BaseSearchService
 * @package Chetkov\YaMapsParser
 */
abstract class BaseSearchService
{
    protected const DEFAULT_API_URL = 'https://search-maps.yandex.ru/v1/';

    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var BaseRequestHydrator
     */
    protected $requestHydrator;

    /**
     * @var ResponseTranslator
     */
    protected $responseTranslator;

    /**
     * BaseSearchService constructor.
     * @param BaseRequestHydrator $requestHydrator
     * @param ResponseTranslator $responseTranslator
     * @param string $apiKey
     * @param string $apiUrl
     */
    public function __construct(
        BaseRequestHydrator $requestHydrator,
        ResponseTranslator $responseTranslator,
        string $apiKey,
        string $apiUrl = self::DEFAULT_API_URL
    ) {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->requestHydrator = $requestHydrator;
        $this->responseTranslator = $responseTranslator;
    }

    /**
     * @param $request
     * @return Place[]
     */
    protected function getPlaces(BaseRequest $request): array
    {
        $params = $this->requestHydrator->extract($request);
        $response = $this->execute($params);
        return $this->responseTranslator->translate($response);
    }

    /**
     * @param array $params
     * @return \stdClass[]
     */
    protected function execute(array $params): array
    {
        $query = http_build_query(array_merge(['apikey' => $this->apiKey], $params));
        $requestUrl = $this->apiUrl . '?' . $query;

        $response = file_get_contents($requestUrl);
        if (!$response) {
            throw new \RuntimeException("Error response. Request: $requestUrl");
        }

        $response = json_decode($response);
        if (json_last_error()) {
            throw new \RuntimeException(json_last_error_msg());
        }

        if (empty($response->features)) {
            throw new \RuntimeException('FEATURES is empty. ' . json_encode($response));
        }

        return $response->features;
    }
}
