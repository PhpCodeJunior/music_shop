<?php

class bootstrapClass
{
 public function __construct(){

 }
    public function head(){
        include_once(dirname(__FILE__)."/bootstrap_sections/head.php");
    }
    public function cb(){
        include_once(dirname(__FILE__)."/bootstrap_sections/categoryBrand.php");
    }
    public function nav(){
        include_once(dirname(__FILE__)."/bootstrap_sections/nav.php");
    }
    public function nav1(){
        include_once(dirname(__FILE__)."/bootstrap_sections/nav1.php");
    }
    public function nav2(){
        include_once(dirname(__FILE__)."/bootstrap_sections/nav2.php");
    }
    public function sidenav(){
        include_once(dirname(__FILE__)."/bootstrap_sections/sidenav.php");
    }
    public function slide(){
        include_once(dirname(__FILE__)."/bootstrap_sections/slide.php");
    }
    public function main(){
        include_once(dirname(__FILE__)."/bootstrap_sections/main.php");
    }
    public function footer(){
        include_once(dirname(__FILE__)."/bootstrap_sections/footer.php");
    }
}