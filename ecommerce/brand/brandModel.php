<?php

include_once(dirname(__FILE__)."/../database/db.php");

class brandModel extends db
{
    private $brand_name;
    private $brand_id;

    public function __construct(){
        parent:: __construct();
        $this->brandName();
        $this->brandId();

    }
    public function brandName(){
        if(isset($_POST["brand_name"])){
            $this->brand_name = $_POST["brand_name"];
            return $this->brand_name;
        }
    }
    public function brandId(){
        if(isset($_POST["brand_id"])){
            $this->brand_id = $_POST["brand_id"];
            return $this->brand_id;
        }
    }


}