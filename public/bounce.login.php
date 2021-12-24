<?php
session_start();
include ("../Config/class.conn.php");
//include ("./classes/user.php");
include ("../classes/class.user.login.php");

if($_POST){
    // $user = new User($db);
    /*
    $database = new conn();
    $db = $database->getConnection();
    $user = new User($db);
    $mesage = $user->checkEmailPassword($_POST['email'], $_POST['password']);
    */
    $login = new user_login;
    if($login->checkEmailPassword($_POST['email'], $_POST['password'])){
        //print('<p>logged in</p>');
        $message='You Are Logged In';
        header('Location: home.php?page=home&message='.$message);
    }else{
        $message='Wrong Password or Email';
        header('Location: home.php?page=home&message='.$message.'&alert=warning');
    }
    /*
    print('<h3>'.$mesage.'</h3>');
    print('<p>'.$_SESSION['logged_in'].'</p>');
    print('<p>'.$_SESSION['user_id'].'</p>');
    print('<p>'.$_SESSION['access_level'].'</p>');
    print('<p>'.$_SESSION['firstname'].'</p>');
    print('<p>'.$_SESSION['lastname'].'</p>');
    */
}

/*
 header("Location: http://localhost/TIMECZAR_2/public_html//home.php?page=home&page_title=Homepage&message=Logged%20In%20".$mesage);
 */
?>