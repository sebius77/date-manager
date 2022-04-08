<?php

namespace Sebius77\DateManager\App;

use DateTime;
use Sebius77\DateManager\App\DateManager;
use Sebius77\DateManager\Config\Days;
use Sebius77\DateManager\Config\Months;

class Calendar extends DateManager
{
    protected Datetime $givenDate;
    protected Datetime $currentDate;
    protected int $year;

    public function __construct(DateTime $date)
    {
        $this->givenDate = $date;
        $this->daysMapping = Days::getDays();
        $this->monthsMapping = Months::getMonths();
        // Vérification si l'année correspond à l'année en cours, sinon Exception
    }

    /**
     * Retourne un tableau représentant un calendrier sur 1 mois
     * @Param $monthNumber  // date sélectionnée dans le calendrier
     * @Param $year // Indique s'il s'agit de la semaine actuelle, précédente ou future
     */
    public function generateMonthCalendar(?int $monthNumber = null, ?int $year = null): array
    {
        $weeks = [];
        if (is_null($monthNumber)) {
            $monthNumber = intval($this->getMonthNumber($this->givenDate));
        }

        if (is_null($year)) {
            $year = intval($this->getYear($this->givenDate));
        }

        $date = new DateTime($year . '-' . $monthNumber . '-' . '01');

        $stringMonth = $this->getMonthString($date);
        $weeksNumber = $this->getWeeksNumberOfMonth($year, $monthNumber);
        
        $days = $this->getDaysMapping();
        $mondayOfMonth = $this->getMondayOfWeekWithDate($date);

        for ($line = 0; $line < $weeksNumber; $line++) {
            foreach ($days as $k => $detail) {
                $date = (clone $mondayOfMonth)->modify("+" . ($k + $line * 7) . " day");
                $day = $this->getDayNumber($date);
                $monthNumberOfDay = $this->getMonthNumber($date);
                $yearOfDay = $this->getYear($date);
                $weeks[$line][$yearOfDay . '-' . $monthNumberOfDay . '-' . $day] = $day; 
            }
        }

        return [
            'year' => $year,
            'monthNumber' => $monthNumber,
            'stringMonth' => $stringMonth,
            'weeksNumber' => $weeksNumber,
            'weeks' => $weeks
        ];   
    }

    public function generateWeekCalendar(?DateTime $date = null): array
    {
        if (is_null($date)) {
            $date = new DateTime();
        }
        $weekDays = [];
        $days = $this->getDaysMapping();
        $mondayOfWeek = $this->getMondayOfWeekWithDate($date);
        foreach ($days as $dayIndex => $detail) {
            $date = (clone $mondayOfWeek)->modify("+" . $dayIndex . " day");
            $dayNumber = $this->getDayNumber($date);
            $yearOfDay = $this->getYear($date);
            $monthOfDay = $this->getMonthNumber($date);
            $weekDays[$yearOfDay . '-' . $monthOfDay . '-' . $dayNumber] = $detail;
        }
        return $weekDays;
    }

    /**
     * Get the value of givenDate
     */ 
    public function getGivenDate()
    {
        return $this->givenDate;
    }

    /**
     * Set the value of givenDate
     *
     * @return  self
     */ 
    public function setGivenDate($givenDate)
    {
        $this->givenDate = $givenDate;

        return $this;
    }

    /**
     * Get the value of currentDate
     */ 
    public function getCurrentDate()
    {
        return $this->currentDate;
    }

    /**
     * Set the value of currentDate
     *
     * @return  self
     */ 
    public function setCurrentDate($currentDate)
    {
        $this->currentDate = $currentDate;

        return $this;
    }
}