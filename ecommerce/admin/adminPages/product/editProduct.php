<?php

include_once(dirname(__FILE__) . "/../../adminView.php");
include_once(dirname(__FILE__) . "/../../../spl/spl.php");
$insert = new ProductController();
$bootstrap = new bootstrapAdmin();
$bootstrap->head();
$bootstrap->nav1(); ?>
<div class="row">
    <div class="col-sm-8">
        <?php $insert->editProductId(); ?>
    </div>

    <?php $bootstrap->main1(); ?>

</div>
