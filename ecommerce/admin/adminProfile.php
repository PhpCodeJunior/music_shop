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
                if(isset($_SESSION["id"])) {
                    if (isset($_SESSION["admin"])) {
                        echo "<p style='color: #449d44;'>DOBRODOSLI, VAS NALOG JE SPREMAN ZA KORISCENJE</p>";
                         }
                    }
                    $controller= new UserController();
                    $controller->getDeleteUser();
                    if(isset($_SESSION["id"])) {
                        if (isset($_SESSION["admin"]) || $_SESSION["admin"]="1") {
                            $users = $controller->account($_SESSION["id"]);
                            foreach ($users as $user) { ?>

                                <img src="../images/users/<?php echo $user->user_img; ?>" class="img-circle" style="width:250px;height: 250px;">
                        <div class="col-sm-6">
                            <p class="center-left">IME : <?php echo $user->user_name; ?></p>
                            <p class="center-left">EMAIL: <?php echo $user->user_email; ?></p>
                            <p class="center-left">SIFRA: <?php echo $user->user_pass; ?></p>
                        </div>
                        <div class="row">
                            <div class="panel panel-primary">
                                <div class="panel-heading">AKCIJA ZA NALOG</div>
                                <div class="panel-body">
                                    <a class="center-left" href="adminProfile.php?id=<?php echo $user->user_id; ?>"><span class="glyphicon glyphicon-remove"></span>IZBRISI NALOG</a><br>
                                    <a class="center-left" href="userEdit.php?edId=<?php echo $user->user_id; ?>"><span class="glyphicon glyphicon-pencil"></span>PROMENI NALOG</a><br>
                                    <a class="center-left" href="changePass.php"><span class="glyphicon glyphicon-wrench"></span>PROMENI SIFRU</a><br>
                                </div>
                            </div>
                        </div>
                    <?php }} }?>
                    <div class="table-responsive">

                <table class="table">
                    <tr>
                        <th>DRZAVA</th>
                        <th>GRAD</th>
                        <th>ADRESA</th>
                        <th>POSTANSKI BROJ</th>
                        <th>TELEFON</th>
                        <th>AKCIJA</th>

                    </tr>
                    <?php
                    if(isset($_SESSION["id"])) {
                        $show = $info->showInfo($_SESSION["id"]);
                        foreach ($show as $in) { ?>
                            <tr>
                                <td><?php echo $in->state; ?></td>
                                <td><?php echo $in->city; ?></td>
                                <td><?php echo $in->address; ?></td>
                                <td><?php echo $in->p_code; ?></td>
                                <td><?php echo $in->mobile; ?></td>
                                <td><a href='adminProfile.php?del_id=<?php echo $in->info_id; ?>'><span class="glyphicon glyphicon-remove"></span></a>|
                                    <a href='../user_pages/editInfo.php?editId=<?php echo $in->info_id; ?>'><span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>
                        <?php }}
                    $info->getDeleteUser();
                    ?>

                </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <?php
            $info->insert();

            ?>
            <h2>DODATNE INFORMACIJE</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
                <input type="hidden" name="user_id">
                <input type="text" name="address" class="form-control" placeholder="adresa">
                <input type="text" name="city" class="form-control" placeholder="grad">
                <input type="text" name="p_code" class="form-control" placeholder="postanski broj">
                <input type="text" name="state" class="form-control" placeholder="drzava">
                <input type="text" name="mobile" class="form-control" placeholder="broj telefona">
                <input type="submit" name="submit" class="form-control" value="PRIJAVI">
            </form>

        </div>
    </div>

