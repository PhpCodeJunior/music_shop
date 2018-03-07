<?php

include_once(dirname(__FILE__) . "/../../../spl/spl.php");
include_once(dirname(__FILE__) . "/../../adminView.php");
$order = new OrderController();
//$select = $insert->showCat();
$bootstrap = new bootstrapAdmin();
$bootstrap->head();
$bootstrap->nav1(); ?>
<div class="row">
    <div class="col-sm-8">
        <h1>OSTALI PODACI</h1>
        <?php
        if(isset($_GET["id"])) {
            $info = new InfoController();
            //if (isset($_SESSION["id"])) {
                $all = $info->showAllInfo($_GET["id"]);
                foreach ($all as $fullInfo) {
                    echo "ADRESA " . $fullInfo->address . "<br>";
                    echo "DRZAVA " . $fullInfo->state . "<br>";
                    echo "GRAD " . $fullInfo->city . "<br>";
                    echo "POSTANSKI BROJ " . $fullInfo->p_code . "<br>";
                    echo "MOBILNI " . $fullInfo->mobile . "<br>";
                    echo "IME " . $fullInfo->user_name . "<br>";
                    echo "EMAIL " . $fullInfo->user_email . "<br>";
                }
            //}
        }
        ?>

    </div>
    <?php $bootstrap->main1(); ?>

</div>
