<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");

class helpers extends  db

{
    public function __construct()
    {
        parent:: __construct();
    }
public function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}
    public function getLoggedInUserId($name)
    {
        $stmt = $this->getDB()->prepare("SELECT user_id FROM users WHERE user_name = :user_name");
        $stmt->bindValue(":user_name", $name);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function setSession(){
        if(isset($_POST["user_name"])){
            $_SESSION["name"] = $_POST["user_name"];
            $this->redirect("index.php");
        }
    }
    public function formatDate(){
        date("Y-m-d h:i:s");
    }
}