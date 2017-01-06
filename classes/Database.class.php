<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 05/01/2017
 * Time: 14:11
 */
class Database
{
    private $database;
    private $dbname = "blog";
    private $host = "localhost";
    private $username = "root";
    private $password = "";


    public function __construct ()
    {
        $this -> setDatabase();
    }

    private function setDatabase ()
    {
        try
        {
            $this -> database = new PDO ('mysql:dbname='.$this -> dbname.';host='.$this -> host, $this -> username, $this -> password);
            $this -> database -> exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            Logs::store("csv", $e);
        }
    }

    public function request ($request_string, $arguments_array="")
    {
        if ($arguments_array == "")
        {
            $this -> database -> query ($request_string);
        }
        else
        {
            $pdo_stmt = $this -> database -> prepare ($request_string);
            $result = $pdo_stmt -> execute ($arguments_array);
            if ($result == false)
            {
                return false; //on retourne faux si il y a eu une erreur sur la requête
            }
            else
            {
                $result = $pdo_stmt -> fetchall();
                if ($result == false)
                {
                    return true;
                }
                else
                {
                    return $result;
                }
            }
        }
    }

    public function getLastinsertedId ()
    {
        return $this -> database -> lastInsertId();
    }

}