<?php

include_once(dirname(__FILE__) . "/../../../spl/spl.php");
include_once(dirname(__FILE__) . "/../../adminView.php");
$insert = new categoryController();
$select = $insert->showCat();
$bootstrap = new bootstrapAdmin();
$bootstrap->head();
$bootstrap->nav1(); ?>
<div class="row">
    <div class="col-sm-8">
        <?php $insert->editCatId(); ?>
    </div>

    <?php $bootstrap->main1(); ?>

</div>

