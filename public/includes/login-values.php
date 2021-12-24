<?php
$checker = new user_checker();

    if(isset($_SESSION['logged_in'])){
        $logged_in = $_SESSION['logged_in'];
    }else{
        $logged_in = "VOID";
    }

   if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
  }else{
    $user_id = "VOID";
  }

  if(isset($_SESSION['access_level'])){
    $access_level = $_SESSION['access_level'];
   }else{
    $access_level = "VOID";
   }

   if(isset($_SESSION['firstname'])){
    $firstname = $_SESSION['firstname'];
   }else{
    $firstname = "VOID";
   }

   if(isset($_SESSION['lastname'])){
    $lastname = $_SESSION['lastname'];
   }else{
    $lastname = "VOID";
   }
   
?>