<?PHP
class pagemaster extends user_checker
{
    function pagefinder($get_page)
    {
        switch ($get_page) {
            case "timer":
                print('<h1>Timer</h1>');
                    if(parent::logged_in()!==1){   
                        print('<p>Public Content</p>');  
                        }else{
                        print('<p>Logged In Content</p>');  
                    }
                break;
            case "keywords":
                print('<h1>Keywords</h1>');
                if(parent::logged_in()!==1){   
                    print('<p>Keywords Public Content</p>');  
                    }else{
                    print('<p>Keywords Logged In Content</p>');  
                }
                break;
            case "views":
                print('<h1>Views</h1>');
                if(parent::logged_in()!==1){   
                    print('<p>Views Public Content</p>');  
                    }else{
                    print('<p>Views Logged In Content</p>');  
                }
                break;
            case "home":
                print('<h1>TimeCzar</h1>');
                if(parent::logged_in()!==1){ 
                    print('<p>Home Public Content</p>');  
                    }else{
                    print('<p>Home Logged In Content</p>');  
                }
                break;
            case "categories":
                print('<h1>Categories</h1>');
                if(parent::logged_in()!==1){   
                    print('<p>Categories Public Content</p>');  
                    }else{
                    print('<p>Categories Logged In Content</p>');  
                }
                break;
            case "linkkeywords":
                print('<h1>Link Keywords</h1>');
                if(parent::logged_in()!==1){   
                    print('<p>Link Keyword Public Content</p>');  
                    }else{
                    print('<p>Link Keywords Logged In Content</p>');  
                }
                break;
            case "setup":
                print('<h1>Setup</h1>');
                if(parent::logged_in()!==1){   
                    print('<p>Setup Public Content</p>');  
                    }else{
                    print('<p>Setup Logged In Content</p>');  
                }
                break;
            case "login":
                print('<h1>Login</h1>');
                $login = new user_login;
                $login->loginform();
                break;
            case "register":
                print('<h1>Registration</h1>');
                $registraiton_form = new user_registration();
                // check if waiting to confirm email
                // crazy, this function not only returns
                //TRUE FALSE but also prints message
                if($registraiton_form->waiting_to_validate()==TRUE){
                }else{
                $registraiton_form->register_form();
                }
                break;
                case "register2":
                    print('<h1>Registration 2</h1>');
                    $registraiton_form = new user_registration();
                    $registraiton_form->register_form2();
                    break;
            case "emailconfirm":
               // print('<pre>');
              //  print_r($_GET);
               // print('</pre>');
                $confirm = new user_registration;
              //  $check_email = new user_utilities;
              //  if($check_email->email_exists_check($email))
                $confirm->validate_email($_GET['userid'],$_GET['code']);
                break;
            case "forgotpassword":
                print('<h1>Forgot password</h1>');
                $reset_password = new user_forgotpassword;
                $reset_password ->message_display();
                $reset_password->send_password_reset_form();
                break;
            case "resetpassword":
             if(isset($_GET['userid']) && isset($_GET['code'])){
                 // check if values exist in dbase
                 $check_if_exists = new user_forgotpassword;
                 if($check_if_exists->validate_code_and_userid_are_valid($_GET['userid'], $_GET['code'])==TRUE){
                    $form = new user_forgotpassword;
                     //$form->new_password_form();
                     $form->redo_password();
                 }else{
                     print('<div class="alert alert-warning" role="alert">ID or Code is wrong.</div>');
                 }
             }
            default:
               // do nothing interesting
        }
    }
    
}
?>