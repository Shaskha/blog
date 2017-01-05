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
    private $dbname;
    private $host;
    private $username;
    private $password;


    public function __construct ($host, $dbname, $username, $password)
    {
        $this -> host = $host;
        $this -> dbname = $dbname;
        $this -> username = $username;
        $this -> password = $password;

        $this -> setDatabase();
    }

    public function setDatabase ()
    {
        try
        {
            $this -> database = new PDO ('mysql:dbname='.$this -> dbname.';host='.$this -> host, $this -> username, $this -> password);
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
                if ($pdo_stmt == false)
                {
                    return true;
                }
                else
                {
                    return $pdo_stmt -> fetchall();
                }
            }
        }
    }

    public function getLastinsertedId ()
    {
        return $this -> database -> lastInsertId();
    }

}