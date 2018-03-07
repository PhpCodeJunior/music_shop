<div class="row">
    <div class="col-sm-4"><img src="/ecommerce/images/music.jpg" class="img-circle"></div>
    <div class="col-sm-4" style="top:100px;">
        <form class="form-inline" action="" method="">
            <input type="text" name="search" class="form-control">
            <input type="submit" name="submit" value="PRETRAZI" placeholder="pretraga" class="form-control">
        </form>
    </div>
    <div class="col-sm-4" style="top:100px;">
        <p><span class="glyphicon glyphicon-user"></span> WELCOME ADMIN
        <?php
        $role = @$_SESSION["admin"];
        if(isset($_SESSION["admin"]) || $role="1"){
                echo @$_SESSION["name"] . '</p><a href="../pages/logout.php" class="btn btn-primary"> LOGOUT</a>';
            }
        ?>
    </div>

</div>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-heading">
            <a class="navbar-brand" href=""></a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">POCETNA</a></li>
            <li><a href="adminProfile.php">PROFIL ADMINA</a></li>
            <li><a href="users.php">REGISTROVANI KORISNICI</a></li>
        </ul>
    </div>
</nav>