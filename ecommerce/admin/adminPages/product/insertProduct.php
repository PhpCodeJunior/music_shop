<?php
include_once(dirname(__FILE__) . "/../../../spl/spl.php");
include_once(dirname(__FILE__) . "/../../adminView.php");
$insert = new ProductController();
$select = $insert->showProduct();

$bootstrap = new bootstrapAdmin();
$bootstrap->head();
$bootstrap->nav1();


$brand = new brandController();
$brands = $brand->showBrand();
$cat = new categoryController();
$cats = $cat->showCat();
?>
<div class="row">
    <div class="col-sm-8">
        <h1>DODAJTE NOVU KATEGORIJU</h1>
        <?php $insert->addProduct();
        ?>
        <form class="form-group" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <input type="text" name="pro_name"  placeholder="IME" class="form-control">
            <input type="text" name="pro_price"  placeholder="CENA" class="form-control">
            <textarea name="pro_body" type="text"  placeholder="TEKST" class="form-control"></textarea>
            <select name="cat_id">
                <option>KATEGORIJA</option>
                <?php foreach($cats as $c){ ?>
                <option value="<?php echo $c->cat_id; ?>"><?php echo $c->cat_name; ?>
                    <?php } ?>
                </option>
            </select>
            <select name="brand_id">
                <option>BREND</option>
                <?php foreach($brands as $b){ ?>
                <option value="<?php echo $b->brand_id; ?>"><?php echo $b->brand_name; ?>
                    <?php } ?>
                </option>
            </select>
            <input type="file" name="pro_img"  class="form-control">
            <input type="submit" name="submit" id="sub" value="DODAJ" class="form-control">
        </form>
        <script>

        </script>
        <table class="table table-bordered">
            <tr>
                <th>IME</th>
                <th>AKCIJA</th>
            </tr>
            <?php
            $insert->deleteProductId();
            foreach($select as $show){ ?>
                <tr>
                    <td><?php echo $show->pro_name; ?></td>
                        <td><a href="../product/insertProduct.php?id=<?php echo $show->pro_id; ?>">IZBRISI</a> /
                        <a href="../product/editProduct.php?ed_id=<?php echo $show->pro_id; ?>">IZMENI</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <?php $bootstrap->main1(); ?>

</div>

