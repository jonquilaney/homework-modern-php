<?php

declare(strict_types=1);

interface DecoratorInterface
{
    public function format(string $text): ?string;
}
