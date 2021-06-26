<?php

namespace Controller;

use PDO;

class Adminhome {
    public function get() {
        session_start();
        echo \View\Loader::make()->render("templates/adminhome.twig", array(
            "bookdata" => \Model\Post::get_allbooks(),
            "requests" => \Model\Post::showallrequests(),
        ));
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
        else{
            \Model\Post::addbook($title, $noofcopies );
        echo \View\Loader::make()->render("templates/adminhome.twig", array(
            "bookdata" => \Model\Post::get_allbooks(),
            "requests" => \Model\Post::showallrequests(),
        ));
        }

    }
}