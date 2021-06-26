<?php

namespace Controller;

class Returnbook {
    public function get() {
        session_start();
        echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
            "bookdata" => \Model\Post::get_allbooks(),
            "pendingrequests" =>  \Model\Post::showpendingrequests(),
            )); 

    }

    public function post() {
        session_start();
         $bookid = $_POST['bookid'];
        \Model\Post::returnbook( $bookid );
        echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
            "bookdata" => \Model\Post::get_allbooks(),
            "pendingrequests" =>  \Model\Post::showpendingrequests(),
            "ownedbooks" =>  \Model\Post::get_ownedbooks(),
            )); 
    }
}