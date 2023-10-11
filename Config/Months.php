<?php

namespace Sebius77\DateManager\Config;

class Months
{
    public static function getMonths()
    {
        $months = [
            [
                'id'    =>  1,
                'nom'   =>  'Janvier',
                'alias' =>  'Jan'
            ],
            [
                'id'    =>  2,
                'nom'   =>  'Février',
                'alias' =>  'Fév'
            ],
            [
                'id'    =>  3,
                'nom'   =>  'Mars',
                'alias' => 'Mar'
            ],
            [
                'id'    =>  4,
                'nom'   =>  'Avril',
                'alias' => 'Avr'
            ],
            [
                'id'    =>  5,
                'nom'   =>  'Mai',
                'alias' => 'Mai'
            ],
            [
                'id'    =>  6,
                'nom'   =>  'Juin',
                'alias' => 'Juin'
            ],
            [
                'id'    =>  7,
                'nom'   =>  'Juillet',
                'alias' => 'Juil'
            ],
            [
                'id'    =>  8,
                'nom'   =>  'Août',
                'alias' => 'Août'
            ],
            [
                'id'    =>  9,
                'nom'   =>  'Septembre',
                'alias' => 'Sept'
            ],
            [
                'id'    =>  10,
                'nom'   =>  'Octobre',
                'alias' => 'Oct'
            ],
            [
                'id'    =>  11,
                'nom'   =>  'Novembre',
                'alias' => 'Nov'
            ],
            [
                'id'    =>  12,
                'nom'   =>  'Décembre',
                'alias' => 'Déc'
            ]
        ];
        return $months;
    }
}