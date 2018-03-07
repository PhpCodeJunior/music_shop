<?php

include_once(dirname(__FILE__) . '/../spl/spl.php');
class InfoController extends InfoModel
{
    private $help;

    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
    }

    public function insertInfo($uId, $add, $c, $pC, $s, $m)
    {
        $stmt = $this->getDB()->prepare("insert into user_info(user_id,address,city,p_code,state,mobile)
        values(:user_id,:address,:city,:p_code,:state,:mobile)");
        $stmt->bindValue(":user_id", $uId);
        $stmt->bindValue(":address", $add);
        $stmt->bindValue(":city", $c);
        $stmt->bindValue(":p_code", $pC);
        $stmt->bindValue(":state", $s);
        $stmt->bindValue(":mobile", $m);
        return $stmt->execute();
    }

    public function getLoggedInUserId($username)
    {
        $stmt = $this->getDB()->prepare("SELECT user_id FROM users WHERE user_name = :user_name");
        $stmt->bindValue(":user_name", $username);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function showInfo($id)
    {
        $stmt = $this->getDB()->prepare("SELECT * from user_info where user_id=:user_id");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez =$stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function insert()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_SESSION["name"])) {
                $user = $this->getLoggedInUserId($_SESSION["name"]);
                if (empty($user)  || empty($this->address())
                    || empty($this->city()) || empty($this->code()) || empty($this->state()) || empty($this->mob())) {
                    echo "<div class='alert alert-danger'>POPUNITE SVA POLJA</div>";
                    return false;
                } else {
                    $this->insertInfo($user, $this->address(), $this->city(), $this->code(), $this->state(), $this->mob());
                    return true;
                }
            }
        }
    }
    public function showAllInfo($id)
    {
        $stmt = $this->getDB()->prepare("select users.user_id,users.user_name,users.user_img,users.user_pass,users.user_email,user_info.info_id,
        user_info.address,user_info.city,user_info.mobile,user_info.p_code,user_info.state
        from user_info inner join users on user_info.user_id = users.user_id where users.user_id=:user_id");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez =$stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function editInfo($uId, $add, $c, $pC, $s, $m)
    {
        $stmt = $this->getDB()->prepare("update  user_info set address=:address,
        city=:city,
        p_code=:p_code
        ,state=:state,
        mobile=:mobile
        where info_id=:info_id");
        $stmt->bindValue(":info_id", $uId);
        $stmt->bindValue(":address", $add);
        $stmt->bindValue(":city", $c);
        $stmt->bindValue(":p_code", $pC);
        $stmt->bindValue(":state", $s);
        $stmt->bindValue(":mobile", $m);
        return $stmt->execute();
    }
    public function editInformation()
    {
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            if ($this->editInfo($this->infoId(), $this->address(), $this->city(), $this->code(), $this->state(), $this->mob())) {
                $this->help->redirect("../userProfile.php");
            } else {
                echo "INFORMACIJE NISU PROMENJENE<br>";
            }
        }
        if (isset($_GET["editId"])) {
            $stmt = $this->getDB()->prepare("select * from user_info where info_id=:info_id");
            $stmt->bindValue(":info_id", $_GET["editId"]);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post"  class="form-group" enctype="multipart/form-data" action="' . $_SERVER["PHP_SELF"] . '">
             <input type="hidden" name="info_id" class="form-control" value="' . $user->info_id . '">
             <input type="text" name="address" class="form-control" value="' . $user->address . '">
             <input type="text" name="city" class="form-control" value="' . $user->city . '">
             <input type="text" name="p_code" class="form-control" value="' . $user->p_code . '">
             <input type="text" name="state" class="form-control" value="' . $user->state . '">
             <input type="text" name="mobile" class="form-control" value="' . $user->mobile . '">
             <input type="submit" name="editUser" class="form-control" value="edit user">
             </form>';
        }
    }
    public function delete_info($id)
    {
        $stmt = $this->getDB()->prepare("delete from  user_info where info_id =:info_id");
        $stmt->execute(array(
            ":info_id" => $id
        ));
    }
    public function getDeleteUser()
    {
        if (isset($_GET["del_id"])) {
                $this->delete_info($_GET["del_id"]);

                echo "<div class='alert alert-danger'>VASE INFORMACIJE SU OBRISANE<br>DODAJTE NOVE, HVALA!</div>";
            }
        }
}