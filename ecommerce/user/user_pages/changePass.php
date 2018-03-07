<?php
include_once(dirname(__FILE__) . "/../../spl/spl.php");
$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav2();

$controller= new UserController();


$controller->executePass();
?>
</div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-group">
    <input type="password" name="user_pass" placeholder="pass" class="form-control"></br>
    <input type="password" name="newPass" placeholder="new pass" class="form-control"></br>
    <input type="password" name="confirmPass" placeholder="confirm pass" class="form-control"></br>
    <input type="submit" name="submit" class="form-control">
</form>
<?php $bootstrap->footer(); ?>
