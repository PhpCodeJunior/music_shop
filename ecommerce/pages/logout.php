<?php  session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Galindo|Londrina+Shadow" rel="stylesheet">
    <link rel="stylesheet" href="/ecommerce/view/s.css" type="text/css">
</head>
<body style="font-family: 'Galindo', cursive;color: brown;background-image: url('/ecommerce/images/rock.jpg');
">
<div class="container fluid">
    <div class="well">
<?php
include_once(dirname(__FILE__) . "/../spl/spl.php");
$logout = new UserLogin();
$logout->logout();
?>
    </div>
</div>
