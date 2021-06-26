<?php

namespace Controller;

class Clienthome {
    public function get() {
        session_start();
        echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
            "bookdata" => \Model\Post::get_allbooks(),
            "pendingrequests" =>  \Model\Post::showpendingrequests(),
            "ownedbooks" =>  \Model\Post::get_ownedbooks(),
            )); 

    }

    public function post() {
        session_start();
         $bookid = $_POST['bookid'];
        \Model\Post::requestbook( $bookid );
        echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
            "bookdata" => \Model\Post::get_allbooks(),
            "pendingrequests" =>  \Model\Post::showpendingrequests(),
            "ownedbooks" =>  \Model\Post::get_ownedbooks(),
            )); 
    }
}