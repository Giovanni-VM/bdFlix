<?php

function valida_login($str){
  $pt = "/^[a-zA-Z0-9]{1,48}$/";
  return preg_match($pt, $str);
}

function valida_senha($str){
  $pt = "/^[a-zA-Z0-9$%#_\^&! -]{1,48}$/";
  return preg_match($pt, $str);
}

?>
