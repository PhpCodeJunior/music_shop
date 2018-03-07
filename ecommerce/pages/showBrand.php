<?php  include_once(dirname(__FILE__) . "../../spl/spl.php");
$view = new bootstrapClass();
$view->head();
$view->nav1();


?>
</div>
<div class="row">
    <div class="col-sm-8">
        <h1>BRENDOVI</h1>
        <?php
        $cart = new CartController();
        $insert = new categoryController();
        $brand = new brandController();
        if(isset($_GET["id"])){
            $brand = $brand->showBrandId($_GET["id"]);
            $cart->addCart();
            foreach($brand as $p){
                ?>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading"><a href="../pages/singleProduct.php?id=<?php echo $p->pro_id; ?>"><?php echo $p->pro_name; ?></a></div>
                        <div class="panel-body">
                            <img src="../images/product/<?php echo $p->pro_img; ?>" style="width: 100%;height: 150px;">
                        </div>
                        <div class="panel-footer">
                            <p><?php echo $p->pro_price; ?></p>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
                                <input type="hidden" name="user_id" class="form-control">
                                <input type="hidden" name="pro_id" value="<?php echo $p->pro_id; ?>" class="form-control">
                                <input type="number" name="q" min="0" max="100" step="1" value="1" class="form-control">
                                <input type="submit" name="submit" class="btn btn-primary" value="DODAJ U KORPU">
                            </form>
                        </div>
                    </div>
                </div>
            <?php }
        }?>

    </div>
    <div class="col-sm-4">
        <?php
        $select = $insert->showCat();
        ?>

        <h1>KATEGORIJA</h1>
        <div class="list-group">
            <?php foreach($select as $show){?>
                <a href="../pages/showCategory.php?id=<?php echo $show->cat_id; ?>" class="list-group-item"><?php echo $show->cat_name; ?></a>

            <?php } ?>
        </div>
        <h1>BRENDOVI</h1>
        <div class="list-group">
            <?php
            $brandId = new brandController();
            $b = $brandId->showBrand();
            foreach($b as $brands){
                ?>
                <a href="../pages/showBrand.php?id=<?php echo $brands->brand_id; ?>" class="list-group-item"><?php echo $brands->brand_name; ?></a>
            <?php } ?>
        </div>
    </div>
</div>
<?php $view->footer(); ?>
