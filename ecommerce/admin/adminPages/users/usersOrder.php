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
        <table class="table table-bordered">
            <tr>
                <th>BEND</th>
                <th>CENA</th>
                <th>KOLICINA</th>
                <th>SLIKA</th>
                <th>DETALJI KORISNIKA</th>
                <th>IZNOS</th>
                <th>AKCIJA</th>
            </tr>
            <?php
            if(isset($_SESSION["id"])){
            $ship = $order->showOrder($_SESSION["id"]);
            foreach($ship as $orders){
             ?>
            <tr>
                <td><?php echo $orders->pro_name; ?></td>
                <td><?php echo $orders->pro_price; ?></td>
                <td><?php echo $orders->q; ?></td>
                <?php $total = $orders->pro_price * $orders->q;
                @$netTotal +=$total;
                ?>
                <td><img src="../../../images/product/<?php echo $orders->pro_img; ?>" style="width: 70px;height: 70px;"></td>
                <td><a href='../users/usersProfile.php?id=<?php echo $orders->user_id; ?>'><?php echo $orders->user_name; ?></a></td>
                <td><?php echo $total; ?></td>
            </tr>
                <?php
            } }
            ?>
        </table>
        <?php echo "UKUOAN IZNOS ".  @$netTotal; ?>


    </div>
    <?php $bootstrap->main1(); ?>

</div>
