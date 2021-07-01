<?php

namespace Controller;
session_start();

class Returnbook {
    public function get() {
        
        header("Location: /clienthome");

    }

    public function post() {
    
         $bookid = $_POST['bookid'];
        \Model\User::returnbook( $bookid );
        header("Location: /clienthome");
    }
}