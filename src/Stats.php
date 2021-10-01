<?php

declare(strict_types=1);

class Stats
{
    /**
     * @var array<string, int> $list
     */
    private $list;

    public function __construct()
    {
        $this->list = array();
    }


    /**
     * Add level to statistics as new or increase count if already exists.
     *
     * @param string $level
     *
     * @return \Stats
     */
    public function addToList(string $level): self
    {
        if (array_key_exists($level, $this->list)) {
            $this->list[$level]++;
        } else {
            $this->list[$level] = 1;
        }

        return $this;
    }


    /*
     * Print statistics.
     */
    public function printStats(): void
    {
        arsort($this->list);
        foreach ($this->list as $level => $count) {
            echo "$level: $count" . PHP_EOL;
        }
        echo PHP_EOL;
    }
}
