<?php

namespace Sebius77\DateManager\App\DateManager;

use DateTime;
use Sebius77\DateManager\Config\Days;
use Sebius77\DateManager\Config\Months;

abstract class DateManager
{
    protected array $daysMapping;
    protected array $monthsMapping;

    /**
     * Retourne le premier jour de l'année
     */
    public function getFirstDayOfYear(?int $year): DateTime
    {
        if (is_null($year)) {
            $year = $this->getYear();
        }
        return new \DateTime("{$year}-01-01");
    }

    /**
     * Retourne la date du premier jour du mois
     */
    public function getFirstDayOfMonth(?int $year, ?int $monthNumber): DateTime
    {
        if (is_null($year)) {
            $year = $this->getYear();
        }
        if (is_null($monthNumber)) {
            $monthNumber = $this->getMonthNumber();
        }
        return new \DateTime("{$year}-{$monthNumber}-01");
    }

    public function getLastDayOfMonth(?int $year, ?int $monthNumber)
    {
        if (is_null($year)) {
            $year = $this->getYear();
        }
        if (is_null($monthNumber)) {
            $monthNumber = $this->getMonthNumber();
        }
        return (clone $this->getFirstDayOfMonth($year, $monthNumber))->modify(' +1 month -1 day');
    }

    /**
     * Retourne le numéro de la première semaine du mois
     */
    public function getFirstWeek(?int $year, ?int $monthNumber): int
    {
        return $this->getFirstDayOfMonth($year, $monthNumber)->format('W');
    }

    /**
     * Retourne la date du lundi de la semaine en fonction d'une date donnée
     */
    public function getMondayofWeekWithDate(DateTime $date): DateTime
    {
        if ($date->format('w') !== "1") {
            $date = clone($date)->modify('last monday');
        }
        return $date;
    }

    /**
     * Retourne la date du lundi de la semaine en fonction d'un numéro de semaine
     */
    public function getMondayOfWeekWithWeekNumber(int $weekNumber, int $year): DateTime
    {
        $firstDateYear = $this->getFirstDayOfYear($year);
        $monday = clone($firstDateYear);
        $day = intval($monday->format('w'));

        // Dans le cas ou le 1er jour n'est pas un lundi
        if ($day !== 1) {
            $monday->modify(' last monday');
        }

        // On récupère la semaine du premier lundi
        $firstWeek = intval($monday->format('W'));

        // Dans le cas ou la semaine n'est pas la première de l'année (Le jour 1 n'est pas un lundi)
        if ($firstWeek !== 1) {
            $monday->modify(' +' . (intval($weekNumber)) . ' week');
        }
        return $monday->modify('+' . (intval($weekNumber) - 1) . ' week');
    }

    /**
     * Retourne le nombre de semaine du mois
     */
    public function getWeeksNumberOfMonth(?int $year, ?int $monthNumber) :int
    {
        $start = $this->getFirstDayOfMonth($year, $monthNumber);
        $end = $this->getLastDayOfMonth($year, $monthNumber);
        $cloneEnd = clone ($end);

        // Dans le cas ou la date de fin serait contenu dans la 1ère semaine de l'année
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
        return $weeksNumber;
    }

    /**
     * Get the value of dayNumber
     */ 
    public function getDayNumber(DateTime $date)
    {
        return $date->format('d');
    }

    /**
     * Get the value of dayString
     */ 
    public function getDayString(DateTime $date)
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
        return intval($date->format('n'));
    }

    /**
     * Get the value of monthString
     */ 
    public function getMonthString(DateTime $date)
    {
        foreach ($this->monthsMapping as $month) {
            if (intval($date->format('n')) === $month['id']) {
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
            if (intval($date->format('n')) === $month['id']) {
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