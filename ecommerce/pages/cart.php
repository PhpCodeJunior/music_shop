<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");

$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav1();
$help = new helpers();
$cart = new CartController();
?>
</div>
    <div class="row">
             <div class="col-sm-12" style="background-color: white;">
                     <div class="well">
<div class="table-responsive">

                <table class="table" id="table">
                    <tr>
                        <th>PROIZVOD</th>
                        <th>IME</th>
                        <th>CENA</th>
                        <th>KOLICINA</th>
                        <th>AKCIJA</th>
                    </tr>
                    <?php
                    $cart->deleteCartId();
                    if(isset($_SESSION["name"])){
                       $name = $_SESSION["name"];
                       $user_name = $help->getLoggedInUserId($name);
                        $show_cart = $cart->cartDisplay($user_name);
                        foreach($show_cart as $cart_show){
                         $q = $cart->q();
                         $cart_id= $cart_show->cart_id;
                         $qyt = $cart_show->q;
                         $price = $cart_show->pro_price;
                         $img =$cart_show->pro_img;
                         $product_name = $cart_show->pro_name;
                        ?>
                    <tr>
                        <td><img src="../images/product/<?php echo $img; ?>" class="images_cart"></td>
                        <td><?php echo $product_name; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                        <?php
                         if (isset($_POST["update"])) {
                         $upd = $cart->updateQuantity($cart->cartId(),$cart->q());
                                } ?>
                        <form method="post" action="cart.php">
                        <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                        <input type="number" name="q" value="<?php echo $qyt; ?>">
                        <input type="submit" name="update" value="PROMENI">
                        </form>
                        </td>
                        <td><a href="../pages/cart.php?id=<?php echo $cart_id; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                        <?php
                        $count=$price * $qyt;
                        @$netTotal +=$count;
                        ?>
                    </tr>
                        <?php } } else{?>
                       <h1>KORPA JE PRAZNA, MORATE DA BUDETE CLAN NASEG SHOPA, HVALA!</h1>
                       <tr>
                        <td><img src=""></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                   <?php } ?>
                <p style="float: right;"><?php echo "UKUPAN IZNOS: ".@$netTotal;?></p>
                </table>
                     <div class="col-sm-4">
               <a href="../index.php"><img src="../images/shop.jpg" class="images_pay"></a>
               </div>
                <div class="col-sm-8">
                <a href="../pages/checkout.php"><img src="../images/pay.jpg" class="images_pay"></a>&nbsp;&nbsp;&nbsp;
                    <a href="../pages/offline.php"><img src="../images/offline.jpg" class="images_pay"></a>
                </div>
                </div>

            </div>
        </div>
    </div>
<?php
$bootstrap->footer();
?>