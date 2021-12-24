<?php
class user_login extends conn {
    var $email="";
    var $id ="";
    var $firstname="";
    var $lastname="";
    var $access_level="";
    var $password="";
    var $status="";


    public function checkEmailPassword($email, $password){
        $this->email=$email;

        
        $email_exists = $this->emailExists();
       // print('<h2>Email Status: '.$email_exists.'</h2>');
        if ($email_exists && password_verify($password, $this->password) && $this->status==1){

            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $this->id;
            $_SESSION['access_level'] = $this->access_level;
            $_SESSION['firstname'] = htmlspecialchars($this->firstname, ENT_QUOTES, 'UTF-8') ;
            $_SESSION['lastname'] = $this->lastname;
        
                    // if access level is 'Admin', redirect to admin section
                    if($this->access_level=='Admin'){
                       // header("Location: ./home.php?action=login_success");
                       // print('<h4>Logged In Admin</h4>');
                       return('Admin');
                    }
                
                    // else, redirect only to 'Customer' section
                    else{
                       // header("Location: ./home.php?action=login_success");
                       // print('<h4>Logged In Customer</h4>');
                       return('Customer');
                    }
                }
        
        // if username does not exist or password is wrong
        else{
            $access_denied=true;
        }
        
    } 

// check if given email exist in the database
function emailExists(){
 
    // query to check if email exists
    $query = "SELECT id, firstname, lastname, access_level, password, status
            FROM users
            WHERE email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
// print('<h2>'.$this->email.'</h2>');
// print('<h2>'.$this->firstname.'</h2>');
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists, assign values to object properties for easy access and use for php sessions
    if($num>0){
 
        // get record details / values
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        // assign values to object properties
        $this->id = $row['id'];
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->access_level = $row['access_level'];
        $this->password = $row['password'];
        $this->status = $row['status'];
 
        // return true because email exists in the database
        return true;
    }
 
    // return false if email does not exist in the database
    return false;
}

public function loginform(){
    /*
    echo "<div class='account-wall'>";
        echo "<div id='my-tab-content' class='tab-content'>";
            echo "<div class='tab-pane active' id='login'>";
                echo "<img class='profile-img' src='images/login-icon.png'>";
                echo "<form class='form-signin' action='http://localhost/TIMECZAR_2/public_html/bounce.login.php' method='post'>";
                    echo "<input type='text' name='email' class='form-control' placeholder='Email' required autofocus />";
                    echo "<input type='password' name='password' class='form-control' placeholder='Password' required />";
                    echo "<input type='submit' class='btn btn-lg btn-primary btn-block' value='Log In' />";
                echo "</form>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
*/
print("<form action='bounce.login.php' method='post' id='login'>
<table class='table table-responsive'>
    <tr>
        <td class='width-30-percent'>Email</td>
        <td><input type='text' name='email' class='form-control' placeholder='Email' required autofocus /></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type='password' name='password' class='form-control' placeholder='Password' required /></td>
    </tr>

    <tr>
        <td></td>
        <td>
                    <button type='submit' class='btn btn-primary'>
                        Login
                    </button>
        </td>
    </tr>
<tr><td colspan='2'>
</form>
<div class='margin-1em-zero text-align-center'>
    <a href='home.php?page=forgotpassword&page_title=TimeCzar%20%Forgot%20%Passowrd'>Forgot password?</a>
</div>
</td></tr>
</table>");
}


}
?>