<?php


class db
{
    private $conn;

    public function __construct(){
    $this->setDB();
}
    public function setDB(){
        $conn = null;
        try{
            $conn = new PDO("mysql:host=localhost;dbname=ecommerce","root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        $this->conn = $conn;
    }

    public function getDB(){
        return $this->conn;
    }
}