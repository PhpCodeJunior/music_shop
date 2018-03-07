<?php

class bootstrapAdmin
{
    public function __construct(){

    }
    public function head(){
        include_once(dirname(__FILE__)."/admin_sections/head.php");
    }
    public function nav(){
        include_once(dirname(__FILE__)."/admin_sections/nav.php");
    }
    public function nav1(){
        include_once(dirname(__FILE__)."/admin_sections/nav1.php");
    }
    public function main(){
        include_once(dirname(__FILE__)."/admin_sections/main.php");
    }
    public function main1(){
        include_once(dirname(__FILE__)."/admin_sections/main1.php");
    }

}