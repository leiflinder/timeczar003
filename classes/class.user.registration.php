<?php
class user_registration extends conn {
    var $userid ="userid";
    var $home_url ="";
    var $require_login = FALSE;
    var $page_title="page_title";
    var $firstname="firstname";
    var $lastname="lastname";
    var $email="email";
    var $password="password";
    var $user_ip="11111111111";
    var $country="country";
    var $status="0";
    var $created="";
    var $access_level = "Customer";
    var $access_code="";


    private function getIpAddress()
    {
        $ipAddress = '';
        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
            // to get shared ISP IP address
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check for IPs passing through proxy servers
            // check if multiple IP addresses are set and take the first one
            $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($ipAddressList as $ip) {
                if (! empty($ip)) {
                    // if you prefer, you can check for valid IP address here
                    $ipAddress = $ip;
                    break;
                }
            }
        } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (! empty($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } else if (! empty($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        $this->user_ip = $ipAddress;
    }



public function register_form2(){
    // create user IP property
    $this->getIpAddress();
    ?> 
    <style>
        
         input:invalid
         select:invalid,
         textarea:invalid {
         border-color: red;
         }

    </style>
</form>     
    <div class="register_form">
         <div class="container">
           <div id="showPasswordsInput">Show Passwords <input type="checkbox" id="showpassword" class="inlineFormElement" onclick="showPassword_psw1()"></div>
           <form action='bounce.register.php' method='post' id='register'>
            <input type="hidden" name="registration2" id="registration2" value="registration2"/>
            <input type="hidden" name="user_ip" value="<?php print($this->user_ip); ?>"/>
           <label for="firstname">First Name</label>
           <input type='text' name='firstname' id='firstname' required value=''/>
               <label for="email">Email</label>
               <input type="email" id="email" name="email" required> 

               <label for="psw1">Password</label>
               <!-- <input type="password" name="password" id="password2" onkeyup="checkPass();">-->
               <input type="password" id="psw1" name="psw1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required onkeyup="checkPass();">
               <div id="message">
                  <ul class="valpassUL">
                     <li id="letter" class="invalid">A lowercase letter</li>
                     <li id="capital" class="invalid">A capital (uppercase) letter</li>
                     <li id="number" class="invalid">A number</li>
                     <li id="length" class="invalid">Minimum 8 characters</li>
                  </ul>
               </div>
               <label for="confirm2">Confirm Password:</label>
               <input type="password" name="psw2" id="psw2" onkeyup="checkPass();">
               <span id="confirm-message2" class="confirm-message"></span>
               <div class="tutorial-wrapper">
                  <div class="field-wrapper">
                     <span id="validNumber" class="confirm-message"></span>
                  </div>
                  <div class="field-wrapper">
                     <span id="validNumber" class="confirm-message"></span>
                  </div>
               </div>
               <input type="submit" value="Submit">
            </form>
         </div>
      </div>
</div>
<script type="text/javascript" src="libs/js/email_validate.js"></script>
    <?PHP
}

        // create new user record
        function create($fname, $lname, $email,$password,$user_ip,$country){  
            $this->firstname = $fname;
            $this->lastname = $lname;
            $this->email = $email;
            $this->password = $password;
            $this->user_ip = $user_ip;
            $this->country = $country;
            // create access code with function
            // send upstairs to object properties
            $this->access_code = $this->getToken();

            // check if email already exists
            $stmt = $this->conn->prepare("SELECT `email` FROM `users` WHERE `email` = ?" );
            $stmt->bindValue( 1, $email );
            $stmt->execute();
            
            if($stmt->rowCount() > 0 ) { # If rows are found for query
                $message = "Email Exists Already";
                // by using return, function is ended.
                // so if email exists, end the function
                return $message;
            }

            // to get time stamp for 'created' field
            $this->created=date('Y-m-d H:i:s');  
            // insert query
 

            $query = "INSERT INTO `users` (
                `id`, 
                `firstname`, 
                `lastname`, 
                `email`, 
                `password`, 
                `user_ip`, 
                `country`, 
                `access_level`, 
                `access_code`, 
                `status`, 
                `created`, 
                `modified`) 
            VALUES (
                NULL, 
                :FIRSTNAME, 
                :LASTNAME, 
                :EMAIL, 
                :PASSWORD, 
                :USER_IP, 
                :COUNTRY, 
                :ACCESS_LEVEL, 
                :ACCESS_CODE, 
                :STATUS, 
                :CREATED, 
                current_timestamp())";

            // prepare the query
            $stmt = $this->conn->prepare($query);
        
            // sanitize
            $this->firstname=htmlspecialchars(strip_tags($this->firstname));
            $this->lastname=htmlspecialchars(strip_tags($this->lastname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->user_ip=htmlspecialchars(strip_tags($this->user_ip));
            $this->access_level=htmlspecialchars(strip_tags($this->access_level));
            $this->access_code=htmlspecialchars(strip_tags($this->access_code));
            $this->status=htmlspecialchars(strip_tags($this->status));
        
            // bind the values
            $stmt->bindParam(':FIRSTNAME', $this->firstname);
            $stmt->bindParam(':LASTNAME', $this->lastname);
            $stmt->bindParam(':EMAIL', $this->email);
            // hash the password before saving to database
            $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(':PASSWORD', $password_hash);
            $stmt->bindParam(':USER_IP', $this->user_ip);
            $stmt->bindParam(':COUNTRY', $this->country);
            $stmt->bindParam(':ACCESS_LEVEL', $this->access_level);
            $stmt->bindParam(':ACCESS_CODE', $this->access_code);
            $stmt->bindParam(':STATUS', $this->status);
            $stmt->bindParam(':CREATED', $this->created);
            $stmt->execute();

            
                    if ($stmt->rowCount() > 0){
                      $this->userid = $this->conn->lastInsertId();
                      $this->send_confirm_email();
                      $_SESSION['waiting_to_validate']=TRUE;                
                      $_SESSION['userid']=$this->conn->lastInsertId(); 
                        return TRUE;
                    }else{
                        $_SESSION['waiting_to_validate']=FALSE;
                        return FALSE;
                    }
    }

    

    function getToken($length=32){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    }
     
    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    public function waiting_to_validate(){
        if(isset($_SESSION['userid'])){
        $this->userid = $_SESSION['userid'];
        }
        if(isset($_SESSION['waiting_to_validate'])){
            if($_SESSION['waiting_to_validate']==TRUE){
              print('<div class="alert alert-success" role="alert">Check Your Email...&nbsp; Or, <a href="bounce.user.delete.php?userid='.$this->userid.'">delete</a> request</div>');
              return TRUE;
            }elseif($_SESSION['waiting_to_validate']==FALSE){
                return FALSE;
              }
            return FALSE;
        }
    }

    function send_confirm_email(){
        $userid = $this->userid;
        $code = $this->access_code;
        $send_to_email = $this->email;
        $userid = $this->userid;

        $body="<h3>TimeCzar</h3>
        <p>Click link to complete registration</p>
        <p><a href='http://localhost/TIMECZAR_2/public_html/home.php?page=emailconfirm&userid=".$userid."&code=".$code."'>http://localhost/TIMECZAR_2/public_html/home.php?page=emailconfirm&userid=".$userid."&code=".$code."</a></p>";
        $subject="Confirm Email: TimeCzar";
        $from_name="TimeCzar";
        $from_email="leif@leiflinder.com";
     
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: {$from_name} <{$from_email}> \n";
        mail($send_to_email, $subject, $body, $headers);
      
    }

    public function validate_email($userid,$access_code){
        $this->userid = htmlspecialchars(strip_tags($userid));
        $this->access_code=htmlspecialchars(strip_tags($access_code));
       // print('<p>ID: '.$this->userid.'</p>');
       // print('<p>CODE: '.$this->access_code.'</p>');
        if($this->accessCodeExists($this->access_code)==TRUE){
           // print('<p>accessCodeExists</p>');
            // if the code exists then set status to 1
            if($this->updateStatusByAccessCode()==TRUE){
                print('<div class="alert alert-success" role="alert">
                Email Confirmed. Please log in.
              </div>');
            }else{
                print('<div class="alert alert-warning" role="alert">
                Email was not confirmed.</div>');
            }
        }
    }

    private function accessCodeExists($access_code){
        $query = "SELECT id
                FROM users
                WHERE access_code = ?
                LIMIT 0,1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $access_code);
        $stmt->execute();
        $num = $stmt->rowCount();
        if($num>0){
            return "TRUE";
        }
        return "FALSE";
    }
    
    private function updateStatusByAccessCode(){
        $query = "UPDATE users
                SET status = 1
                WHERE access_code = :access_code";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':access_code', $this->access_code);
        $stmt->execute();
        if($stmt->rowCount()>0){
            return true;
        }
        return false;
    }

    public function delete_registration($userid){
        $query = "DELETE FROM users WHERE users.id = ?  LIMIT 1";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $userid);
        $stmt->execute();
    }

}
?>