<?php
spl_autoload_register(function ($class) {

    $category = dirname(__FILE__).'/../category/' . $class . '.php';
    $brand = dirname(__FILE__).'/../brand/' . $class . '.php';
    $product = dirname(__FILE__).'/../product/' . $class . '.php';
    $view = dirname(__FILE__).'/../view/' . $class . '.php';
   $help = dirname(__FILE__).'/../helpers/' . $class . '.php';
    $user = dirname(__FILE__).'/../user/' . $class . '.php';
    $db = dirname(__FILE__).'/../database/' . $class . '.php';
    $cart = dirname(__FILE__).'/../cart/' . $class . '.php';
    $wish = dirname(__FILE__).'/../wish/' . $class . '.php';
    $order = dirname(__FILE__).'/../order/' . $class . '.php';
    $comm = dirname(__FILE__).'/../comments/' . $class . '.php';
    $valid = dirname(__FILE__).'/../valid/' . $class . '.php';




    if (file_exists($category)) {
        require_once $category;
    } elseif (file_exists($brand)) {
        require_once $brand;
    } elseif (file_exists($product )) {
        require_once $product ;
    }elseif (file_exists($view )) {
        require_once $view ;
    }elseif (file_exists($help )) {
        require_once $help ;
    } elseif (file_exists($user )) {
        require_once $user ;
    } elseif (file_exists($db )) {
        require_once $db ;
    }elseif (file_exists($cart )) {
        require_once $cart ;
    }elseif (file_exists($wish )) {
        require_once $wish;
    }elseif (file_exists($order )) {
        require_once $order;
    }elseif (file_exists($comm )) {
        require_once $comm;
    }elseif (file_exists($valid )) {
        require_once $valid;
    }
});