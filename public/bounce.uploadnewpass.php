<?php
session_start();
include ("../Config/class.conn.php");
include ("./classes/class.user.utilities.php");
include ("./classes/class.user.registration.php");
include ("./classes/class.user.forgotpassword.php");
if($_POST){
  print('<pre>');
  print_r($_POST);
  print('</pre>');
  $psw1 = $_POST['psw1'];
  $psw2 = $_POST['psw2'];
  $id = $_POST['userid'];
  $code = $_POST['code'];
  
  $passwordupload = new user_forgotpassword;
    if($psw1==$psw2){
    // print('<p>Match</p>');
        if($passwordupload->upload_new_password($psw1, $id, $code)==TRUE){
          $message="Password changed";
          header('Location: home.php?message='.$message.'&alert=success');
        }else{
          $message="There was a problem";
          header('Location: home.php?message='.$message.'&alert=warning');
        }
    }else{
    // print('<p>No Match</p>');
    $message="Passwords do not match";
    header('Location: home.php?message='.$message.'&alert=warning');
    }
    
  }
?>