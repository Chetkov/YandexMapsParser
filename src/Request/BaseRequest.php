<?php

namespace Chetkov\YaMapsParser\Request;

/**
 * Class BaseRequest
 * @package Chetkov\YaMapsParser\Request
 */
abstract class BaseRequest
{
    /**
     * Русский (по умолчанию)
     */
    public const LANGUAGE_RU_RU = 'ru_RU';

    /**
     * Украинский
     */
    public const LANGUAGE_UK_UA = 'uk_UA';

    /**
     * Белорусский
     */
    public const LANGUAGE_BE_BY = 'be_BY';

    /**
     * Американский
     */
    public const LANGUAGE_EN_RU = 'en_RU';

    /**
     * Американский английский
     */
    public const LANGUAGE_EN_US = 'en_US';

    /**
     * Турецкий (только для карты Турции)
     */
    public const LANGUAGE_TR_TR = 'tr_TR';

    /**
     * @var string
     */
    private $searchText;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var int
     */
    private $limit;
    /**
     * @var int
     */
    private $offset;

    /**
     * BaseRequest constructor.
     * @param string $searchText
     * @param string $lang
     * @param int $limit
     * @param int $offset
     */
    public function __construct(string $searchText, string $lang = self::LANGUAGE_RU_RU, int $limit = 500, int $offset = 0)
    {
        $this->searchText = $searchText;
        $this->lang = $lang;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getSearchText(): string
    {
        return $this->searchText;
    }

    /**
     * @param string $searchText
     * @return BaseRequest
     */
    public function setSearchText(string $searchText): BaseRequest
    {
        $this->searchText = $searchText;
        return $this;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     * @return BaseRequest
     */
    public function setLang(string $lang): BaseRequest
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return BaseRequest
     */
    public function setLimit(int $limit): BaseRequest
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return BaseRequest
     */
    public function setOffset(int $offset): BaseRequest
    {
        $this->offset = $offset;
        return $this;
    }
}
