<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");
class ProductController extends ProductModel{
    public $data;
    private $help;
    public function __construct()
    {
        parent:: __construct();
        $this->help = new helpers();
    }

    public function add($name,$price,$body,$catId,$brandId,$img){
        $stmt = $this->getDB()->prepare("insert into product(pro_name,pro_price,pro_body,cat_id,brand_id,pro_img)values
       (:pro_name,:pro_price,:pro_body,:cat_id,:brand_id,:pro_img)");
        $stmt->bindValue(":pro_name", $name);
        $stmt->bindValue(":pro_price", $price);
        $stmt->bindValue(":pro_body", $body);
        $stmt->bindValue(":cat_id", $catId);
        $stmt->bindValue(":brand_id", $brandId);
        $stmt->bindValue(":pro_img", $img);
        return $stmt->execute();
    }

    public function addProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($this->brandId()) ||empty($this->catId()) ||
                empty($this->proName()) || empty($this->proBody()) ||
                empty($this->proPrice()) || empty($this->proImg())) {
                echo "<div class='alert alert-danger'>POPUNITE POLJE</div>";
            }else {
                $this->add($this->proName(), $this->proPrice(), $this->proBody(), $this->catId(), $this->brandId(), $img = $this->proImg());
                $img_tmp = $_FILES["pro_img"]["tmp_name"];
                $target = dirname(__FILE__) . "/../images/product/";
                $final_target = $target . basename($img);

                $img_size = $_FILES["pro_img"]["size"];
                $img_type = strtolower(pathinfo($final_target, PATHINFO_EXTENSION));
                if (file_exists($final_target)) {
                    echo "<div class='alert alert-danger'>PROIZVOD VEC POSTOJI</div>";
                    return false;
                } else {
                    if ($img_size > 5000000) {
                        echo "<div class='alert alert-danger'>PROIZVOD JE PREVELIK</div>";
                        return false;
                    } else {
                        if ($img_type != "jpg" && $img_type != "png" && $img_type != "jpeg"
                            && $img_type != "gif"){
                            echo "<div class='alert alert-danger'>PROIZVOD NEMA DOBRU EKSTENZIJU</div>";
                            return false;
                        }else{
                            move_uploaded_file($img_tmp,$final_target);
                            return true;
                        }
                  }
               }
           }
        } else {
            echo "<div class='alert alert-danger'>PROIZVOD NIJE UBACEN</div>";
            }
    }

    public function editProduct($proId,$name,$price,$body,$catId,$brandId,$img)
    {
        $stmt = $this->getDB()->prepare("update product set
pro_name=:pro_name,
pro_price=:pro_price,
pro_body=:pro_body,
cat_id=:cat_id,
brand_id=:brand_id,
pro_img=:pro_img
where
 pro_id=:pro_id");
        $stmt->bindValue(":pro_id", $proId);
        $stmt->bindValue(":pro_name", $name);
        $stmt->bindValue(":pro_price", $price);
        $stmt->bindValue(":pro_body", $body);
        $stmt->bindValue(":cat_id", $catId);
        $stmt->bindValue(":brand_id", $brandId);
        $stmt->bindValue(":pro_img", $img);
        return $stmt->execute();
    }

    public function editProductId()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->editProduct($this->proId(), $this->proName(),
                $this->proPrice(), $this->proBody(),
                $this->catId(), $this->brandId(), $img = $this->proImg());
            $img_tmp = $_FILES["pro_img"]["tmp_name"];
            $target = dirname(__FILE__) . "/../images/product/";
            $final_target = $target . basename($img);
            move_uploaded_file($img_tmp, $final_target);
           $this->help->redirect("../product/insertProduct.php");
        }
        if (isset($_GET["ed_id"])) {
            $id = $_GET["ed_id"];
            $stmt = $this->getDB()->prepare("select * from product where pro_id=:pro_id");
            $stmt->bindValue(":pro_id", $id);
            $stmt->execute();
            $edit = $stmt->fetch(PDO::FETCH_OBJ);
            ?>
            <form method='post' class="form-group" action='<?php echo $_SERVER["PHP_SELF"]; ?> '>
                <input type="hidden" class="form-control" name="pro_id" value="<?php echo $edit->pro_id; ?>">
                <input type="text" class="form-control" name="pro_name" value="<?php echo $edit->pro_name ?>">
                <input type="text" class="form-control" name="pro_price" value="<?php echo $edit->pro_price; ?>">
                <input type="text" class="form-control" name="pro_body" value="<?php echo $edit->pro_body ?>">
                <input type="hidden" class="form-control" name="cat_id" value="<?php echo $edit->cat_id; ?>">
                <input type="hidden" class="form-control" name="brand_id" value="<?php echo $edit->brand_id; ?>">
                <input type="file" class="form-control" name="pro_img" value="<?php echo $edit->pro_img; ?>">
                <input type="submit" name="submit" class="form-control" value="PROMENITE">
            </form>
        <?php }
}
    public function deleteProduct($id)
    {
        $stmt = $this->getDB()->prepare("delete from product where pro_id=:pro_id");
        $stmt->bindValue(":pro_id", $id);
        return $stmt->execute();
    }

    public function deleteProductId()
    {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->deleteProduct($id);
        } else {
            echo "<div class='alert alert-danger'>PROIZVOD NIJE IZBRISAN</div>";
        }
    }

    public function showProduct()
    {
        $stmt = $this->getDB()->prepare("select * from product");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function showSingleProduct($id)
    {
        $stmt = $this->getDB()->prepare("select * from product where pro_id=:pro_id");
        $stmt->bindValue(":pro_id",$id);
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function createSearch($search){
        $stmt = $this->getDB()->prepare("select * from product where pro_name like '%$search%'");
        $stmt->bindValue(":pro_name",$search);
        $stmt->execute();
        $rez =  $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }

    public function pagination($values, $per_page)
    {
        $total_values = count($values);
        if(isset($_GET["page"])){
            $current_page = $_GET["page"];
        }else{
            $current_page = 1;
        }
        $counts = ceil($total_values/$per_page);
        $param1 = ($current_page-1) * $per_page;
        $this->data = array_slice($values,$param1,$per_page);
        for($x = 1;$x<=$counts;$x++){
            $numbers[] = $x;
        }
        return  $numbers;
    }
    public function fetchRez(){
        $rezValues = $this->data;
        return $rezValues;
    }
    public function selectPriceRange(){
        $stmt = $this->getDB()->prepare("select * from product where pro_price between 300 and 600");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function selectPriceRange1(){
        $stmt = $this->getDB()->prepare("select * from product where pro_price between 600 and 1000");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;
    }
    public function selectPriceRange2()
    {
        $stmt = $this->getDB()->prepare("select * from product where pro_price between 1000 and 2500");
        $stmt->execute();
        $rez = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $rez;

        }
}

