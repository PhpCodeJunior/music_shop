

<?php
include_once(dirname(__FILE__) . '/../spl/spl.php');
class UserLogin extends UserModel
{
    private $valid;
    private $help;
public function __construct()
{
parent:: __construct();
    $this->help=new helpers();
    $this->valid= new Valid();
}

public function selectUsers($name, $pass)
{
$stmt = $this->getDB()->prepare("select * from users where user_name=:user_name and user_pass=:user_pass");
    $stmt->execute(array(':user_name' => $name, ':user_pass' => $pass));
    if ($stmt->rowCount() == 0) {
        echo "<div class='alert alert-danger'>POGRESNA LOZINKA</div>";
    } else {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["name"] = $row['user_name'];
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['admin'] = $row['cat_uset'];
        if ($_SESSION['admin'] == "1") {
            $this->help->redirect("admin/index.php");
        } else {
            $this->help->setSession();
        }
    }
}

    public function login(){
        if($_SERVER["REQUEST_METHOD"]=="POST") {
                $this->selectUsers($this->userName(), $this->userPass());
            }
        }


    public function logout(){
        session_destroy();
        echo "<div class='alert alert-danger'>IZLOGOVALI STE SE</div>";
        echo "<a href='../index.php'>VRATITE SE NA POCETNU</a>";
    }
    public function logoutUser(){
        session_destroy();
        echo "<div class='alert alert-danger'>IZLOGOVALI STE SE</div>";
        echo "<a href='../index.php'>VRATITE SE NA POCETNU</a>";
    }

}