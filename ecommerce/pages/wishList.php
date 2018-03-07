<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");

$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav1();
$wish = new WishController();
$help = new helpers();
?>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="well">
                <table class="table table-bordered">
                    <tr>
                        <th>PROIZVOD</th>
                        <th>IME</th>
                        <th>CENA</th>
                        <th>KOLICINA</th>
                        <th>AKCIJA</th>
                    </tr>
                    <?php
                    $wish->deleteWishId();
                    if(isset($_SESSION["name"])){
                        $id = $_SESSION["name"];
                        $user = $help->getLoggedInUserId($id);
                        $display = $wish->wishDisplay($user);
                        foreach($display as $user){ ?>
                            <tr>
                                <td><img src="../images/product/<?php echo $user->pro_img; ?>" class="images_cart"></td>
                                <td><?php echo $user->pro_name; ?></td>
                                <td><?php echo $user->pro_price; ?></td>
                                <td><input type="number" name="q" value="<?php echo $user->q; ?>"></td>
                                <td><?php //$user->pro_name; ?><a href="">DODAJ</a> / <a href="../pages/wishList.php?id=<?php echo $user->wish_id; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                                <?php
                                $price = $user->pro_price;
                                $q = $user->q;
                                $count=$price * $q;
                                @$netTotal +=$count;
                                ?>
                            </tr>
                        <?php } } ?>
                    <p style="float: right;"><a href="../index.php"><span class="glyphicon glyphicon-shopping-cart">NASTAVITE SA KUPOVINOM</span></a> |
                        <?php echo "UKUPAN IZNOS: ".@$netTotal;?></p>
                </table>
            </div>
        </div>
    </div>
<?php
$bootstrap->footer();
?>