<?php

declare(strict_types=1);

interface FilterInterface
{
    public function apply(string $text): ?string;
}
