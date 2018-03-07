<?php

include_once(dirname(__FILE__) . "/../spl/spl.php");

class Valid extends db
{
    public function __construct()
    {
        parent:: __construct();
    }
 public function string($name)
 {
     return (!preg_match("/^[a-zA-Z ]*$/", $name));
 }

    public function filterEmail($email)
    {
        return (!filter_var($email, FILTER_VALIDATE_EMAIL));
    }
    public function string_len($name){

            return (filter_var($name,FILTER_VALIDATE_INT,array("options"=>array("min_range"=>3, "max_range"=>20)))===false);

        }

}