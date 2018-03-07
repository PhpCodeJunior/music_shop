<?php

include_once(dirname(__FILE__)."/../spl/spl.php");

class WishModel extends db
{

    private $user_id;
    private $pro_id;
    private $wish_id;
    private $q;

    public function __construct()
    {
        parent:: __construct();
        $this->userId();
        $this->proId();
        $this->wishId();
        $this->q();

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

    public function wishId()
    {
        if (isset($_POST["wish_id"])) {
            $this->wish_id = $_POST["wish_id"];
            return $this->wish_id;
        }
    }

    public function q()
    {
        if (isset($_POST["q"])) {
            $this->q = $_POST["q"];
            return $this->q;
        }
    }


}