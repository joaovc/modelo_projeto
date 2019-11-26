<?php
namespace Src\Traits;

trait Filter{

  public static function post($key = null, $filter = null){  
    if (isset($_POST[$key])){
      if(empty($_POST[$key])){
        return false;
      }elseif(function_exists('filter_input')){
        $var = $filter ? filter_input(INPUT_POST, $key, $filter) : filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        if(is_string($var)){$var = trim($var);}
        return $var;
      }return false;
    }return false;
  }

}