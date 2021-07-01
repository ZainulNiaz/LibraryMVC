<?php

namespace Model;

class User {
    public static function get_all(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt-> execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function get_allbooks(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books where owner = ?");
        $stmt-> execute(["admin"]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function get_ownedbooks(){
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("SELECT * FROM books WHERE owner = ?");
        $stmt2-> execute([$_SESSION['userid']]);
        $rows = $stmt2->fetchAll();

       
        return $rows;
    }

    public static function get_all_userdata(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt-> execute([$_SESSION['userid']]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function showpendingrequests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE userid = ? ");
        $stmt-> execute([$_SESSION["userid"]]);
        $row = $stmt->fetchAll();
        return $row;
       
    }

    public static function returnbook($bookid) {
        $db = \DB::get_instance();
        
        $stmt = $db->prepare("UPDATE books SET owner = ? WHERE bookid = ?");
        $stmt-> execute(['admin', $bookid]);
        
       

    }

    public static function requestbook($bookid) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE bookid = ?");
        $stmt->execute([$bookid]);
        $row = $stmt->fetch();
        $stmt4 = $db->prepare("SELECT email FROM users WHERE id = ?");
        $stmt4->execute([$_SESSION["userid"]]);
        $row2 = $stmt4->fetch();

        var_dump($row["owner"]);
        if($row["owner"]=='admin'){
            $stmt3 = $db->prepare("INSERT INTO requests(bookid, userid, email, title) VALUES ( ?, ?, ?, ?) ");
            $stmt3->execute([$bookid, $_SESSION["userid"], $row2["email"], $row["title"] ]);

        }
        
    }

    public static function login( $email, $password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
       
        if(password_verify($password ,$rows[0]['password'])){
            session_start();
            $_SESSION['userid'] = $rows[0]['id'];
             var_dump($_SESSION['userid']);
        }else{
            
        }
    }

 
    
}