<?php

include_once(dirname(__FILE__)."../../spl/spl.php");


class categoryController extends categoryModel
{
    private $help;
    public function __construct(){
        parent:: __construct();
        $this->help = new helpers();
    }
    public function add($name){
        $stmt = $this->getDB()->prepare("insert into category(cat_name)values(:cat_name)");
        $stmt->bindValue(":cat_name",$name);
        return $stmt->execute();
    }
    public function addCat(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(empty($this->catName())){
                echo "<div class='alert alert-danger'>POPUNITE POLJE</div>";
            }else{
                $this->add($this->catName());
            }
        }else{
            echo "<div class='alert alert-danger'>KATEGORIJA NIJE UBACENA</div>";
        }
    }
    public function editCat($id,$name){
        $stmt = $this->getDB()->prepare("update category set cat_name=:cat_name where cat_id=:cat_id");
        $stmt->bindValue(":cat_name",$name);
        $stmt->bindValue(":cat_id",$id);
        return $stmt->execute();
    }
    public function editCatId(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $this->editCat($this->catId(),$this->catName());
                $this->help->redirect("../category/insertCategory.php");
            }
            if(isset($_GET["ed_id"])) {
                $id = $_GET["ed_id"];
                $stmt = $this->getDB()->prepare("select * from category where cat_id=:cat_id");
                $stmt->bindValue(":cat_id", $id);
                $stmt->execute();
                $edit = $stmt->fetch(PDO::FETCH_OBJ);
                ?>
                <form method='post' class="form-group" action='<?php echo $_SERVER["PHP_SELF"]; ?> '>
                    <input type="hidden" class="form-control" name="cat_id" value="<?php echo $edit->cat_id; ?>">
                    <input type="text" class="form-control"  name="cat_name" value="<?php echo $edit->cat_name ?>">
                    <input type="submit" name="submit" class="form-control" value="PROMENITE">
                </form>
            <?php }
        }


    public function deleteCat($id){
        $stmt = $this->getDB()->prepare("delete from category where cat_id=:cat_id");
        $stmt->bindValue(":cat_id",$id);
        return $stmt->execute();
    }
    public function deleteCatId(){
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $this->deleteCat($id);
        }else{
            echo "<div class='alert alert-danger'>KATEGORIJA NIJE IZBRISANA</div>";
        }
    }

    public function showCat(){
        $stmt = $this->getDB()->prepare("select * from category");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function showCatId($id){
        $stmt = $this->getDB()->prepare("select * from product where cat_id=:cat_id");
        $stmt->bindValue(":cat_id",$id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

}