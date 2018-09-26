<?php

namespace Chetkov\YaMapsParser\Model;

/**
 * Class Place
 * @package Chetkov\YaMapsParser\Model
 */
class Place
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $shortName;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $workHours;

    /**
     * @var string[]
     */
    private $categories = [];

    /**
     * @var string[]
     */
    private $phones = [];

    /**
     * @var Link[]
     */
    private $links = [];

    /**
     * Place constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Place
     */
    public function setName(string $name): Place
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     * @return Place
     */
    public function setShortName(string $shortName): Place
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Place
     */
    public function setAddress(string $address): Place
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Place
     */
    public function setPostalCode(string $postalCode): Place
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Place
     */
    public function setUrl(string $url): Place
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getWorkHours(): ?string
    {
        return $this->workHours;
    }

    /**
     * @param string $workHours
     * @return Place
     */
    public function setWorkHours(string $workHours): Place
    {
        $this->workHours = $workHours;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param string[] $categories
     * @return Place
     */
    public function setCategories(array $categories): Place
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @param string[] $phones
     * @return Place
     */
    public function setPhones(array $phones): Place
    {
        $this->phones = $phones;
        return $this;
    }

    /**
     * @return Link[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param Link[] $links
     * @return Place
     */
    public function setLinks(array $links): Place
    {
        $this->links = $links;
        return $this;
    }
}
