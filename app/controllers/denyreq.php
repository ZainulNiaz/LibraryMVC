<?php

namespace Controller;

session_start();

class Denyreq {
    public function get() {
     
        \Controller\Utils::renderAdminHome();
    }

    public function post() {
    
        $requestid = $_POST["requestid"];
        
        \Model\Admin::denyreq( $requestid );
        \Controller\Utils::renderAdminHome();

    }
}