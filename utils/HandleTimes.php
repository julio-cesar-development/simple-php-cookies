<?php

  class HandleTimes {
    
    function time_to_sec($time) {
        $hours = substr($time, 0, -6);
        $minutes = substr($time, -5, 2);
        $seconds = substr($time, -2);

        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    function sec_to_time($seconds) {
        if ($seconds < 0) {
            $seconds = $seconds * -1;
        }
        $hours = floor($seconds / 3600);
        $minutes = floor($seconds % 3600 / 60);
        $seconds = $seconds % 60;

        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
    }

    function data_to_timestamp($data) {
        $dia = date("Y-m-d", strtotime($data));
        $dia = explode('-', ($dia));
        $hora = date("H:i:s", strtotime($data));
        $hora = explode(':', ($hora));
        
        return mktime($hora[0], $hora[1], $hora[2], $dia[1], $dia[2], $dia[0]);
    }
    
  }
  
?>
