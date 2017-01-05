<?php

require ('classes/autoLoad.class.php');
spl_autoload_register('autoLoad::classesAutoLoader');

try
{
    $user = new User ("quentin-hedouin@orange.fr", "vtff !!!");
    var_dump($user);

}
catch(Exception $e)
{
//  Logs::store("csv", $e);
    Logs::store("csv", $e);
}
