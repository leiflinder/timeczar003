<?php
session_start();
include ("../Config/class.conn.php");
include ("./classes/class.user.utilities.php");
include ("./classes/class.user.registration.php");
include ("./classes/class.user.forgotpassword.php");
if($_POST){
   // $mesage="found";
    $email = htmlspecialchars(strip_tags($_POST['email']));
    // if email exist send code
    $check_email_exists = new user_utilities;
    if($check_email_exists->email_exists_check($email)==TRUE){
      $reset = new user_forgotpassword;
      $reset->update_code_and_send_email($email);
      $message='Check Your Email. Reset Link Sent.';
      header('Location: home.php?page=home&message='.$message.'&alert=success');
    }else{
      $message='Email Not Found.';
      header('Location: home.php?page=forgotpassword&message='.$message.'&alert=warning');
    }

  //  $reset = new user_forgotpassword;
  //  $reset->update_code_and_send_email($email);
 //   $message = "Check Your Email. Reset Link Sent.";
   // $reset->printAll();
    // $newcode = new user_registration;
    // $code = $newcode->getToken();
    // print('<p>'.$code.'</p>');
    // send
    //  header('Location: home.php?message='.$message);
    //  $dataset
}
?>