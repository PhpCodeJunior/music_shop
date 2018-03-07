<?php

include_once(dirname(__FILE__) . "/../../../spl/spl.php");
include_once(dirname(__FILE__) . "/../../adminView.php");
$order = new OrderController();
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
                <th>NARUCENO</th>
                <th>AKCIJA</th>
            </tr>
            <?php

                $ship = $order->showAllOrder();
                foreach($ship as $orders){
                    $status = $orders->status;

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
                        <td><?php echo $orders->realdate; ?></td>
                        <td>
                            <?php
                            if(isset($_POST["send"])) {
                                $sent = $order->editStatus($order->status(), $order->orderId());
                            }
                            ?>
                            <form method="post" action="" class="form-group">
                                <?php
                                if ($orders->status == 0) { ?>
                                    <button style="background-color: red;">POSALJITE PORUDZBINU</button>
                                <?php } elseif ($orders->status == 1) { ?>
                                    <button class="btn btn-default">POSLATA PORUDZBINA</button>
                                    <?php
                                }
                                ?>
                                <input type="hidden" name="order_id" value="<?php echo $orders->order_id; ?>">
                                <input type="number" name="status" value="<?php echo $orders->status; ?>">

                                <input type="submit" name="send" value="posalji" class="btn btn success">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        <?php echo "UKUOAN IZNOS ".  @$netTotal; ?>


    </div>

</div>
