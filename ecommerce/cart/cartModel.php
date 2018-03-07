<?php

include_once(dirname(__FILE__)."/../spl/spl.php");

class CartModel extends db
{

    private $user_id;
    private $pro_id;
    private $cart_id;
    private $q;

    public function __construct(){
        parent:: __construct();
        $this->userId();
        $this->proId();
        $this->cartId();
        $this->q();

    }
    public function userId(){
        if(isset($_POST["user_id"])){
            $this->user_id = $_POST["user_id"];
            return $this->user_id;
        }
    }
    public function proId(){
        if(isset($_POST["pro_id"])){
            $this->pro_id = $_POST["pro_id"];
            return $this->pro_id;
        }
    }

    public function cartId(){
        if(isset($_POST["cart_id"])){
            $this->cart_id = $_POST["cart_id"];
            return $this->cart_id;
        }
    }
    public function q(){
        if(isset($_POST["q"])){
            $this->q = $_POST["q"];
            return $this->q;
        }
    }


}