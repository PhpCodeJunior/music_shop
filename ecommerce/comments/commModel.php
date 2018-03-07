<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");


class commModel extends db
{

    private $userId;
    private $proId;
    private $date;
    private $txt;
    private $parentId;
    private $commId;

    public function __construct()
    {
        parent:: __construct();
        $this->setUserId();
        $this->setReplayId();
        $this->setProId();
        $this->setCommId();

        $this->setTxt();
        $this->setDate();
    }

    public function setDate()
    {
        if (isset($_POST["realdate"])){
            $this->date = $_POST["realdate"];
            return $this->date;
        }
    }
    public function setTxt()
    {
        if (isset($_POST["txt"])){
            $this->txt = $_POST["txt"];
            return $this->txt;
        }
    }
    public function setProId()
    {
        if (isset($_POST["pro_id"])){
            $this->proId = $_POST["pro_id"];
            return $this->proId;
        }
    }
    public function setCommId()
    {
        if (isset($_POST["comm_id"])){
            $this->commId = $_POST["comm_id"];
            return $this->commId;
        }
    }
    public function setUserId()
    {
        if (isset($_POST["user_id"])){
            $this->userId = $_POST["user_id"];
            return $this->userId;
        }
    }
    public function setReplayId()
    {
        if (isset($_POST["parent_id"])){
            $this->parentId = $_POST["parent_id"];
            return $this->parentId;
        }
    }
}