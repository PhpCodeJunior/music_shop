<?php

include_once(dirname(__FILE__)."/../database/db.php");

class categoryModel extends db
{
    private $cat_name;
    private $cat_id;

    public function __construct(){
    parent:: __construct();
        $this->catName();
        $this->catId();

    }
    public function catName(){
        if(isset($_POST["cat_name"])){
            $this->cat_name = $_POST["cat_name"];
            return $this->cat_name;
        }
    }
    public function catId(){
        if(isset($_POST["cat_id"])){
            $this->cat_id = $_POST["cat_id"];
            return $this->cat_id;
        }
    }


}