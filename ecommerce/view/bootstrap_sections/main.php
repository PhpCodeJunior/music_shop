<?php  include_once(dirname(__FILE__) . "../../../spl/spl.php");
?>
<div class="row">
    <div class="col-sm-8">
        <script>
            var slide_index = 0;
            var slide_array = ["...ROK SE VRATIO U GRAD","...TI ZNAS ZASTO","...MI TAKO ROKAMO","...OVO JE PRAVA STVAR"];
            var element;
            function slideNext(){
                slide_index++;
                element.style.opacity=0;
                if(slide_index >(slide_array.length-1)){
                    slide_index=0;
                }
                setTimeout(" slide()",1000);

            }
            function slide(){
                element.innerHTML = slide_array[slide_index];
                element.style.opacity=1;
                setTimeout(" slideNext()",2000);
            }
        </script>

        <h1 style="color: yellow;">&nbsp;<span id="slide" style="color: yellow;opacity: 0;transition: opacity 1.0s linear 0s;"></span></h1>
        <script>element = document.getElementById("slide");slide();</script>

        <?php
        $pro = new ProductController();
        $wish = new  WishController();
        $cart = new CartController();
        $product = $pro->showProduct();
        $num = $pro->pagination($product,6);
        $data = $pro->fetchRez();
        $cart->addCart();

        foreach($data as $p){
            $w = $p->pro_id;
        ?>
        <div class="col-sm-4" id="music_band">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="pages/singleProduct.php?id=<?php echo $p->pro_id; ?>"><?php echo $p->pro_name; ?><br>Vise o bendu</a></div>
                <div class="panel-body">
                    <img src="images/product/<?php echo $p->pro_img; ?>" style="width: 100%;height: 150px;">
                </div>
                <div class="panel-footer">
                    <p><?php echo  $p->pro_price. " dinara"; ?></p>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-group">
                        <input type="hidden" name="user_id" class="form-control">
                        <input type="hidden" name="pro_id" value="<?php echo $p->pro_id; ?>" class="form-control">
                        <input type="number" name="q" min="0" max="100" step="1" value="1" id="q" class="form-control">
                        <input type="submit" name="submit" id="sub" class="btn btn-primary" value="DODAJ U KORPU">
                    </form>

                    <?php
                    if(isset($_POST["wish"])) {
                        if(isset($_SESSION["name"])) {
                            $id = $_SESSION["name"];
                            $user = $this->help->getLoggedInUserId($id);
                            $this->addWish($user, $p->pro_id, $p->q);
                        }else {
                            echo "<div class='alert alert-danger'>PROIZVOD  NIJE UBACEN U LISTU ZELJA</div>";
                        }
                    }
                    ?>
                    <form action="pages/wishList.php" method="post" class="form-group">
                        <input type="hidden" name="user_id" class="form-control">
                        <input type="hidden" name="pro_id" value="<?php echo $w; ?>" class="form-control">
                        <input type="hidden" name="q" class="form-control">
                        <input type="submit" name="wish" class="btn btn-default" value="LISTA ZELJA" id="wish_list_submit">
                    </form>
                </div>
        </div>

        </div>
        <?php } ?>

        <div class="row">
            <ul class="pagination">
                <?php
                foreach ($num as $n) { ?>
                <li><a href="index.php?page=<?php echo $n; ?>"><?php echo $n; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>

<br><br><br><br>
    <div class="col-sm-4">
        <?php
        $insert = new categoryController();
        $select = $insert->showCat();
        ?>

        <div class="panel-heading bg-primary" id="category" style="background-color: chartreuse;">KATEGORIJA <span class="glyphicon glyphicon-plus"></span></div>
        <div class="list-group" id="category_list">
            <?php foreach($select as $show){?>
            <a href="pages/showCategory.php?id=<?php echo $show->cat_id; ?>" class="list-group-item"><?php echo $show->cat_name; ?></a>

            <?php } ?>
        </div>
        <script>
            $(document).ready(function(){
               $("#category").click(function(){
                   $("#category_list").slideToggle("slow");
               });
            });
        </script>
        <div class="panel-heading bg-primary" id="brand" style="background-color: chartreuse;">BENDOVI <span class="glyphicon glyphicon-plus"></span></div>
        <div class="list-group" id="brand_list">
            <?php
            //include_once(dirname(__FILE__) . "/../../brand/brandController.php");
            $insert = new brandController();
            $brand = $insert->showBrand();
            foreach($brand as $brands){
            ?>
                <a href="pages/showBrand.php?id=<?php echo $brands->brand_id; ?>" class="list-group-item"><?php echo $brands->brand_name; ?></a>
            <?php } ?>
            <script>
                $(document).ready(function(){
                    $("#brand").click(function(){
                        $("#brand_list").slideToggle("slow");
                    });
                });
            </script>
        </div>
    </div>
</div>


<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading text-center">TOP 5 NAJBOLJE PRODAVANIH BENDOVA</div>
        <div class="panel-body">
    <div class="col-sm-12">
            <?php
            $order_sold = new OrderController();
            $sold_product = $order_sold->best_sold_product();
            foreach($sold_product as $best){ ?>
                <div class="col-md-2">
                    <div class="thumbnail">
                        <a href="pages/singleProduct.php?id=<?php echo $best->pro_id; ?>">
                            <img src="images/product/<?php echo $best->pro_img; ?>" style="width: 100%;height: 150px;">
                            <div class="caption">
                                <p><?php echo $best->pro_name; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php  } ?>
        </div>
    </div>
    </div>
</div>