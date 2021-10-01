<?php

declare(strict_types=1);

class Filter implements FilterInterface
{
    /**
     * @var array<string> $filters
     */
    private $filters;


    /**
     * Filter constructor.
     *
     * @param array<string> $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }


    /**
     * Apply filters on given string
     *
     * @param string $text
     *
     * @return string
     */
    public function apply(string $text): string
    {
        return str_replace($this->filters, '', $text);
    }
}
