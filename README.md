# date-manager
application to manage dates

* Class Calendar

    - generateMonthCalendar(date $date) -----> To generate an array of month

        [

             'year' => $year,

            'monthNumber' => $monthNumber,

            'stringMonth' => $stringMonth,

            'weeksNumber' => $weeksNumber,

            'weeks' => $weeks ($weeks[$line][$yearOfDay . '-' . $monthNumberOfDay . '-' . $day] = $day (dayNumber))
        ]

* Class DateManager

    - getFirstDayOfYear(?int $year): DateTime
    - getFirstDayOfMonth(?int $year, ?int $monthNumber): DateTime
    - getLastDayOfMonth(?int $year, ?int $monthNumber): DateTime
    - getFirstWeek(?int $year, ?int $monthNumber): int
    - getMondayofWeekWithDate(DateTime $date): DateTime
    - getMondayOfWeekWithWeekNumber(int $weekNumber, int $year): DateTime
    - getWeeksNumberOfMonth(?int $year, ?int $monthNumber) :int
    - getDayNumber(DateTime $date)
    - function getDayString(DateTime $date): string


