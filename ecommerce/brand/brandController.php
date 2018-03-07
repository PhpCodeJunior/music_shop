<?php

include_once(dirname(__FILE__)."../../spl/spl.php");


class brandController extends brandModel
{
    private $help;

    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
    }

    public function add($name)
    {
        $stmt = $this->getDB()->prepare("insert into brand(brand_name)values(:brand_name)");
        $stmt->bindValue(":brand_name", $name);
        return $stmt->execute();
    }

    public function addBrand()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($this->brandName())) {
                echo "<div class='alert alert-danger'>POPUNITE POLJE</div>";
            } else {
                $this->add($this->brandName());
            }
        } else {
            echo "<div class='alert alert-danger'>BREND NIJE UBACEN</div>";
        }

    }

    public function editBrand($id, $name)
    {
        $stmt = $this->getDB()->prepare("update brand set brand_name=:brand_name where brand_id=:brand_id");
        $stmt->bindValue(":brand_name", $name);
        $stmt->bindValue(":brand_id", $id);
        return $stmt->execute();
    }

    public function editBrandId()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->editBrand($this->brandId(), $this->brandName());
            $this->help->redirect("../brand/insertBrand.php");
        }
        if (isset($_GET["ed_id"])) {
            $id = $_GET["ed_id"];
            $stmt = $this->getDB()->prepare("select * from brand where brand_id=:brand_id");
            $stmt->bindValue(":brand_id", $id);
            $stmt->execute();
            $edit = $stmt->fetch(PDO::FETCH_OBJ);
            ?>
            <form method='post' class="form-group" action='<?php echo $_SERVER["PHP_SELF"]; ?> '>
                <input type="hidden" class="form-control" name="brand_id" value="<?php echo $edit->brand_id; ?>">
                <input type="text" class="form-control" name="brand_name" value="<?php echo $edit->brand_name ?>">
                <input type="submit" name="submit" class="form-control" value="PROMENITE">
            </form>
        <?php }
    }


    public function deleteBrand($id)
    {
        $stmt = $this->getDB()->prepare("delete from brand where brand_id=:brand_id");
        $stmt->bindValue(":brand_id", $id);
        return $stmt->execute();
    }

    public function deleteBrandId()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->deleteBrand($id);
        } else {
            echo "<div class='alert alert-danger'>BREND NIJE IZBRISAN</div>";
        }
    }

    public function showBrandId($id){
        $stmt = $this->getDB()->prepare("select * from product where brand_id=:brand_id");
        $stmt->bindValue(":brand_id",$id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function showBrand(){
        $stmt = $this->getDB()->prepare("select * from brand");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
}

