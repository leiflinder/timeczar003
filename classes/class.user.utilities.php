<?php

class user_utilities extends conn {

    var $userid = "";
    var $firstname = "";
    var $lastname = "";
    var $email = "";
    
    public function email_exists_check($email){
        // check if email already exists
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `email` = ?" );
        $stmt->bindValue( 1, $email );
        $stmt->execute();
       $dataset = $stmt->fetchALL(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0 ) {  
            $this->userid = $dataset[0]['id'];
            $this->firstname = $dataset[0]['firstname'];
            $this->lastname = $dataset[0]['lastname'];
            $this->email = $dataset[0]['email'];
            return TRUE;
        }else{
            return FALSE;                
        }
    }

    public function update_code($code, $email){
        // update code where email is
        $stmt = $this->conn->prepare("UPDATE `users` SET `access_code` = ? WHERE `users`.`email` = ?" );
        $stmt->bindValue( 1, $code );
        $stmt->bindValue( 2, $email );
        $stmt->execute();
        if($stmt->rowCount() > 0 ) {  
            return TRUE;
        }else{
            return FALSE;                
        }
    }

    public function find_user_id($email){
                // update code where email is
                $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `email` LIKE :EMAIL");
                $stmt->bindValue( ':EMAIL', $email );
                $stmt->execute();
                $dataset = $stmt->fetchALL(PDO::FETCH_ASSOC);
                if($stmt->rowCount() > 0 ) {  
                    return $this->userid = $dataset[0]['id'];
                }else{
                    return FALSE;                
            }
        }

        function check_dbase_for_code($code){
            $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `access_code` LIKE :CODE" );
            $stmt->bindValue( ':CODE', $code );
            $stmt->execute();
            if($stmt->rowCount()>0){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    
        function check_dbase_for_userid($id){
            $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `id` LIKE :ID" );
            $stmt->bindValue( ':ID', $id );
            $stmt->execute();
            if($stmt->rowCount()>0){
                return TRUE;
            }else{
                return FALSE;
            }
        }

}
?>