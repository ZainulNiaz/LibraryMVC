<?php

require __DIR__."/../vendor/autoload.php";

// echo phpinfo();
Toro::serve(array(
    "/" => "\Controller\Home",
    "/post/:number" => "Controller\Post",
    "/login" => "Controller\Login",
    "/clienthome" => "Controller\Clienthome",
    "/adminlogin" => "Controller\Adminlogin" ,
    "/adminhome" => "Controller\Adminhome" ,
    "/approvereq" => "Controller\Approvereq" ,
    "/denyreq" => "Controller\Denyreq" ,
    "/returnbook" => "Controller\Returnbook" ,
    "/logout" => "Controller\Logout" ,
));

