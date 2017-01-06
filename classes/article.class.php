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
    protected $database;

    public function __construct()
    {
        $this -> database = new Database ();
    }

    public function createArticle ($user_Id, $title, $header, $content)
    {
        $insert_string='insert into article (header, title, content, date_pub) values (:header, :title, :content, now())';
        $insert_array = array(
            "header" => $header,
            "title" => $title,
            "content" => $content
        );
        if ($this -> database -> request($insert_string, $insert_array))
        {
            $link_string = 'insert into author (id_article, id_author) values (:id_article, :id_author)';
            $link_array = array(
                "id_article" => intval($this -> database -> getLastInsertedId()),
                "id_author" => $user_Id);
            if ($this -> database ->request($link_string, $link_array))
            {

                $this -> author = $user_Id;
                $this -> header = $header;
                $this -> title = $title;
                $this -> content = $content;
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

    public function editArticle($article_id, $title, $header, $content)
    {
        $update_string = "update articles set title = :title, header = :header, content = :content where id = :id";
        $update_array=array(
            "id"=>$article_id,
            "title" => $title,
            "header" => $header,
            "content" => $content
                );
        $this -> database -> request($update_string, $update_array);

    }

    public function showArticle ($article_id)
    {
        $select_string = "select * from article where id = :id";
        $article = $this -> database ->request($select_string, array("id" => $article_id));
        $this -> title = $article[0]['title'];
        $this -> header = $article[0]['header'];
        $this -> content = $article[0]['content'];

        require('./template/article.php');
    }
}