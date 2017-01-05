<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 05/01/2017
 * Time: 09:35
 */
class User
{
    private $database;
    private $nickname;
    private $password;
    private $email;
    private $id;
    private $lastname;
    private $firstname;
    private $admin;
    private $error;


    public function __construct($email, $password)
    {
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL)))
        {
            throw new Exception('email invalide');
        }
        try
        {
            $this -> database = new PDO ('mysql:dbname=testdb;host=127.0.0.1', "root", "");
        }
        catch (PDOException $e)
        {
            Logs::store('csv', $e);
        }
        $this -> email = $$email;
        $this -> password = $password;
    }

    public function checkdatas ($nickname, $lastname, $firstname)
    {
        if ($nickname == "")
        {
            $this -> error = true;
        }
        if ($firstname == "")
        {
            $this -> error = true;
        }
        if ($lastname == "")
        {
            $this -> error = true;
        }

        if ($this -> error == true)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function signin ($nickname, $lastname, $firstname)
    {
        if ($this -> checkdatas($nickname, $lastname, $firstname))
        {
            $request = $this -> database->prepare('select * from users where email = :email');
            $request -> execute(array("email" => $this -> email));
            if ($request != false)
            {
                $insert = $this -> database -> prepare ('Insert into users (nickname, firstname, lastname, password, email)
                                                          values (:nickname, :firstname, :lastname, sha1(:password), :email)');
                $success = $insert -> execute (array(
                    "nickname" => $nickname,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "password" => $this -> password,
                    "email" => $this -> email
                ));

                if (!$success)
                {
                    throw new Exception ('erreur requête');
                }
            }
            else
            {
                throw new Exception ('email deja utilisé');
            }

        }
        else
        {
            return false;
        }
    }

    public function login ()
    {
        $request = $this -> database->prepare('select * from users where email = :email and password = sha1(:password)');
        $request -> execute(array(
                            "email" => $this -> email,
                            "password" => $this -> password
                            ));

        if ($request != false)
        {
            $request = $request -> fetch();
            session_start();
            $_SESSION['nickname'] = $request['nickname'];
            $_SESSION['firstname'] = $request['firstname'];
            $_SESSION['lastname'] = $request['lastname'];
            $_SESSION['id'] = $request['id'];
            $_SESSION['email'] = $this -> email;
            return true;
        }
        else
        {
            return false;
        }
    }

    public function logout ()
    {
        session_unset();
    }
}