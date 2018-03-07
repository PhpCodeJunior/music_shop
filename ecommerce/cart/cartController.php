<?php
include_once(dirname(__FILE__)."/../spl/spl.php");

class CartController extends CartModel
{
    private $help;

    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
    }

    public function add($uId, $pId, $q)
    {
        $stmt = $this->getDB()->prepare("insert into user_cart(user_id,pro_id,q)values(:user_id,:pro_id,:q)");
        $stmt->bindValue(":user_id", $uId);
        $stmt->bindValue(":pro_id", $pId);
        $stmt->bindValue(":q", $q);
        return $stmt->execute();
    }

    public function addCart()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_SESSION["name"])) {
                $id = $_SESSION["name"];
                $user = $this->help->getLoggedInUserId($id);
                    if (empty($user) or empty($this->proId()) or empty($this->q())) {
                        // echo "<div class='alert alert-danger'>PROIZVOD  NIJE UBACEN U KORPU</div>";
                    } else {
                        $this->add($user, $this->proId(), $this->q());
                    }
                }
            }
        }

    public function cartDisplay($id)
    {
        $stmt = $this->getDB()->prepare("select user_cart.cart_id, user_cart.q, users.user_name, users.user_id,product.pro_id, product.pro_name,product.pro_price,product.pro_img
        from user_cart inner join users on user_cart.user_id = users.user_id
        inner join product on user_cart.pro_id = product.pro_id where users.user_id =:user_id");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function cartDisplayArray($id)
    {
        $stmt = $this->getDB()->prepare("select user_cart.cart_id, user_cart.q, users.user_name, users.user_id,product.pro_id, product.pro_name,product.pro_price,product.pro_img
        from user_cart inner join users on user_cart.user_id = users.user_id
        inner join product on user_cart.pro_id = product.pro_id where users.user_id =:user_id");
        $stmt->execute(array(":user_id" => $id));
        $rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rez;
    }

    public function countCart($id)
    {
        $stmt = $this->getDB()->prepare("select * from user_cart where user_id=:user_id");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez = $stmt->rowCount();
        echo $rez;
    }

    public function deleteCart($id)
    {
        $stmt = $this->getDB()->prepare("delete from user_cart where cart_id=:cart_id");
        $stmt->bindValue(":cart_id", $id);
        return $stmt->execute();
    }

    public function qw($quantity)
    {
        $stmt = $this->getDB()->prepare("SELECT cart_id FROM user_cart WHERE q = :q");
        $stmt->bindValue(":q", $quantity);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function deleteAllFromCart()
    {
        $stmt = $this->getDB()->prepare("delete  from user_cart");
        return $stmt->execute();
    }
    public function deleteCartId()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->deleteCart($id);
        } else {
            //echo "<div class='alert alert-danger'>BREND NIJE IZBRISAN</div>";
        }
    }

    public function updateQuantity($cId,$quantity){
    $stmt = $this->getDB()->prepare("update user_cart set q=:q where cart_id=:cart_id ");
    $stmt->bindValue(":cart_id",$cId);
  $stmt->bindValue(":q",$quantity);
        return $stmt->execute();
    }
    public function sold_product($userId,$proId,$quantity,$realdate){
        $stmt = $this->getDB()->prepare("insert into sold_product(user_id,pro_id,quantity,realdate)values(:user_id,:pro_id,:quantity,:realdate)");
        $stmt->bindValue(":user_id", $userId);
        $stmt->bindValue(":pro_id", $proId);
        $stmt->bindValue(":quantity", $quantity);
        $stmt->bindValue(":realdate", $realdate);
        return $stmt->execute();
    }
    public function showSoldProduct($user_id){
        $stmt = $this->getDB()->prepare("select sold_product.sold_id, sold_product.quantity, users.user_name, users.user_id,product.pro_id, product.pro_name,product.pro_price,product.pro_img
        from sold_product inner join users on sold_product.user_id = users.user_id
        inner join product on sold_product.pro_id = product.pro_id where users.user_id =:user_id");
        $stmt->execute(array(":user_id" => $user_id));
        $rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rez;
    }

}