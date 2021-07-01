<?php

namespace Controller;
session_start();

class Adminhome {
    public function get() {
    
        if(isset($_SESSION["adminid"])){
            \Controller\Utils::renderAdminHome();
        }
        else{
            header("Location: /adminlogin");
        }
       
    }

    public function post() {
        
        $title = $_POST["title"];
        $noofcopies = $_POST["noofcopies"];
        $isSetAll =  \Controller\Utils::isSetAll( $title, $noofcopies);
        if(isset($_SESSION["adminid"]) && $isSetAll )
        {

            for ($x = 0; $x < $noofcopies; $x++) {
                \Model\Admin::addbook($title, $noofcopies );
            }
            \Controller\Utils::renderAdminHome();
            
        }
        else if(isset($_SESSION["adminid"]) && !$isSetAll){
            \Controller\Utils::renderAdminHome();
            
        }
        else{
            header("Location: /adminlogin");
        }

    }
}