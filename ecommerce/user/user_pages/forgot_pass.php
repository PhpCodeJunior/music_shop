<?php
include_once(dirname(__FILE__) . "/../../spl/spl.php");
$bootstrap = new bootstrapClass();
$bootstrap->head();
//$bootstrap->nav2();
$controller= new UserController();

$controller->return_forgot_pass();
?>

</div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin">
    <h2 class="form-signin-heading">ZABORAVILI STE SIFRU</h2>
    <div class="input-group">
    <span class="input-group-addon">@</span>
    <input type="text" name="user_name" class="form-control" placeholder="UPISITE VASE IME">
</div>
    <input type="submit" name="forgot" class="btn btn-lg btn-primary btn-block" value="POSALJI">
    <a href="../../index.php"  class="btn btn-primary"><span class="glyphicon glyphicon-hand-left"></span>&nbsp;POCETNA</a>
</form>
<?php //$bootstrap->footer(); ?>