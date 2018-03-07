<?php

include_once(dirname(__FILE__)."/../spl/spl.php");

class InfoModel extends db
{
    private $user_id;
    private $pro_id;
    private $info_id;
    private $address;
    private $mob;
    private $state;
    private $code;
    private $city;



    public function __construct()
    {
        parent:: __construct();
        $this->userId();
        $this->proId();
        $this->infoId();
        $this->address();
        $this->city();
        $this->mob();
        $this->state();
        $this->code();
    }

    public function userId()
    {
        if (isset($_POST["user_id"])) {
            $this->user_id = $_POST["user_id"];
            return $this->user_id;
        }
    }
    public function proId()
    {
        if (isset($_POST["pro_id"])) {
            $this->pro_id = $_POST["pro_id"];
            return $this->pro_id;
        }
    }
    public function infoId()
    {
        if (isset($_POST["info_id"])) {
            $this->info_id = $_POST["info_id"];
            return $this->info_id;
        }
    }

    public function address()
    {
        if (isset($_POST["address"])) {
            $this->address = $_POST["address"];
            return $this->address;
        }
    }

    public function code()
    {
        if (isset($_POST["p_code"])) {
            $this->code = $_POST["p_code"];
            return $this->code;
        }
    }

    public function state()
    {
        if (isset($_POST["state"])) {
            $this->state = $_POST["state"];
            return $this->state;
        }
    }
    public function city()
    {
        if (isset($_POST["city"])) {
            $this->city = $_POST["city"];
            return $this->city;
        }
    }
    public function mob()
    {
        if (isset($_POST["mobile"])) {
            $this->mob = $_POST["mobile"];
            return $this->mob;
        }
    }
}