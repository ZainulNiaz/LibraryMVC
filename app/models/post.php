<?php

namespace Model;

class Post {
    public static function create($name, $email, $password) {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("SELECT email FROM users WHERE email = ? ");
        $stmt2-> execute([$email]);
        $emailexist = $stmt2->fetchAll();
        var_dump($emailexist);
        $stmt = $db->prepare("INSERT INTO users (name , email , password ) VALUES (? ,? , ?)");
        if($emailexist != NULL ){
            
        }else{
            $stmt->execute([$name, $email, $password]);
            $stmt3 = $db->prepare("CREATE TABLE $email (bookid int, title  varchar(255))");
            $stmt3->execute();
        }

        
    }

    public static function checkemailexist($name, $email, $password) {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("SELECT email FROM users WHERE email = ? ");
        $stmt2-> execute([$email]);
        $emailexist = $stmt2->fetchAll();
        if($emailexist!= NULL){
            return true;
        }
        else{
            return false;
        }
        
    }


    public static function get_all(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt-> execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function get_allbooks(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt-> execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function get_ownedbooks(){
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt2-> execute([$_SESSION['userid']]);
        $rows = $stmt2->fetch();
        $email = $rows["email"];

        $stmt = $db->prepare("SELECT * FROM ? ");
        $stmt-> execute([$email]);

        $rows = $stmt->fetchAll();
        return $rows;
    }



    public static function get_all_userdata(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt-> execute([$_SESSION['userid']]);
         
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function addbook( $title, $noofcopies) {
        $db = \DB::get_instance();
        $owner = 'admin';
        $stmt = $db->prepare("INSERT INTO books (title, noofcopies, owner) VALUES (?, ? , ?) ");
        $stmt-> execute([$title,$noofcopies,$owner]);
        var_dump($title);
       
    }

    public static function showpendingrequests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM requests WHERE userid = ? ");
        $stmt-> execute([$_SESSION["userid"]]);
        $row = $stmt->fetchAll();
        return $row;
       
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
        $stmt2 = $db->prepare("SELECT * FROM books WHERE bookid = ?");
        $stmt2-> execute([$row["bookid"]]);
        $row2 = $stmt2->fetch();
        $stmt3 = $db->prepare("UPDATE books SET noofcopies = ? WHERE bookid = ?");
        $stmt3->execute([  $row2["noofcopies"]-1 ,$row["bookid"]]);
        $email = $row["email"];
        var_dump($email);
        $stmt4 = $db->prepare("INSERT INTO ? (bookid, title) VALUES( ? , ? )");
        $stmt4-> execute([  $email ,$row["bookid"], $row2["title"] ]);
        
        $stmt5 = $db->prepare("DELETE FROM requests WHERE requestid = ?");
        $stmt5-> execute([$requestid]);

    }

    public static function denyreq($requestid) {
        $db = \DB::get_instance();
        $stmt5 = $db->prepare("DELETE FROM requests WHERE requestid = ?");
        $stmt5-> execute([$requestid]);

    }
    
    public static function returnbook($bookid) {
        $db = \DB::get_instance();
        
        $stmt = $db->prepare("SELCT * FROM users WHERE id = ?");
        $stmt-> execute([$_SESSION["userid"]]);
        $row = $stmt->fetch();
        $email = $row["email"];
        $stmt5 = $db->prepare("DELETE FROM ? WHERE bookid = ?");
        $stmt5-> execute( $email ,[$bookid]);

        $stmt2 = $db->prepare("SELCT * FROM books WHERE bookid = ?");
        $stmt2-> execute([$bookid]);
        $row2 = $stmt2->fetch();

        $stmt3 = $db->prepare("UPDATE books SET noofcopies = ? WHERE bookid = ?");
        $stmt3->execute([ $row2["noofcopies"]+1 ,$bookid]);

    }

    public static function requestbook($bookid) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE bookid = ?");
        $stmt->execute([$bookid]);
        $row = $stmt->fetch();
        $stmt4 = $db->prepare("SELECT email FROM users WHERE id = ?");
        $stmt4->execute([$_SESSION["userid"]]);
        $row2 = $stmt4->fetch();

        var_dump($row2["email"]);
        if($row["noofcopies"]>0){
            $stmt2 = $db->prepare("UPDATE books SET noofcopies = ? WHERE bookid = ?");
            $stmt2->execute([  $row["noofcopies"]-1 , $bookid]);
            $stmt3 = $db->prepare("INSERT INTO requests(bookid, userid, email) VALUES ( ?, ?, ?) ");
            $stmt3->execute([$bookid, $_SESSION["userid"], $row2["email"] ]);

        }
        return $row;
    }

    public static function find($id) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row;
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