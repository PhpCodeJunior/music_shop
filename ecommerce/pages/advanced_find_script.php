<?php  include_once(dirname(__FILE__) . "/../spl/spl.php");
$product = new ProductController();
//$q = $product->showProduct();
?>
<div class="row">
    <div class="col-sm-8">

        <div class="table-responsiv">
            <table class="table">
                <tr>
                    <th>IME</th>
                    <th>SLIKA</th>
                    <th>CENA</th>
                </tr>
                <?php
                if(isset($_POST["search_text"])){
                    $sub =  $_POST["search_text"];
                    $p = $product->createSearch($sub);?>
                    <?php
                    foreach($p as $query){
                        ?>
                        <tr>
                            <td><a href="singleProduct.php?id=<?php echo $query->pro_id; ?>"><?php echo $query->pro_name; ?>&nbsp;Vise o bendu</a></td>
                            <td><img src="../images/product/<?php echo $query->pro_img; ?>" style="width: 100px;height: 150px;"></td>
                            <td><?php echo  $query->pro_price. " dinara"; ?></td>

                        </tr>
                    <?php } }?>
            </table>

        </div>
</div>