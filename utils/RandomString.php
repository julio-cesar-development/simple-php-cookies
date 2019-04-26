<?php
  class RandomString {
    function generate($size){
      $stringCodes = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+@&%(){}[]';
      $stringReturn= '';
      for ($count = 0; $size > $count; $count ++) {
        $stringReturn .= $stringCodes[rand(0, strlen($stringCodes) - 1)];
      }
      return $stringReturn;
    }
  }
?>