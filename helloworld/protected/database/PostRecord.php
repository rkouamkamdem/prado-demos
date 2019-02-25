<?php

use Prado\Data\ActiveRecord\TActiveRecord;

class PostRecord extends TActiveRecord
{
    const TABLE = "posts";
    public $post_id;
    public $author_id;
    public $create_time;
    public $title;
    public $content;
    public $status; /* 0: publié; 1: brouillon; 2: en attente; 2: accès interdit */

    public static function finder($className=__CLASS__)
    {
        return parent::finder($className);
    }

    public $author; //contient un objet UserRecord

    protected static $RELATIONS=array
    (
        "author" => array(self::BELONGS_TO, "UserRecord"),
    );
}