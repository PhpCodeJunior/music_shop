<div class="col-sm-4">
    <?php
    //include_once(dirname(__FILE__) . "/../../category/categoryController.php");
    $insert = new categoryController();
    $select = $insert->showCat();
    ?>

    <div class="panel-heading bg-primary" style="background-color: chartreuse;">KATEGORIJA <span class="glyphicon glyphicon-plus"></span></div>
    <div class="list-group">
        <?php foreach($select as $show){?>
            <a href="../pages/showCategory.php?id=<?php echo $show->cat_id; ?>" class="list-group-item"><?php echo $show->cat_name; ?></a>

        <?php } ?>
    </div>

    <div class="panel-heading bg-primary" style="background-color: chartreuse;">BENDOVI <span class="glyphicon glyphicon-plus"></span></div>
    <div class="list-group">
        <?php
        //include_once(dirname(__FILE__) . "/../../brand/brandController.php");
        $insert = new brandController();
        $brand = $insert->showBrand();
        foreach($brand as $brands){
            ?>
            <a href="../pages/showBrand.php?id=<?php echo $brands->brand_id; ?>" class="list-group-item"><?php echo $brands->brand_name; ?></a>
        <?php } ?>
    </div>
</div>