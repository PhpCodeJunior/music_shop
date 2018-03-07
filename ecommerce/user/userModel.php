<?php

include_once(dirname(__FILE__)."/../spl/spl.php");

class UserModel extends db
{
    private $user_id;
    private $user_name;
    private $user_email;
    private $user_pass;
    private $user_img;

    public function __construct()
    {
        parent:: __construct();
        $this->userId();
        $this->userName();
        $this->userEmail();
        $this->userPass();
        $this->userImg();
    }

    public function userId()
    {
        if (isset($_POST["user_id"])) {
            $this->user_id = $_POST["user_id"];
            return $this->user_id;
        }
    }

    public function userImg()
    {
        if (isset($_FILES["user_img"]["name"])) {
            $this->user_img = $_FILES["user_img"]["name"];
            return $this->user_img;
        }
    }

    public function userEmail()
    {
        if (isset($_POST["user_email"])) {
            $this->user_email = $_POST["user_email"];
            return $this->user_email;
        }
    }

    public function userName()
    {
        if (isset($_POST["user_name"])) {
            $this->user_name = $_POST["user_name"];
            return $this->user_name;
        }
    }

    public function userPass()
    {
        if (isset($_POST["user_pass"])) {
            $this->user_pass = $_POST["user_pass"];
            return $this->user_pass;
        }
    }
}
