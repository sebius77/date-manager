<?php

namespace Sebius77\DateManager\App;

use DateTime;
use Sebius77\DateManager\Config\Days;
use Sebius77\DateManager\Config\Months;

abstract class DateManager
{
    protected $daysMapping;
    protected $monthsMapping;

    public function __construct()
    {
        $this->daysMapping = Days::getDays();
        $this->monthsMapping = Months::getMonths();
    }
    
    /**
     * Return the first day of year
     */
    public function getFirstDayOfYear(?int $year): DateTime
    {
        return new \DateTime("{$year}-01-01");
    }

    /**
     * Return the first day of month
     */
    public function getFirstDayOfMonth(?int $year, ?int $monthNumber): DateTime
    {
        return new \DateTime("{$year}-{$monthNumber}-01");
    }

    /**
     * Return the last day of month
     */
    public function getLastDayOfMonth(?int $year, ?int $monthNumber): DateTime
    {
        return (clone $this->getFirstDayOfMonth($year, $monthNumber))->modify(' +1 month -1 day');
    }

    /**
     * Return the number of the first month's week
     */
    public function getFirstWeek(?int $year, ?int $monthNumber): int
    {
        return $this->getFirstDayOfMonth($year, $monthNumber)->format('W');
    }

    /**
     * Return date of the week's monday with a given date
     */
    public function getMondayofWeekWithDate(DateTime $date): DateTime
    {
        if ($date->format('w') !== "1") {
            $date = clone($date)->modify('last monday');
        }
        return $date;
    }

    /**
     * Return date of week's monday with a week number
     */
    public function getMondayOfWeekWithWeekNumber(int $weekNumber, int $year): DateTime
    {
        $firstDateYear = $this->getFirstDayOfYear($year);
        $monday = clone($firstDateYear);
        $day = intval($monday->format('w'));

        // If the first day of week is not a monday
        if ($day !== 1) {
            $monday->modify(' last monday');
        }

        // Get the week of first monday
        $firstWeek = intval($monday->format('W'));

        // If the week is not first in the year (The day 1 is not a monday)
        if ($firstWeek !== 1) {
            $monday->modify(' +' . (intval($weekNumber)) . ' week');
        }
        return $monday->modify('+' . (intval($weekNumber) - 1) . ' week');
    }

    /**
     * Return the number of month's week
     */
    public function getWeekNumberOfMonth(?int $year, ?int $monthNumber) :int
    {
        $start = $this->getFirstDayOfMonth($year, $monthNumber);
        $end = $this->getLastDayOfMonth($year, $monthNumber);
        $cloneEnd = clone ($end);

        // If the end date is in the first week of year
        if (intval($end->format('W')) === 1) {
            $cloneEnd->modify('- 1 week');
            $weekEnd = intval($cloneEnd->format('W')) + 1;
        } else {
            $weekEnd = intval($end->format('W'));
        }

        $weeksNumber = $weekEnd - intval($start->format('W')) + 1;

        if ($weeksNumber < 0) {
            $weeksNumber = intval($end->format('W')) + 1;
        }
        return $weekNumber;
    }

    /**
     * Get the value of dayNumber
     */ 
    public function getDayNumber(DateTime $date): int
    {
        return $date->format('d');
    }

    /**
     * Get the value of dayString
     */ 
    public function getDayString(DateTime $date): string
    {
        foreach ($this->daysMapping as $day) {
            if (intval($date->format('N')) === $day['id']) {
                return $day['nom'];
            }
        }
    }

    /**
     * Get the value of dayAlias
     */ 
    public function getDayAlias(DateTime $date)
    {
        foreach ($this->daysMapping as $day) {
            if (intval($date->format('N')) === $day['id']) {
                return $day['alias'];
            }
        }
    }

    /**
     * Get the value of monthNumber
     */ 
    public function getMonthNumber(DateTime $date)
    {
        return intval($date->format('m'));
    }

    /**
     * Get the value of monthString
     */ 
    public function getMonthString(DateTime $date)
    {
        foreach ($this->monthsMapping as $month) {
            if (intval($date->format('m')) === $month['id']) {
                return $month['nom'];
            }   
        }
    }

    /**
     * Get the value of monthAlias
     */ 
    public function getMonthAlias(DateTime $date)
    {
        foreach ($this->monthsMapping as $month) {
            if (intval($date->format('m')) === $month['id']) {
                return $month['alias'];
            }   
        }
    }

    /**
     * Get the value of year
     */ 
    public function getYear(DateTime $date)
    {
        return $date->format('Y');
    }

    /**
     * Get the value of weekNumber
     */ 
    public function getWeekNumber(DateTime $date)
    {
        return $date->format('W');
    }

    /**
     * Get the value of monthsMapping
     */ 
    public function getMonthsMapping()
    {
        return $this->monthsMapping;
    }

    /**
     * Set the value of monthsMapping
     *
     * @return  self
     */ 
    public function setMonthsMapping($monthsMapping)
    {
        $this->monthsMapping = $monthsMapping;

        return $this;
    }

    /**
     * Get the value of daysMapping
     */ 
    public function getDaysMapping()
    {
        return $this->daysMapping;
    }

    /**
     * Set the value of daysMapping
     *
     * @return  self
     */ 
    public function setDaysMapping($daysMapping)
    {
        $this->daysMapping = $daysMapping;

        return $this;
    }
}