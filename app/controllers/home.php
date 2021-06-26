<?php

namespace Controller;

class Home {
    public function get() {
        echo \View\Loader::make()->render("templates/home.twig", array(
            "posts" => \Model\Post::get_all(),
        )); 
    }

    public function post() {
        session_start();
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password1 = $_POST["password"];
        $password = password_hash($password1, PASSWORD_DEFAULT);
        \Model\Post::create($name, $email, $password );
        echo \View\Loader::make()->render("templates/home.twig", array(
            "posts" => \Model\Post::get_all(),
            "alreadyexist" => \Model\Post::checkemailexist($name, $email, $password ),
        ));
    }
}