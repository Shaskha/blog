<?php

class Session
{
  public static function demarrerSession()
  {
    session_start();
  }
}

Session::demarrerSession();
var_dump($_SESSION);
