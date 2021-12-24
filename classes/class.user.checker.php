<?php
class user_checker extends conn {
    var $home_url ="";
    var $require_login = FALSE;
    var $page_title="";
/*
    function __construct($home_url,$require_login,$page_title){
        $this->home_url = $home_url;
        $this->require_login = $require_login;
        $this->page_title = $page_title;
    }
*/
    function checker(){
            $this->print_session();
            // login checker for 'customer' access level
            // if access level was not 'Admin', redirect him to login page
            if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Admin"){
               // header("Location: {$this->home_url}admin/index.php?action=logged_in_as_admin");
            }
            
            // if $require_login was set and value is 'true'
            else if(isset($this->require_login) && $this->require_login==true){
                // if user not yet logged in, redirect to login page
                if(!isset($_SESSION['access_level'])){
                   // header("Location: {$this->home_url}login.php?action=please_login");
                }
            }
            
            // if it was the 'login' or 'register' or 'sign up' page but the customer was already logged in
            else if(isset($page_title) && ($this->page_title=="Login" || $this->page_title=="Sign Up")){
                // if user not yet logged in, redirect to login page
                if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Customer"){
                   // header("Location: {$this->home_url}index.php?action=already_logged_in");
                   print('<p>Send to Already Logged In</p>');
                }
            }else{
                // no problem, stay on current page
            }
        }

        function print_session(){
            if(isset($_SESSION['logged_in'])){
            print('<pre>');
            //var_dump($_SESSION);
            print_r($_SESSION);
            print('</pre>');
            print('<p>'.$_SESSION['logged_in'].'</p>');
            }else{
            print('<p>$_SESSION[logged_in] not set</p>'); 
            }
        }

        function logged_in(){
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ==1){
                $logged = 1;
            }else{
                $logged = 0;
            }
            return $logged;
        }
}
?>