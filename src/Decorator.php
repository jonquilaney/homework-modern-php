<?php

declare(strict_types=1);

class Decorator implements DecoratorInterface
{
    /**
     * @var string $pattern
     */
    private $pattern;

    /**
     * Decorator constructor.
     *
     * @param string $pattern
     */
    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * Decorate given text.
     *
     * @param string $text
     *
     * @return null|string
     */
    public function format(string $text): ?string
    {
        if ((bool)preg_match($this->pattern, $text, $matches)) {
            return strtolower($matches[1]);
        }

        return null;
    }
}
