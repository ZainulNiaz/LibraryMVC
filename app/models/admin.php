<?php

namespace Model;

class Admin {
   
    public static function get_adminbooks(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt-> execute(["admin"]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function addbook( $title, $noofcopies) {
        $db = \DB::get_instance();
        $owner = 'admin';
        $stmt = $db->prepare("INSERT INTO books (title, owner) VALUES (?, ?) ");
        $stmt-> execute([$title,$owner]);
      
    }

    public static function showallrequests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests");
        $stmt-> execute();
        $row = $stmt->fetchAll();
        return $row;
       
    }

    public static function approvereq($requestid) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE requestid = ?");
        $stmt-> execute([$requestid]);
        $row = $stmt->fetch();

        $stmt = $db->prepare("UPDATE books SET owner =? WHERE bookid = ?");
        $stmt-> execute([$row["userid"], $row["bookid"] ]);
    

        $stmt5 = $db->prepare("DELETE FROM requests WHERE bookid = ?");
        $stmt5-> execute([$row["bookid"]]);

    }

    public static function denyreq($requestid) {
        $db = \DB::get_instance();
        $stmt5 = $db->prepare("DELETE FROM requests WHERE requestid = ?");
        $stmt5-> execute([$requestid]);
       
    }

    public static function adminlogin( $email, $password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->execute([$email]);
     
        $rows = $stmt->fetchAll();
     
        if(password_verify($password ,$rows[0]['password'])   ){
            if($email == 'admin@gmail.com'){
                session_start();
            $_SESSION['adminid'] = $rows[0]['id'];
            
            }
           
            
        }else{
           
        }
    }
    
}