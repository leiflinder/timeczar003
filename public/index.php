<?php 
session_start();
?>
<?php
include ('../Config/core.php');
include ('../Config/class.conn.php');
include ('../classes/class.user.checker.php');
include ('../classes/class.pagemaster.php');
include ('../classes/class.user.registration.php');
include ('../classes/class.user.utilities.php');
include ('../classes/class.user.forgotpassword.php');
include ('../classes/class.user.login.php');
include ('../classes/class.security.geo_ip.php');
	// require_once("./includes/session.php");
	// include ("./Objects/user.php");
	// include ("./classes/user.php");
	/*
	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$_SESSION['userid']=1001; // change this for each user
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
*/
?>
<?php
    $page_title="TimeCzar Time Managment"
?>

<?php include('includes/header.php');?>
<header>
<?php include('includes/nav.php');?>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">

  </div>
</main>

<?php include('includes/footer.php');?>
