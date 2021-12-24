<?php 
  session_start();
?>
<?php
  include ("../Config/core.php");
  include ("../Config/class.conn.php");
  include ('../classes/class.user.checker.php');
  include ('../classes/class.pagemaster.php');
  include ('../classes/class.user.registration.php');
  include ('../classes/class.user.utilities.php');
  include ('../classes/class.user.forgotpassword.php');
  include ('../classes/class.user.login.php');
  include ('../classes/class.security.geo_ip.php');
?>
<?php
  $page_title="Time Czar"
?>
<?php include('includes/header.php');?>
<header>
  <?php include('includes/nav.php');?>
  <?php include('includes/login-values.php');?>
  <?php include('includes/print-errors.php');?>
</header>
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
	<?php
		$zombie = new pagemaster;
		/* shorthand if isset else index */
		$_GET['page'] = isset($_GET['page']) ? $_GET['page'] : 'index';
		$zombie->pagefinder($_GET['page']);
	?>
	<?php 
		print('<p>'.$logged_in.'</p>');
		print('<p>'.$user_id.'</p>');
		print('<p>'.$access_level.'</p>');
		print('<p>'.$firstname.'</p>');
		print('<p>'.$lastname.'</p>');
	?>

  <script>
    $.get("http://ipinfo.io", function(response) {
  $("#ip").html("IP: " + response.ip);
  $("#address").html("Location: " + response.city + ", " + response.region);
  $("#details").html(JSON.stringify(response, null, 4));
}, "jsonp");
</script>
<h3>Client side IP geolocation using <a href="http://ipinfo.io">ipinfo.io</a></h3>

<hr/>
<div id="ip"></div>
<div id="address"></div>
<hr/>Full response: <pre id="details"></pre>

  </div>
</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<?php include('includes/footer.php');?>