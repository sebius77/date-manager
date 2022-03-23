<?php

namespace Sebius77\DateManager\Config;

class Days {
    public static function getDays() {
        $days = [
            [
                'id'    =>  1,
                'nom'   =>  'Lundi',
                'alias' =>  'Lun'
            ],
            [
                'id'    =>  2,
                'nom'   =>  'Mardi',
                'alias' =>  'Mar'
            ],
            [
                'id'    =>  3,
                'nom'   =>  'Mercredi',
                'alias' =>  'Mer'
            ],
            [
                'id'    =>  4,
                'nom'   =>  'Jeudi',
                'alias' =>  'Jeu'
            ],
            [
                'id'    =>  5,
                'nom'   =>  'Vendredi',
                'alias' =>  'Ven'
            ],
            [
                'id'    =>  6,
                'nom'   =>  'Samedi',
                'alias' =>  'Sam'
            ],
            [
                'id'    =>  7,
                'nom'   =>  'Dimanche',
                'alias' =>  'Dim'
            ]
        ];
        return $days;    
    }
}

