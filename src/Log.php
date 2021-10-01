<?php

declare(strict_types=1);

class Log
{
    /**
     * @var array<int, string> $rows
     */
    private $rows;


    /**
     * Log constructor.
     *
     * @param string $filename
     *
     * @throws \InvalidInputFileException
     */
    public function __construct(string $filename)
    {
        $file = @file_get_contents($filename);
        if ($file === false) {
            throw new InvalidInputFileException('Invalid input file');
        }
        $this->rows = explode(PHP_EOL, $file);
    }


    /**
     * Get rows of Log.
     *
     * @return array<int, string>
     */
    public function getRows(): array
    {
        return $this->rows;
    }
}
