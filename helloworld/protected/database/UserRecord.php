<?php

use Prado\Data\ActiveRecord\TActiveRecord;

class UserRecord extends TActiveRecord
{
    const TABLE = "users";
    public $username;
    public $email;
    public $password;
    public $role; /* 0: utilisateur normal, 1: administrateur */
    public $first_name;
    public $last_name;

    public static function finder($className=__CLASS__)
    {
        return parent::finder($className); //$className;
    }

    public $posts=array(); //contient un tableau de PostRecord

    public static $RELATIONS=array
    (
        "posts" => array(self::HAS_MANY, "PostRecord"),
    );

}