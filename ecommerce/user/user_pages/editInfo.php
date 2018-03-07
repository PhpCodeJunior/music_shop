<?php
include_once(dirname(__FILE__) . "/../../spl/spl.php");
$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav2();

$controller= new InfoController();
?>
</div>
    <div class="row">
        <div class="col-sm-8">
            <?php $controller->editInformation(); ?>
        </div>
    </div>


<?php $bootstrap->footer(); ?>