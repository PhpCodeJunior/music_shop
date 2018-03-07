<?php

include_once(dirname(__FILE__) . '/../spl/spl.php');
class OrderController extends OrderModel
{
    private $help;

    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
    }

    public function insertOrder($uId, $add, $c, $date)
    {
        $stmt = $this->getDB()->prepare("insert into order_user(user_id,pro_id,q,realdate)
        values(:user_id,:pro_id,:q,:realdate)");
        $stmt->bindValue(":user_id", $uId);
        $stmt->bindValue(":pro_id", $add);
        $stmt->bindValue(":q", $c);
        $stmt->bindValue(":realdate", $date);
        return $stmt->execute();
    }

    public function showOrder($id)
    {
        $stmt = $this->getDB()->prepare("select order_user.order_id, order_user.q, users.user_id,users.user_name, product.pro_name,product.pro_price,product.pro_img
from order_user inner join users on order_user.user_id = users.user_id
inner join product on order_user.pro_id = product.pro_id where users.user_id=:user_id;");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function showAllOrder()
    {
        $stmt = $this->getDB()->prepare("select order_user.order_id, order_user.realdate, order_user.status, order_user.q, users.user_id,users.user_name, product.pro_name,product.pro_price,product.pro_img
from order_user inner join users on order_user.user_id = users.user_id
inner join product on order_user.pro_id = product.pro_id");
        $stmt->execute();
        $rez =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function editStatus($status, $id)
    {
        $stmt = $this->getDB()->prepare("update order_user set status=:status where order_id=:order_id");
        $stmt->bindValue(":status", $status);
        $stmt->bindValue(":order_id", $id);
        return $stmt->execute();
    }



    public function best_sold_product(){
        $stmt = $this->getDB()->prepare("select order_user.order_id, sum(order_user.q) as q, users.user_id, product.pro_id, product.pro_name,product.pro_price,product.pro_img
from order_user inner join users on order_user.user_id = users.user_id
inner join product on order_user.pro_id = product.pro_id group by product.pro_id order by q desc limit 5");
        $stmt->execute();
        $rez =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
}

