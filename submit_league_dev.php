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

$league_admin = $_SESSION["username"];
$league_name = mysqli_real_escape_string($con, $_POST["league_name"]);

for ($i = 0; $i < 4; $i++) {
    $bytes = openssl_random_pseudo_bytes($i, $cstrong);
    $hex = bin2hex($bytes);
}

$league_password = $hex;
$league_url_id = hash('sha256', $league_code);

//prepare to push record to database
$league_query = "INSERT INTO private_leagues (name, admin, password, url_id) VALUES ('".$league_name."', '".$league_admin."', '".$league_password."', '".$league_url_id."')";

$create_league = mysqli_query($con, $league_query);

if(!$create_league) {
	print "<div class='alert alert-danger'><strong><i class='fa fa-warning'></i> Oops! something went catastrophically wrong. Please let the webmaster know about this.</strong></div>";
}

?>