<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");
include_once(dirname(__FILE__) . "/adminView.php");


$bootstrap = new bootstrapAdmin();
$bootstrap->head();
$bootstrap->nav();
$info = new InfoController();
?>

<div class="row">
    <div class="col-sm-8">
        <div class="well">
            <?php
                    echo "<h1 style='color: #449d44;'>REGISTROVANI KORISNICI</h1>";
            $controller= new UserController();
            $controller->getDeleteUser();
            $users = $controller->showUsers();

                    foreach ($users as $user) { ?>

                        <img src="../images/users/<?php echo $user->user_img; ?>" class="img-circle" style="width:100px;height: 100px;">
                        <div class="col-sm-6">
                            <p class="center-left">IME : <a href='adminPages/users/usersProfile.php?id=<?php echo $user->user_id; ?>'><?php echo $user->user_name; ?></a></p>
                            <p class="center-left">EMAIL: <?php echo $user->user_email; ?></p>
                            <p class="center-left">SIFRA: <?php echo $user->user_pass; ?></p>
                        </div>
                        <div class="row">
                            <div class="panel panel-primary">
                                <div class="panel-heading">AKCIJA ZA NALOG</div>
                                <div class="panel-body">
                                    <a class="center-left" href="users.php?id=<?php echo $user->user_id; ?>"><span class="glyphicon glyphicon-remove"></span>IZBRISI NALOG</a><br>
                                </div>
                            </div>
                        </div>
                    <?php }?>

</div>

