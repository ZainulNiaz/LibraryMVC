<?php

namespace Controller;

use PDO;

class Denyreq {
    public function get() {
        session_start();
        echo \View\Loader::make()->render("templates/adminhome.twig", array(
            "bookdata" => \Model\Post::get_allbooks(),
            "requests" => \Model\Post::showallrequests(),
        ));
    }

    public function post() {
        session_start();
        $requestid = $_POST["requestid"];
        
        \Model\Post::denyreq( $requestid );
        echo \View\Loader::make()->render("templates/adminhome.twig", array(
            "bookdata" => \Model\Post::get_allbooks(),
            "requests" => \Model\Post::showallrequests(),
        ));
        

    }
}