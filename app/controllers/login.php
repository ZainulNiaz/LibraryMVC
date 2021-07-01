<?php

namespace Controller;
session_start();
class Login {
    public function get() {
        if(isset($_SESSION["userid"])){
            header("Location: /clienthome");
        }
        else{
            echo \View\Loader::make()->render("templates/login.twig"); 
        }
        
    }

    public function post() {
    
        $email = $_POST["email"];
        $password = $_POST["password"];
        \Model\User::login( $email, $password );
        $isSetAll = \Controller\Utils::isSetAll( $email, $password);
       if($isSetAll){
            if($_SESSION["userid"] != NULL){
                header("Location: /clienthome");
            }
            else{
                \Controller\Utils::renderLogin();
            }
       }
       else{
        \Controller\Utils::renderLogin();
       }
      
    }
}