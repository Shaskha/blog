<?php

require ('classes/autoLoad.class.php');
spl_autoload_register('autoLoad::classesAutoLoader');

try
{
  echo "fuck l'objet !";
  throw new Exception ("Error 404 - Brain Not Found");

}
catch(Exception $e)
{
  logs::store_csv($e);
}
