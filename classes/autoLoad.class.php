<?php

class autoLoad
{
    private static $dir = "./classes";

    public static function classesAutoLoader($class)
    {
        $path = static::$dir."/".$class.".class.php";
        if (is_readable($path))
        {
            require $path;
        }
    }
}