<?php

namespace Controller;

class Login {
    public function get() {
        echo \View\Loader::make()->render("templates/login.twig"); 
    }

    public function post() {
        session_start();
        $email = $_POST["email"];
        $password = $_POST["password"];
        \Model\Post::login( $email, $password );
        if($_SESSION["userid"] != NULL){
            echo \View\Loader::make()->render("templates/clienthome.twig", array(
                "bookdata" => \Model\Post::get_allbooks(),
                "pendingrequests" =>  \Model\Post::showpendingrequests(),
                "ownedbooks" =>  \Model\Post::get_ownedbooks(),
            ));
        }
        else{
            echo \View\Loader::make()->render("templates/login.twig", array(
                "posts" => \Model\Post::get_all(),
                "notloggedin" => true,
            ));
        }
        
    }
}