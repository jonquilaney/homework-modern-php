<?php

declare(strict_types=1);

class Log
{
    /**
     * @var resource
     */
    private $handle;


    /**
     * Log constructor.
     *
     * @param string $filename
     *
     * @throws \InvalidInputFileException
     */
    public function __construct($filename = null)
    {
        if (!isset($filename)) {
            $this->handle = STDIN;
        } else {
            $handle = @fopen($filename, "r");
            if ($handle === false) {
                throw new InvalidInputFileException('Invalid input file');
            }
            $this->handle = $handle;
        }
    }


    /**
     * Get rows of Log.
     *
     * @return \Generator<string>
     */
    public function getRows(): \Generator
    {
        while ($line = fgets($this->handle)) {
            yield $line;
        }
        fclose($this->handle);
    }
}
