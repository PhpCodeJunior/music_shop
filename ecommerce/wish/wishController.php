<?php
include_once(dirname(__FILE__)."/../spl/spl.php");

class WishController extends WishModel
{
    private $help;

    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
    }

    public function countWish($id)
    {
        $stmt = $this->getDB()->prepare("select * from user_wish where user_id=:user_id");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez = $stmt->rowCount();
        echo $rez;
    }

    public function deleteWish($id)
    {
        $stmt = $this->getDB()->prepare("delete from user_wish where wish_id=:wish_id");
        $stmt->bindValue(":wish_id", $id);
        return $stmt->execute();
    }

    public function deleteWishId()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->deleteWish($id);
        } else {
            //echo "<div class='alert alert-danger'>BREND NIJE IZBRISAN</div>";
        }
    }


    public function addWish($uId, $pId,$q)
    {
        $stmt = $this->getDB()->prepare("insert into user_wish(user_id,pro_id,q)values(:user_id,:pro_id,:q)");
        $stmt->bindValue(":user_id", $uId);
        $stmt->bindValue(":pro_id", $pId);
        $stmt->bindValue(":q", $q);
        return $stmt->execute();
    }

    public function addWishList()
    {
        if(isset($_POST["wish"])) {
            if(isset($_SESSION["name"])) {
                $id = $_SESSION["name"];
                $user = $this->help->getLoggedInUserId($id);
                    $this->addWish($user, $this->proId(), $this->q());
            }else {
                echo "<div class='alert alert-danger'>PROIZVOD  NIJE UBACEN U LISTU ZELJA</div>";
            }
        }
    }
    public function wishDisplay($id)
    {
        $stmt = $this->getDB()->prepare("select user_wish.wish_id, user_wish.q, users.user_name, users.user_id, product.pro_name,
        product.pro_price,product.pro_img
        from user_wish inner join users on user_wish.user_id = users.user_id
        inner join product on user_wish.pro_id = product.pro_id where users.user_id =:user_id");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
}