<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<?php

use Sebius77\DateManager\App\Calendar;

require '../config/Days.php';
require '../config/Months.php';
require '../src/DateManager.php';
require '../src/Calendar.php';

$now = new DateTime();
$minical = new Calendar();

/*
$now = $now->modify('+1 month');
$minical = new Calendar($now);
*/
$date = new DateTime();
$minical = new Calendar($date);

//$calendrier = $minical->generateMiniCal(4, 2022);
//die(var_dump($calendrier));
$week = $minical->generateWeekCalendar($date);
die(var_dump($week));

?>
