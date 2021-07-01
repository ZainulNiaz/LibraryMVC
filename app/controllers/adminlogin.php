<?php

namespace Controller;
session_start();

class Adminlogin {
    public function get() {
   
        if(isset($_SESSION["adminid"])){
            header("Location: /adminhome");
        }
        else{
            \Controller\Utils::renderAdminLogin(); 
        }
       
    }

    public function post() {
   
        $email = $_POST["email"];
        $password = $_POST["password"];
        $isSetAll = \Controller\Utils::isSetAll( $email, $password);
        
        if($isSetAll){
            \Model\Admin::adminlogin( $email, $password );
                if(isset($_SESSION["adminid"])){
                    header("Location: /adminhome");
                }
                else{
                    \Controller\Utils::renderAdminLogin();
                }

        }
        else{
            \Controller\Utils::renderAdminLogin();
        }
        
    }
}