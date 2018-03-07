<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");

$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav1();
$help = new helpers();?>
</div>
<?php
$cart = new CartController();
?>
    <div class="row" style="background-color: white;">
        <div class="col-sm-6">
                <h1>VASA PORUDZBINA</h1>
              <div class="table-responsive">

                <table class="table">
                    <tr>
                        <th>PROIZVOD</th>
                        <th>IME</th>
                        <th>CENA</th>
                        <th>KOLICINA</th>
                        <th>IZNOS</th>
                    </tr>
                    <?php
                    if(isset($_SESSION["name"])){
                        $name_session = $_SESSION["name"];
                        $user_name = $help->getLoggedInUserId($name_session);
                        $order_show = $cart->cartDisplayArray($user_name);
                        $i=0;
                        foreach($order_show as $orders){
                            $img = $orders["pro_img"];
                            $pro_name = $orders["pro_name"];
                            $pro_id = $orders["pro_id"];
                            $price = $orders["pro_price"];
                            $quantity = $orders["q"];
                            $t = array($price * $quantity);
                            $total = array_sum($t);
                            $i += $total;

                            ?>
                            <tr>
                                <td><img src="../images/product/<?php echo $img; ?>" class="images_cart"></td>
                                <td><?php echo $pro_name; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $total; ?></td>
                            </tr>
                        <?php } } ?>
                </table>
                </div>

                <p style="float: right;">
                    <?php echo "UKUPAN IZNOS: ".$i;?>
                </p>
        </div>
        <div class="col-sm-6">
                <h1>ISPORUCICEMO POSILJKU NA OVU ADRESU</h1>
                <?php
                $info = new InfoController();
                if(isset($_SESSION["id"])) {
                    $all = $info->showAllInfo($_SESSION["id"]);
                    foreach($all as $fullInfo){
                        echo "ADRESA ". $fullInfo->address."<br>";
                        echo "DRZAVA ". $fullInfo->state."<br>";
                        echo "GRAD ". $fullInfo->city."<br>";
                        echo "POSTANSKI BROJ ". $fullInfo->p_code."<br>";
                        echo "MOBILNI ". $fullInfo->mobile."<br>";
                        echo "IME ". $fullInfo->user_name."<br>";
                        echo "EMAIL ". $fullInfo->user_email."<br>";
                    }
                }
                ?>
                <?php
                if (isset($_POST["submit"])) {
                    if (isset($_SESSION["name"])) {
                        $order = new OrderController();
                        $date = date("Y-m-d H:i:s");
                        $user = $help->getLoggedInUserId($_SESSION["name"]);
                        if (empty($user)  || empty($pro_id) || empty($quantity) || empty($date)) {
                            //echo "<div class='alert alert-danger'>POPUNITE SVA POLJA</div>";
                        } else {
                           $showOrder = $cart->cartDisplayArray($user);
                            foreach($showOrder as $order_single){
                            $p_id = $order_single["pro_id"];
                            $qyt = $order_single["q"];
                            $order->insertOrder($user, $p_id, $qyt, $date);
                            $cart->sold_product($user, $p_id, $qyt, $date);
                            $cart->deleteAllFromCart();
                            }
                            $from = @$fullInfo->user_email. " OBRATITE SE NA OVAJ EMAIL";
                            $to = "slavkoslave89@gmail.com";
                            $subject="PORUDZBINA";
                            $headers = "EMAIL KORISNIKA "  . $from ;
                            $mess = "POGLEDAJTE NARUDZBINU  http://localhost/ecommerce/admin/adminPages/users/usersOrder.php";
                            mail($to,$subject,$mess,$headers);
                            echo "<div class='alert alert-primary'>USPESNO STE NARUCILI, HVALA!</div>";
                        }
                    }
                }
                ?>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="user_id">
                    <input type="hidden" name="pro_id" value="<?php echo @$pro_id; ?>">
                    <input type="hidden" name="q" value="<?php  //echo @$q;?>">
                    <input type="hidden" name="realdate">
                    <input type="submit" name="submit" value="NARUCITE" class="form-control btn btn-success">
                </form>
            </div>
        </div>
<?php
$bootstrap->footer();
?>