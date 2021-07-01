<?php

namespace Model;

class General {
    public static function create($name, $email, $password) {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("SELECT email FROM users WHERE email = ? ");
        $stmt2-> execute([$email]);
        $emailexist = $stmt2->fetch();
        // var_dump($emailexist);
        $stmt = $db->prepare("INSERT INTO users (name , email , password ) VALUES (? ,? , ?)");
        if( !empty($emailexist) ){
            
        }else{
            $stmt->execute([$name, $email, $password]);
        }

        
    }

    public static function checkemailexist($name, $email, $password) {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("SELECT email FROM users WHERE email = ? ");
        $stmt2-> execute([$email]);
        $emailexist = $stmt2->fetch();
        if(!empty($emailexist)){
            return true;
        }
        else{
            return false;
        }
        
    }

    public static function find($id) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row;
    }

    
  
 
    
}