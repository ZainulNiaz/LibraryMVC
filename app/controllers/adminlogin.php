<?php

namespace Controller;

class Adminlogin {
    public function get() {
        session_start();
        echo \View\Loader::make()->render("templates/adminlogin.twig" ,array(
            "userdata" => \Model\Post::get_all_userdata(),
            )); 

    }

    public function post() {
        session_start();
        $email = $_POST["email"];
        $password = $_POST["password"];
        // var_dump($_POST);
        \Model\Post::adminlogin( $email, $password );
        if($_SESSION["adminid"] != NULL){
            echo \View\Loader::make()->render("templates/adminhome.twig", array(
                "bookdata" => \Model\Post::get_adminbooks(),
                "requests" => \Model\Post::showallrequests(),
            ));
        }
        else{
            echo \View\Loader::make()->render("templates/adminlogin.twig", array(
                "posts" => \Model\Post::get_all(),
                "notloggedin" => true,
            ));
        }

    }
}