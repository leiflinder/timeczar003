<?php
include('../Config/core.php');
session_start();
session_destroy();
header("Location: ".$home_url."home.php?page=home&page_title=Homepage&message=Logged%20Out");
?>