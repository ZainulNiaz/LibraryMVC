<?php

namespace Controller;

use PDO;

class Adminhome {
    public function get() {
        session_start();
        if($_SESSION["adminid"] !=NULL){
            echo \View\Loader::make()->render("templates/adminhome.twig", array(
                "bookdata" => \Model\Post::get_adminbooks(),
                "requests" => \Model\Post::showallrequests(),
            ));
        }
        else{
            echo \View\Loader::make()->render("templates/adminlogin.twig" ,array(
                "userdata" => \Model\Post::get_all_userdata(),
                )); 
        }
       
    }

    public function post() {
        session_start();
        $title = $_POST["title"];
        $noofcopies = $_POST["noofcopies"];
        if($noofcopies == NULL){
            $noofcopies = 1;
        }
        if($title == NULL){

        }
        else if($_SESSION["adminid"]!= NULL ){

        for ($x = 0; $x < $noofcopies; $x++) {
            \Model\Post::addbook($title, $noofcopies );
        }
        
        
        \Model\Post::addbook($title, $noofcopies );
        echo \View\Loader::make()->render("templates/adminhome.twig", array(
            "bookdata" => \Model\Post::get_adminbooks(),
            "requests" => \Model\Post::showallrequests(),
        ));
        }
        else{
            echo \View\Loader::make()->render("templates/adminlogin.twig" ,array(
                "userdata" => \Model\Post::get_all_userdata(),
                )); 
        }

    }
}