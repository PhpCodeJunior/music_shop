<?php

include_once(dirname(__FILE__) . '/../spl/spl.php');
class UserController extends UserModel
{
    private $help;
    private $valid;

    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
        $this->valid = new Valid();
    }

    public function insertUsers($name, $email, $pass, $img)
    {
        $stmt = $this->getDB()->prepare("insert into users(user_name,user_email,user_pass,user_img)
        values(:user_name,:user_email,:user_pass,:user_img)");
        $stmt->bindValue(":user_name", $name);
        $stmt->bindValue(":user_email", $email);
        $stmt->bindValue(":user_pass", $pass);
        $stmt->bindValue(":user_img", $img);
        return $stmt->execute();
    }

    public function account($id)
    {
        $stmt = $this->getDB()->prepare("select users.user_id, users.user_name,users.user_email,users.user_pass,users.user_img
        from users where users.user_id=:user_id");
        $stmt->bindValue(":user_id", $id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function showUsers()
    {
        $stmt = $this->getDB()->prepare("select * from users");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }


    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($this->userName()) || empty($this->userEmail()) || empty($this->userPass()) || empty($this->userImg())) {
                echo "<div class='alert alert-danger'>POPUNITE SVA POLJA</div>";
            } elseif ($this->valid->filterEmail($this->userEmail())) {
                echo "<div class='alert alert-danger'>EMAIL NIJE VALIDAN</div>";
            } elseif($this->valid->string($this->userName())){
                echo "<div class='alert alert-danger'>SAMO SLOVA SU DOZVOLJENA</div>";
                /* } elseif($this->valid->string_len($this->userName())){
                     echo "<div class='alert alert-danger'>MIN 3 KARAKTERA<br>MAX 20 KARAKTERA</div>";*/
            }else {
            $this->insertUsers($this->userName(), $this->userEmail(), $this->userPass(), $img = $this->userImg());
            $img_tmp = $_FILES["user_img"]["tmp_name"];
            $target = dirname(__FILE__) . "/../images/users/";
            $final_target = $target . basename($img);
            $img_size = $_FILES["user_img"]["size"];
            $img_type = strtolower(pathinfo($final_target, PATHINFO_EXTENSION));
            if ($img_size > 5000000) {
                echo "<div class='alert alert-danger'>PROIZVOD JE PREVELIK</div>";
                return false;
            } else {
                if ($img_type != "jpg" && $img_type != "png" && $img_type != "jpeg" && $img_type != "gif") {
                    echo "<div class='alert alert-danger'>SLIKA NEMA DOBRU EKSTENZIJU</div>";
                    return false;
                } else {
                    move_uploaded_file($img_tmp, $final_target);
                    return true;
                }
            }
        }
    }

}
    public function delete_user($id)
    {
        $stmt = $this->getDB()->prepare("delete from  users where user_id =:user_id");
        $stmt->execute(array(
            ":user_id" => $id
        ));
    }

    public function getDeleteUser()
    {
        if (isset($_GET["id"])) {
            //session_start();
            if (isset($_SESSION['id']) == $id = $_GET["id"]) {
                $this->delete_user($_SESSION['id']);
                session_destroy();
                echo "<div class='alert alert-danger'>VAS NALOG JE OBRISAN<br>NAPRAVITE NOV NALOG</div>";
            }
        }
    }
    public function changePass($id)
    {
        $pass = $this->userPass();
        $newPass = $_POST["newPass"];
        $confirmPass = $_POST["confirmPass"];
        $id = $_SESSION["id"];
        if (empty($pass) or empty($newPass) or empty($confirmPass)) {
            echo "<div class='alert alert-danger'>POPUNITE SVAKO POLJE</div>";
        } else {
            $query = $this->getDB()->prepare('SELECT * FROM users WHERE user_id=:user_id');
            $query->execute(array(':user_id' => $id));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $row['user_id'];
            $password = $row['user_pass'];
            if ($password == $pass) {
                if ($newPass == $confirmPass) {
                    $update = $this->getDB()->prepare("UPDATE users set user_pass='$newPass' WHERE user_id='" . $_SESSION["id"] . "'");
                    return $update->execute();
                }
            }
        }
    }
    public function executePass(){
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            if(isset($_SESSION["id"])){
                if($this->changePass($_SESSION["id"])) {
                    $this->help->redirect('../../index.php');
                    session_destroy();
                }
            }
        }
    }
    public function editUser($id,$name, $email, $pass, $images){
        $stmt = $this->getDB()->prepare("update  users set user_name=:user_name,user_email=:user_email,user_pass=:user_pass,
user_img=:user_img where user_id=:user_id");
        $stmt->bindValue(":user_name", $name);
        $stmt->bindValue(":user_email", $email);
        $stmt->bindValue(":user_pass", $pass);
        $stmt->bindValue(":user_img", $images);
        $stmt->bindValue(":user_id", $id);
        return $stmt->execute();
    }
    public function editUsers()
    {
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            if ($this->editUser($this->userId(),$this->userName(), $this->userEmail(), $this->userPass(), $img = $this->userImg())) {
                $img_tmp = $_FILES["user_img"]["tmp_name"];
                $t = (dirname(__FILE__) . '/../images/users/');
                $target = $t;
                $finalTarget = $target.basename($img);
                move_uploaded_file($img_tmp,$finalTarget);
                $this->help->redirect("userProfile.php");
            } else {
                echo "NALOG NIJE PROMENJEN<br>";
            }
        }
        if (isset($_GET["edId"])) {
            $stmt = $this->getDB()->prepare("select * from users where user_id=:user_id");
            $stmt->bindValue(":user_id", $_GET["edId"]);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            echo '<form method="post"  class="form-group" enctype="multipart/form-data" action="' . $_SERVER["PHP_SELF"] . '">
            <input type="hidden" name="user_id" class="form-control" value="' . $user->user_id . '">
            <input type="text" name="user_name" class="form-control" value="' . $user->user_name . '">
             <input type="text" name="user_email" class="form-control" value="' . $user->user_email . '">
              <input type="text" name="user_pass" class="form-control" value="' . $user->user_pass . '">
             <input type="file" name="user_img" class="form-control" value="' . $user->user_img . '">
            <input type="submit" name="editUser" class="form-control" value="edit user">
            </form>';
        }
    }
    public function forgot_pass($name){
        if (empty($name)) {
            echo "<div class='alert alert-danger'>UPISITE VASE IME</div>";
        } else {
            $query = $this->getDB()->prepare('SELECT * FROM users WHERE user_name=:user_name');
            $query->execute(array(':user_name' => $name));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $email = $row['user_email'];
            $password = $row['user_pass'];
            $to = $email;
            $subject = "VASA SIFRA";
            $mess = "ULOGUJTE SE SA OVOM SIFROM ".$password;
            $headers = "Za dodatna pitanja obratit se na mail slavkoslave89@gmail.com";
            mail($to,$subject,$mess,$headers);
            echo "<div class='alert alert-successr'>PORUKA JE POSLATA-PROVERITE VAS EMAIL</div>";

        }
    }
    public function return_forgot_pass(){
        if(isset($_POST["forgot"])){
            $name= $this->userName();
            $this->forgot_pass($name);
        }
    }
}