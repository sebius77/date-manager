<?php

namespace Sebius77\DateManager\App;

use DateTime;
use Sebius77\DateManager\App\DateManager;

class Calendar extends DateManager
{
    /**
     * Return an array with a calendar on the month
     * @Param $monthNumber
     * @Param $year 
     */
    public function generateMonthCalendar($date = null): array
    {
        $weeks = [];

        if (is_null($date)) {
            $date = new DateTime();
        }

        // Get monthNumber (1-12), Get year (XXXX);
        $monthNumber = intval($this->getMonthNumber($date));
        $year = intval($this->getYear($date));
        
        // Get The first Day of Month
        $date = new DateTime($year . '-' . $monthNumber . '-' . '01');

        // Get The name of month (Janvier, Février, Mars, ...)
        $stringMonth = $this->getMonthString($date);

        // Get The number of weeks for the month
        $weeksNumber = $this->getWeeksNumberOfMonth($year, $monthNumber);
        
        // Get the days array
        $days = $this->getDaysMapping();

        // Get the first month monday
        $mondayOfMonth = $this->getMondayOfWeekWithDate($date);

        // Generate weeks of month
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

    // Generate a week array
    // [ANNEE - MOIS - JOUR] = [id jour (id), nom du jour (name), alias du jour (Lun, Mar,...) (alias) ]
    // $atDay Lundi: 1, Mardi: 2, Mercredi: 3, semaine jusqu'au jour X
    public function generateWeekCalendar(?DateTime $date = null, $atDay = null): array
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
            $dayDate = $yearOfDay . '-' . $monthOfDay . '-' . $dayNumber;
            $detail['date'] = $dayDate;
            $weekDays[] = $detail;
            if ($atDay == $dayNumber) {
                return $weekDays;
            }
        }
        return $weekDays;
    }

    /**
     * Get the value of daysMapping
     */
    public function getDaysMapping()
    {
        return $this->daysMapping;
    }

    /**
     * Get the value of monthsMapping
     */
    public function getMonthsMapping()
    {
        return $this->monthsMapping;
    }
}
