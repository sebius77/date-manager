<?php

namespace Sebius77\DateManager\App\Calendar;

use DateTime;
use Sebius77\DateManager\App\DateManager\DateManager;
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
     * Retourne un tableau représentant un mini calendrier sur 1 mois
     * @Param $monthNumber  // date sélectionnée dans le calendrier
     * @Param $year // Indique s'il s'agit de la semaine actuelle, précédente ou future
     */
    public function generateMiniCal($monthNumber = null, $year = null)
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

    public function generateWeekCalendar(DateTime $date) {
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

    /*
    public function generateMiniCal()
    {
        $string = '';
        $weeksNumber = $this->getWeeksNumberOfMonth();
        $days = $this->getDaysMapping();
        $firstWeek = $this->getFirstWeek();
        $monday = $this->getMondayOfWeekWithDate($this->getFirstDayOfMonth());

        $string .='<tr><th>LUN</th><th>MAR</th><th>MER</th><th>JEU</th><th>VEN</th><th>SAM</th><th>DIM</th></tr>';

        $string .= '<tr id="week-' . $firstWeek . '">';
        for ($i = 0; $i < $weeksNumber; $i++) {
            foreach ($days as $k=>$day) {
                $date = (clone $monday)->modify("+" . ($k + $i * 7) . " day");

                $aaaammjj = $date->format('Y')
                    . '-' . $date->format('m')
                    . '-' . $date->format('d');
            
                if (intval($date->format('n')) !== intval($this->getMonthNumber())) {
                    $string .= '<td id="day-'. $aaaammjj .'" class="minicalDay" style="color: gray;" onclick="selectDay(this)">'
                        . $date->format('d') . '</td>';
                } else {
                    $string .= '<td id="day-'.$aaaammjj.'" class="minicalDay" style="color: black;" onclick="selectDay(this)">'
                        . $date->format('d') . '</td>';
                }

                if ($k === 6) {
                    $cloneDate = clone($date->modify('+ 1 week'));
                    $string .= '</tr><tr id="week-' . ($cloneDate->format('W')). '" class="minicalWeek">';
                }
            }
        }
        return $string;
    }
    */

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