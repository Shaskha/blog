<?php
class logs
{
  // public static function store($e)
  // {
  //   $date = new DateTime();
  //   $date -> setTimeZone (new DateTimeZone('EUROPE/PARIS'));
  //   $log = $date->format('Y-m-d h:i:s');
  //   $log = $log." ".($e -> getMessage())."".PHP_EOL;
  //   $log_file = fopen("logs/logs_".$date->format('d-m-Y').".log", "a+");
  //   fwrite($log_file, $log);
  //   fclose($log_file);
  // }

  public static function store_csv($e)
  {
    $date = new DateTime();
    $date -> setTimeZone (new DateTimeZone('EUROPE/PARIS'));
    $log = array(
      "date" => $date->format('Y-m-d h:i:s'),
      "error message" => $e -> getMessage()
                );
    $log_file = fopen("logs/logs_".$date->format('d-m-Y').".csv", "a+");
    fputcsv($log_file, $log, ",");
    fclose($log_file);
  }
}


try
{
  echo "fuck l'objet !";
  throw new Exception ("Error 404 - Brain Not Found");
}
catch(Exception $e)
{
  logs::store_csv($e);
}
