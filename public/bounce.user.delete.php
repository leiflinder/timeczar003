<?php
session_start();
include ('../Config/class.conn.php');
include ('./classes/class.user.registration.php');
/*
print('<pre>');
print_r($_GET);
print('</pre>');
print('<hr/>');
print('<pre>');
print_r($_SESSION);
print('</pre>');
*/
$message="Registration deleted";
$delete = new user_registration;
$delete->delete_registration($_SESSION['userid']);
session_destroy();
header('Location: home.php?&message='.$message);
?>