<?php
//initialize sweepdrive session
require("init.php");

if(!isset($_SESSION['username'])){
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you're not logged in.</strong> <a href='index.php'>Login</a> to your account.</div>";
	exit;
}

if(empty($_POST["league_name"])) {
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you didn't submit a league name.</strong></div>";
	exit;
}

print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Private League functionality is still under development. Cheers!</strong></div>";

?>