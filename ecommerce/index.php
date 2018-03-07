<?php
include_once(dirname(__FILE__) . "/spl/spl.php");

$bootstrap = new bootstrapClass();
$bootstrap->head();
$bootstrap->nav();
$bootstrap->sidenav();
$bootstrap->slide();
$bootstrap->main();
$bootstrap->footer();

?>

