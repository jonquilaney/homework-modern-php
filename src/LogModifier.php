<?php

declare(strict_types=1);

class LogModifier
{
    /**
     * @var \DecoratorInterface $decorator
     */
    private $decorator;

    /**
     * @var \FilterInterface $filter
     */
    private $filter;

    /**
     * @var \Stats $stats
     */
    private $stats;


    /**
     * LogModifier constructor.
     *
     * @param \DecoratorInterface $decorator
     * @param \FilterInterface    $filter
     * @param \Stats              $stats
     */
    public function __construct(DecoratorInterface $decorator, FilterInterface $filter, Stats $stats)
    {
        $this->decorator = $decorator;
        $this->filter = $filter;
        $this->stats = $stats;
    }


    /**
     * Run modification over given log.
     *
     * @param \Log $log
     */
    public function run(Log $log): void
    {
        foreach ($log->getRows() as $row) {
            $level = $this->decorator->format($row);
            if (!isset($level)) {
                continue;
            }

            $level = $this->filter->apply($level);
            if (!isset($level)) {
                continue;
            }
            if (trim($level) !== '') {
                $this->stats->addToList($level);
            }
        }
        $this->stats->printStats();
    }
}
