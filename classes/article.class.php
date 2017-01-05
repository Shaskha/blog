<?php

/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 05/01/2017
 * Time: 13:48
 */
class Article
{
    protected $id;
    protected $title;
    protected $content;
    protected $date;
    protected $author;
    protected $header;

    public function createArticle ($user_Id, $header, $title, $content)
    {
        $request_string=('insert into articles (header, title, content) values (:header, :title, :content)');
        $database = new Database ();
        $database -> request();
    }
}