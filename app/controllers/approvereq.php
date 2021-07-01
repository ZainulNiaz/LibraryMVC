<?php

namespace Controller;

session_start();

class Approvereq {
    public function get() {
       
        \Controller\Utils::renderAdminHome();
    }

    public function post() {
        $requestid = $_POST["requestid"];
        
        \Model\Admin::approvereq( $requestid );
        \Controller\Utils::renderAdminHome();
        

    }
}