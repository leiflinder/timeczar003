<?php
class user_forgotpassword extends conn {
    var $userid ="";
    var $email="";
    var $code="";

public function send_password_reset_form(){
        print("<form action='bounce.resetpassword.php' method='post' id='register'>
        <table class='table table-responsive'>
            <tr>
                <td>Email</td>
                <td><input type='email' name='email' class='form-control' required value=''/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type='submit' class='btn btn-primary'>
                        Send Password Reset
                    </button>
                </td>
            </tr>
        </table>
    </form>");
    }

 function message_display(){
    $message="";
    if(isset($_GET['message'])){
        $message = htmlspecialchars(strip_tags($_GET['message']));
    }
 if($message=='found'){
    print('<div class="alert alert-success" role="alert">Password reset link has been send to you email.</div>');
 }elseif($message=='notfound'){
    print('<div class="alert alert-danger" role="alert">Could not find email.</div>');
 }
}

// this is where the check_if_email_exists function was

public function send_email_password_reset(){
        include('../Config/core.php');
        $userid = $this->userid;
        $code = $this->code;
        $send_to_email = $this->email;

        $body="<h3>TimeCzar</h3>
        <p>Reset your password. CLick on link.</p>
        <p><a href='".$home_url."home.php?page=resetpassword&userid=".$userid."&code=".$code."'>".$home_url."home.php?page=passwordreset&userid=".$userid."&code=".$code."</a></p>";
        $subject="Reset Password: TimeCzar";
        $from_name="TimeCzar";
        $from_email="leif@leiflinder.com";
     
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: {$from_name} <{$from_email}> \n";
        mail($send_to_email, $subject, $body, $headers);
      
    }

    function update_user_token($email,$code){
        $stmt = $this->conn->prepare("UPDATE `users` SET `access_code` = :CODE WHERE `users`.`email` = :EMAIL;" );
        $stmt->bindValue( ':CODE', $code );
        $stmt->bindValue( ':EMAIL', $email );
        $stmt->execute();
        if($stmt->rowCount()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function update_code_and_send_email($email){
            $this->email = $email;
            $get_user_id = new user_utilities;
            $find_user_id = $get_user_id->find_user_id($this->email);
            $this->userid = $find_user_id;
            $newcode = new user_registration;
            $code = $newcode->getToken();
            $this->code = $code;
            $change_code = new user_utilities;
            $change_code->update_code($this->code, $this->email);
            // print('<p>user id: '.$this->userid.'</p>');
            $this->send_email_password_reset();         
    }


    public function printAll() {
        print('<pre>');
        var_dump(get_object_vars($this));
        print('</pre>');
    }

   public function new_password_form(){
        ?>
<!-- wee bit of javascript -->
        <script>
            var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'matching';
            } else {
                    document.getElementById('message').style.color = 'red';
                    document.getElementById('message').innerHTML = 'not matching';
                }
            }
        </script>

        <form action="bounce.uploadnewpass.php" method="post" id="uploadnewpass">
            <input type="hidden" name="new_password_set" id="new_password_set">
            <input type="hidden" name="code" value="<?php print($_GET['code']);?>">
            <input type="hidden" name="userid" value="<?php print($_GET['userid']);?>">
        <table class='table table-responsive'>
            <tr>
                <td class='width-30-percent'>New Password</td>
                <td><input name="password1" id="password1" type="password" class="form-control" onkeyup="check();" /></td>
            </tr>
            <tr>
                <td>Repeat Password</td>
                <td><input type="password" class="form-control" name="confirm_password2" id="confirm_password2" onkeyup='check();' /></td>
            </tr>
            <tr><td colspan="2"><p><span id='message'></span></p></td></tr>
            <tr>
                <td></td>
                <td>
                    <button type='submit' class='btn btn-primary'>
                        Send Password Reset
                    </button>
                </td>
            </tr>
            </form></table>
            <?PHP
    }


    public function redo_password(){
        ?> 
        <link rel="stylesheet" type="text/css" href="libs/css/validate_email.css">
        <div class="register_form">
             <div class="container">
               <div id="showPasswordsInput">Show Passwords <input type="checkbox" id="showpassword" class="inlineFormElement" onclick="showPassword_psw1()"></div>
               <form action="bounce.uploadnewpass.php" method="post" id="uploadnewpass">
            <input type="hidden" name="new_password_set" id="new_password_set">
            <input type="hidden" name="code" value="<?php print($_GET['code']);?>">
            <input type="hidden" name="userid" value="<?php print($_GET['userid']);?>">
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
    




    function check_dbase_for_userid($userid){
        $stmt = $this->conn->prepare("SELECT * WHERE `users`.`email` = :EMAIL;" );
        $stmt->bindValue( ':EMAIL', $email );
        $stmt->execute();
        if($stmt->rowCount()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    
     function validate_code_and_userid_are_valid($userid, $code){
            $this->userid=htmlspecialchars(strip_tags($userid));
            $this->code=htmlspecialchars(strip_tags($code));
            $validate = new user_utilities;
            if($validate->check_dbase_for_code($this->code)==TRUE && $validate->check_dbase_for_userid($this->userid)==TRUE){
               return TRUE;
            }else{
                return FALSE;
            }
        }


        function upload_new_password($password, $id, $code){
          //  $stmt = $this->conn->prepare("UPDATE users SET password = :PASSWD WHERE users.id like :ID");
          //  $stmt = $this->conn->prepare("UPDATE `users` SET `password` = :PASSWD WHERE `users`.`id` = :ID AND `users`.`code` LIKE :CODE");
          $stmt = $this->conn->prepare("UPDATE `users` 
          SET `password` =  :PASSWD WHERE `users`.`id` = :ID 
          AND `users`.`access_code` LIKE :CODE");
            $stmt->bindValue( ':ID', $id );
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt->bindValue( ':PASSWD', $password_hash );
            $stmt->bindValue( ':CODE', $code );
            $stmt->execute();
            if($stmt->rowCount()>0){
                return TRUE;
            }else{
                return FALSE;
            }
        }
}
?>