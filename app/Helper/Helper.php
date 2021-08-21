<?php

namespace App\Helper;
use Carbon\Carbon;



class Helper {

    public static function moviedateformat ($date) {

        return Carbon::parse($date)->format('M d, Y');

    }

    public static function movievotepercent($vote) {
        
        return $vote * 10 . '%'; 
    }

    public static function actorageformat ($date) {

        return Carbon::parse($date)->age;

    }
}

