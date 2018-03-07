<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");

$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav1();
?>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="well">
            <?php
            $find_product = new ProductController();
            if(isset($_POST["submit"])){
                $search =  $find_product->search();
                $product = $find_product->createSearch($search);
                foreach($product as $product_find){
                    ?>
                    <img src="../images/product/<?php echo $product_find->pro_img; ?>" class="img-thumbnail">
                    <div class="col-sm-6">
                        <p class="center-left">IME PROIZVODA: <?php echo $product_find->pro_name; ?></p>
                        <p class="center-left">CENA PROZIVODA: <?php echo $product_find->pro_price; ?></p>
                        <a href="../pages/cart.php" class="btn btn-success">DODAJ U KORPU</a>
                    </div>
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">SPECIFIKACIJE O PROIZVODU</div>
                            <div class="panel-body">
                                <?php echo $product_find->pro_body; ?>
                            </div>
                        </div>
                    </div>
                <?php } }?>
        </div>
    </div>
    <?php $bootstrap->cb();
    ?>
</div>
<?php
$bootstrap->cb();
$bootstrap->footer();
?>
