<?php

include_once(dirname(__FILE__)."/../spl/spl.php");

class OrderModel extends db
{
    private $user_id;
    private $pro_id;
    private $q;
    private $date;
    private $status;
    private $order_id;


    public function __construct(){
        parent:: __construct();
        $this->userId();
        $this->proId();
        $this->q();
        $this->date();
        $this->status();
        $this->orderId();

    }
    public function userId()
    {
        if (isset($_POST["user_id"])) {
            $this->user_id = $_POST["user_id"];
            return $this->user_id;
        }
    }
    public function orderId()
    {
        if (isset($_POST["order_id"])) {
            $this->order_id = $_POST["order_id"];
            return $this->order_id;
        }
    }
    public function status()
    {
        if (isset($_POST["status"])) {
            $this->status = $_POST["status"];
            return $this->status;
        }
    }
    public function proId()
    {
        if (isset($_POST["pro_id"])) {
            $this->pro_id = $_POST["pro_id"];
            return $this->pro_id;
        }
    }
    public function q()
    {
        if (isset($_POST["q"])) {
            $this->q = $_POST["q"];
            return $this->q;
        }
    }
    public function date()
    {
        if (isset($_POST["realdate"])) {
            $this->date = $_POST["realdate"];
            return $this->date;
        }
    }
}