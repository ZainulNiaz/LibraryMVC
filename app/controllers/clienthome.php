<?php

namespace Controller;

class Clienthome {
    public function get() {
        session_start();
        if($_SESSION["userid"]!=NULL){
            echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
                "bookdata" => \Model\Post::get_allbooks(),
                "pendingrequests" =>  \Model\Post::showpendingrequests(),
                "ownedbooks" =>  \Model\Post::get_ownedbooks(),
                )); 
        }
        else{
            echo \View\Loader::make()->render("templates/login.twig", array(
               
                
            ));
        }
       

    }

    public function post() {
        session_start();
         $bookid = $_POST['bookid'];
         if($_SESSION["userid"]!= NULL){
            \Model\Post::requestbook( $bookid );
            echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
                "bookdata" => \Model\Post::get_allbooks(),
                "pendingrequests" =>  \Model\Post::showpendingrequests(),
                "ownedbooks" =>  \Model\Post::get_ownedbooks(),
                )); 
         } else{
            echo \View\Loader::make()->render("templates/login.twig", array(
               
            
            ));
         }
       
    }
}