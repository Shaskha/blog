<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 04/01/2017
 * Time: 14:09
 */

class logs
{
    public static function store ($type, $e)
    {
        if ($type='txt')
        {
            static::storetxt($e);
        }
        elseif ($type="csv")
        {
            static::storecsv($e);
        }
        else
        {
            throw new Exception ('format de log non valide');
        }
    }

    public static function errormessage($e)
    {
        if (gettype($e)=='object')
        {
            $e = $e -> getMessage()
        }
        return $e;
    }

     public static function storetxt($e)
     {
       $date = new DateTime();
       $date -> setTimeZone (new DateTimeZone('EUROPE/PARIS'));
       $log = $date->format('Y-m-d h:i:s');
       $log = $log." ".(static::errormessage($e))."".PHP_EOL;
       $log_file = fopen("logs/logs_".$date->format('d-m-Y').".log", "a+");
       fwrite($log_file, $log);
       fclose($log_file);
     }

    public static function storecsv($e)
    {
        $date = new DateTime();
        $date -> setTimeZone (new DateTimeZone('EUROPE/PARIS'));
        $log = array($date->format('Y-m-d h:i:s'), static::errormessage($e);
        $log_file = fopen("logs/logs_".$date->format('d-m-Y').".csv", "a+");
        fputcsv($log_file, $log, ",");
        fclose($log_file);
    }
}