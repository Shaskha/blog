<?php
session_start();
$_SESSION['user_id'] = 1;
require ('classes/autoLoad.class.php');
spl_autoload_register('autoLoad::classesAutoLoader');

try
{
    $article = new Article();
    $article -> showArticle(1);
    $article ->createArticle($_SESSION['user_id'], "article test 3.14", "Pi il t'emmerde", "rien a ajouter ! --'");

}
catch(Exception $e)
{
//  Logs::store("csv", $e);
    Logs::store("csv", $e);
}
