<?php

include_once(dirname(__FILE__)."/../database/db.php");

class ProductModel extends db
{
    private $brand_id;
    private $cat_id;
    private $pro_id;
    private $pro_name;
    private $pro_price;
    private $pro_body;
    private $pro_img;
    private $search;


    public function __construct(){
        parent:: __construct();
        $this->catId();
        $this->search();
        $this->brandId();
        $this->proId();
        $this->proName();
        $this->proPrice();
        $this->proBody();
        $this->proImg();
    }
    public function proPrice(){
        if(isset($_POST["pro_price"])){
            $this->pro_price = $_POST["pro_price"];
            return $this->pro_price;
        }
    }
    public function search(){
        if(isset($_POST["search"])){
            $this->search = $_POST["search"];
            return $this->search;
        }
    }
    public function proImg(){
        if(isset($_FILES["pro_img"]["name"])){
            $this->pro_img = $_FILES["pro_img"]["name"];
            return $this->pro_img;
        }
    }
    public function proBody(){
        if(isset($_POST["pro_body"])){
            $this->pro_body = $_POST["pro_body"];
            return $this->pro_body;
        }
    }
    public function proName(){
        if(isset($_POST["pro_name"])){
            $this->pro_name = $_POST["pro_name"];
            return $this->pro_name;
        }
    }
    public function proId(){
        if(isset($_POST["pro_id"])){
            $this->pro_id = $_POST["pro_id"];
            return $this->pro_id;
        }
    }
    public function catId(){
        if(isset($_POST["cat_id"])){
            $this->cat_id = $_POST["cat_id"];
            return $this->cat_id;
        }
    }
    public function brandId(){
        if(isset($_POST["brand_id"])){
            $this->brand_id = $_POST["brand_id"];
            return $this->brand_id;
        }
    }
}