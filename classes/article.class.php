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

    public function __construct ($user_Id, $header, $title, $content)
    {
        $this -> author = $user_Id;
        $this -> header = $header;
        $this -> title = $title;
        $this -> content = $content;
    }

    public function createArticle ()
    {
        $insert_string='insert into articles (header, title, content) values (:header, :title, :content)';
        $insert_array = array(
            "header" => $this -> header,
            "title" => $this ->title,
            "content" => $this -> content
        );
        $database = new Database ();
        if ($database -> request($insert_string, $insert_array))
        {
            $link_string = 'insert into author (article_id, author_id) values ($database -> getLastInsertedId(), $this -> user_Id)';
            if ($database ->request($link_string))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function editArticle()
    {

    }
}