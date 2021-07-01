<?php

namespace Controller;
session_start();

class Utils {
    public static function isSetAll(...$values)
    {
        $flag=true;
        foreach($values as $v)
            if(empty($v) || !isset($v))
                $flag=false;
        return $flag;
    }

    public static function renderAdminHome(){
        echo \View\Loader::make()->render("templates/adminhome.twig", array(
            "bookdata" => \Model\Admin::get_adminbooks(),
            "requests" => \Model\Admin::showallrequests(),
        ));
    }

    public static function renderAdminLogin(){
        echo \View\Loader::make()->render("templates/adminlogin.twig", array(
            "posts" => \Model\User::get_all(),
            "notloggedin" => true,
        ));
    }

    public static function renderClientHome(){
        echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
            "bookdata" => \Model\User::get_allbooks(),
            "pendingrequests" =>  \Model\User::showpendingrequests(),
            "ownedbooks" =>  \Model\User::get_ownedbooks(),
            )); 
    }

    public static function renderHome(){
        echo \View\Loader::make()->render("templates/home.twig", array(
            "posts" => \Model\User::get_all()
        ));
    }

    public static function renderLogin(){
        echo \View\Loader::make()->render("templates/login.twig", array(
            "posts" => \Model\User::get_all(),
            "notloggedin" => true,
        ));
    }

}