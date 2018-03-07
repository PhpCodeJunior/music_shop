<?php
include_once(dirname(__FILE__)."/../../spl/spl.php");
?>
<div class="row">
    <div class="col-sm-4"><img src="/ecommerce/images/music.jpg" class="img-circle"></div>
    <div class="col-sm-4"  style="top:100px;">
        <form class="form-inline" id="find"  action="pages/find.php" method="post">
            <input type="text" name="search" id="search" class="form-control" placeholder="IME BENDA">
            <input type="submit" name="submit" id="submit" value="PRETRAZI"  class="form-control">
        </form>
    </div>
    <div class="col-sm-4">
        <div id="forgot_pass">
            <a href="user/user_pages/forgot_pass.php" id="forgot">ZABORAVILI STE LOZINKU? </a>
        </div>
    </div>
    <div class="col-sm-4" id="session" style="top:70px;">
        <?php if(isset($_SESSION["name"])){
            echo "DOBRODOSLI ". $_SESSION["name"]."<br>";
        echo "<a href='pages/logout.php'> IZLOGUJTE SE</a>";
         ?>
            </div>
    <div class="col-sm-4" id="cart_wish" style="">
    <a href="pages/cart.php" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart">KORPA<span class="badge">
                    <?php
                    $cart = new CartController();
                    if(isset($_SESSION["id"])) {
                        $cart->countCart($_SESSION["id"]);
                        //$cart->count();?>
                        </span></span></a>
        <a href="pages/wishList.php" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span>LISTA ZELJA<span class="badge">0</span></a>
                        <?php
                    }
                    }else{
            echo '<a href="pages/cart.php" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart">KORPA </span><span class="badge">0</span></a>';
            echo '<a href="pages/wishList.php" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span>LISTA ZELJA<span class="badge">0</span></a>';
                    }
                    ?>

    </div>

</div>
<nav class="navbar navbar-inverse" id="nav" style="background: linear-gradient(-90deg, black, gainsboro);">
    <div class="container">
        <div class="navbar-heading">
            <a class="nabbar-brand" href=""></a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="/ecommerce/index.php">POCETNA</a></li>
            <li><a href="">O NAMA</a></li>
            <li><a href="">KONTAKT</a></li>
            <li><a href="pages/cart.php">KORPA</a></li>
            <?php if(isset($_SESSION["name"])){ ?>
            <li><a href="user/user_pages/userProfile.php">PROFILNA STRANA</a></li>
            <?php } ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    PRIJAVA<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                        $log = new UserLogin();
                        $log->login();
                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
                        <input type="text" name="user_name" class="form-control" placeholder="VASE IME">
                        <input type="password" name="user_pass" class="form-control" placeholder="VASA SIFRA">
                        <input type="submit" name="submit" class="form-control" value="PRIJAVA">
                    </form>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    REGISTRACIJA<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    $user = new UserController();
                    $select = $user->register();
                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group" enctype="multipart/form-data">
                        <input type="text" name="user_name" class="form-control" placeholder="VASE IME">
                        <input type="text" name="user_email" class="form-control" placeholder="VAS EMAIL">
                        <input type="password" name="user_pass" class="form-control" placeholder="VASA SIFRA">
                        <input type="file" name="user_img" class="form-control">
                        <input type="submit" name="submit" class="form-control" value="PRIJAVA">
                    </form>
                </ul>
            </li>
        </ul>
    </div>
</nav>










<nav class="navbar navbar-inverse" id="nav-mobile" style="display:none;background: linear-gradient(-90deg, black, gainsboro);">
    <div class="container">
        <div class="navbar-heading">
            <a class="nabbar-brand" href=""></a>
        </div>

        <ul class="nav navbar-nav">
            <li><a href="/ecommerce/index.php">POCETNA</a></li>
            <li><a href="">O NAMA</a></li>
            <li><a href="">KONTAKT</a></li>
            <li><a href="pages/cart.php">KORPA</a></li>
            <?php if(isset($_SESSION["name"])){ ?>
                <li><a href="user/user_pages/userProfile.php">PROFILNA STRANA</a></li>
            <?php } ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    PRIJAVA<span class="caret"></span>
                </a>
                <?php
                //include_once(dirname(__FILE__)."/../../spl/spl.php");
                ?>
                <ul class="dropdown-menu">
                    <?php
                    //session_start();
                    $log = new UserLogin();
                    $log->login();
                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
                        <input type="text" name="user_name" class="form-control" placeholder="VASE IME">
                        <input type="password" name="user_pass" class="form-control" placeholder="VASA SIFRA">
                        <input type="submit" name="submit" class="form-control" value="PRIJAVA">
                    </form>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">
                    REGISTRACIJA<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    $user = new UserController();

                    $select = $user->register();

                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group" enctype="multipart/form-data">
                        <input type="text"  name="user_name" class="form-control" placeholder="VASE IME">
                        <input type="text" name="user_email" class="form-control" placeholder="VAS EMAIL">
                        <input type="password" name="user_pass" class="form-control" placeholder="VASA SIFRA">
                        <input type="file" name="user_img" class="form-control">
                        <input type="submit" name="submit" class="form-control" value="PRIJAVA">
                    </form>
                </ul>
            </li>
        </ul>
    </div>
</nav>