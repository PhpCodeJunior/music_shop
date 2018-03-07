<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");

class commController extends commModel
{

    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
    }

    public function insertComm($user, $post, $txt, $date)
    {
        $date1 = date("Y-m-d h:i:s");
        $stmt = $this->getDB()->prepare("insert into comments(user_id,pro_id,txt,realdate)values(:user_id,:pro_id,:txt,:realdate)");
        $stmt->bindValue(":user_id", $user);
        $stmt->bindValue(":pro_id", $post);
        $stmt->bindValue(":txt", $txt);
        $stmt->bindValue(":realdate", $date1);
        return $stmt->execute();
    }

    public function insertReplayComm($user,$post, $txt, $date,$replay)
    {
        $stmt = $this->getDB()->prepare("insert into comments(user_id,pro_id,txt,realdate,parent_id)values(:user_id,:pro_id,:txt,:realdate,:parent_id)");
        $stmt->bindValue(":user_id", $user);
        $stmt->bindValue(":pro_id", $post);
        $stmt->bindValue(":txt", $txt);
        $stmt->bindValue(":realdate", $this->help->formatDate());
        $stmt->bindValue(":parent_id", $replay);
        return $stmt->execute();
    }

    public function createComm()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['post'] = $this->setProId();
            $user = $this->help->getLoggedInUserId($_SESSION["name"]);
            if(empty($this->setTxt())){
                //echo "ne";
            } else{
                $this->insertComm($user, $this->setProId(), $this->setTxt(), $this->setDate());
                $this->help->redirect('singleProduct.php?id='.$_SESSION["post"]);
                }
            }
        }

    public function join($id)
    {
        $stmt = $this->getDB()->prepare("select comments.comm_id,comments.parent_id,users.user_id,product.pro_id,users.user_img,users.user_name,comments.realdate,comments.txt from
 comments join product on product.pro_id = comments.pro_id join users on users.user_id = comments.user_id where product.pro_id=:pro_id");
        $stmt->bindValue(":pro_id", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function joinParent($id)
    {
        $stmt = $this->getDB()->prepare("select comments.parent_id, comments.comm_id,users.user_id,product.pro_id,users.user_img,users.user_name,comments.realdate,comments.txt from
        comments join product on product.pro_id = comments.pro_id join users on users.user_id = comments.user_id where comments.parent_id=:parent_id");
        $stmt->bindValue(":parent_id", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function deleteComm($id){
        $stmt = $this->getDB()->prepare("delete from comments where comm_id=:comm_id");
        $stmt->bindValue(":comm_id",$id);
        return $stmt->execute();
    }
    public function deleteCommId(){
        if(isset($_GET["delCommId"])){
            $id = $_GET["delCommId"];
            $this->deleteComm($id);
             echo "<div class='alert alert-danger'>KOMENTAR JE IZBRISANA</div>";
        }else{
           // echo "<div class='alert alert-danger'>KOMENTAR NIJE IZBRISANA</div>";
        }
    }
    public function countComm($id)
    {
        $stmt = $this->getDB()->prepare("select * from comments where pro_id=:pro_id");
        $stmt->bindValue(":pro_id", $id);
        $stmt->execute();
        $rez = $stmt->rowCount();
        echo $rez;
    }
}