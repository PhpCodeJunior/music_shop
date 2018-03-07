<div class="col-sm-4 sidenav" style="">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="">FILTER ZA CENU</a></div>
            <div class="panel-body">
                <form class="form-group" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <input type="checkbox"  name="price[]" value="1"> CENA OD 300-600 DINARA<br>
                    <input type="checkbox"  name="price[]" value="2">CENA OD 600-1000 DINARA<br>
                    <input type="checkbox"  name="price[]" value="3">CENA OD 1000-2500 DINARA<br>
                    <input type="submit" name="submit" class="form-control" value="TRAZI">
                </form>
                <?php
                include_once(dirname(__FILE__) . "../../../spl/spl.php");
                $product = new ProductController();
                $range=$product->selectPriceRange();
                $range1=$product->selectPriceRange1();
                $range2=$product->selectPriceRange2();

                if($_SERVER["REQUEST_METHOD"]=="POST") {
                    if (isset($_POST["price"])) {
                        $price = $_POST["price"];
                        $c = count($price);
                            for ($i = 0; $i < $c; $i++) {
                                if ($price[$i] == 1) {
                                    echo "CENOVNIK<br>";
                                    foreach ($range as $r) {
                                        ?>
                                        <a href='pages/singleProduct.php?id=<?php echo $r->pro_id; ?>'><?php echo $r->pro_name; ?>
                                            DETALJI</a>
                                        <?php
                                        echo $r->pro_price . "<br>";
                                    }
                                }
                                if ($price[$i] == 2) {
                                    echo "CENOVNIK<br>";
                                    foreach ($range1 as $r1) {
                                        ?>
                                        <a href='pages/singleProduct.php?id=<?php echo $r1->pro_id; ?>'><?php echo $r1->pro_name; ?>
                                            DETALJI</a>
                                        <?php
                                        echo $r1->pro_price . "<br>";
                                    }
                                }
                                if ($price[$i] == 3) {
                                    echo "CENOVNIK<br>";
                                    foreach ($range2 as $r2) {
                                        ?>
                                        <a href='pages/singleProduct.php?id=<?php echo $r2->pro_id; ?>'><?php echo $r2->pro_name; ?>
                                            DETALJI</a>
                                        <?php
                                        echo $r2->pro_price . "<br>";
                                    }
                                }
                            }
                        }
                }


                ?>
           </div>
        </div>
    </div>
