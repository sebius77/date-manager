# date-manager
application to manage dates

* Class Calendar hérite de DateManager

    - generateMonthCalendar(date $date) -----> To generate an array of month

        [

             'year' => $year,

            'monthNumber' => $monthNumber,

            'stringMonth' => $stringMonth,

            'weeksNumber' => $weeksNumber,

            'weeks' => $weeks ($weeks[$line][$yearOfDay . '-' . $monthNumberOfDay . '-' . $day] = $day (dayNumber))
        ]

    - generateWeekcalendar(datetime $date) ----> To generate an array of Week

        [

            id => 1 à 7 (for monday at Sunday),

            name => (Lundi, Mardi,...) french by default,

            alias => (Lun, Mar),

            date => (AAAA-MM-JJ)
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


