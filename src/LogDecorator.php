<?php

declare(strict_types=1);

class LogDecorator
{
    /**
     * @var string $pattern
     */
    private $pattern;

    /**
     * @var array<string> $filters
     */
    private $filters = [];

    /**
     * @var array<string, int> $stats
     */
    private $stats = [];

    /**
     * LogDecorator constructor.
     *
     * @param string $pattern
     */
    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }


    /**
     * Add filters to array of filters.
     *
     * @param array<string> $filters
     *
     * @return \LogDecorator
     */
    public function addFilter(array $filters): self
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }




    /**
     * Run decorator over given log data.
     *
     * @param \Log $log
     */
    public function run(Log $log): void
    {
        $filter = function ($filters, $text) {
            return str_replace($filters, '', $text);
        };

        $lineFormat = function ($text): ?string {
            if ((bool)preg_match($this->pattern, $text, $matches)) {
                return strtolower($matches[1]);
            }
            return null;
        };

        $addToStats = function ($level): void {
            if (array_key_exists($level, $this->stats)) {
                $this->stats[$level]++;
            } else {
                $this->stats[$level] = 1;
            }
        };

        $printStats = function (): void {
            arsort($this->stats);
            foreach ($this->stats as $level => $count) {
                echo "$level: $count" . PHP_EOL;
            }
            echo PHP_EOL;
        };

        $time = time();
        foreach ($log->getRows() as $row) {
            $level = $lineFormat($row);

            if (!isset($level)) {
                continue;
            }

            $level = $filter($this->filters, $level);

            if (trim($level) !== '') {
                $addToStats($level);
            }
            if (time() - $time >= 1) {
                $printStats();
                $time = time();
            }
        }
        $printStats();
    }
}
