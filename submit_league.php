<?php
require("init.php");

if(!isset($_SESSION['username'])){
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you're not logged in.</strong> <a href='index.php'>Login</a> to your account.</div>";
	exit;
}

if(empty($_POST["league_name"])) {
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you didn't submit a league name.</strong></div>";
	exit;
}

$league_admin = $_SESSION["username"];
$league_name = mysqli_real_escape_string($con, $_POST["league_name"]);

for ($i = 0; $i < 4; $i++) {
    $bytes = openssl_random_pseudo_bytes($i, $cstrong);
    $hex = bin2hex($bytes);
}

$league_password = $hex;
$intermediate = $hex.time();
$league_url_id = hash('sha256', $intermediate);

//prepare to push records to database
$league_query = "INSERT INTO private_leagues (name, admin, password, url_id) VALUES ('".$league_name."', '".$league_admin."', '".$league_password."', '".$league_url_id."')";
$member_query = "INSERT INTO league_members (username, league_url_id) VALUES ('".$league_admin."','".$league_url_id."')";

$create_league = mysqli_query($con, $league_query);
$add_member = mysqli_query($con, $member_query);

if(!$create_league || !$add_member) {
	print "<div class='alert alert-danger'><strong><i class='fa fa-warning'></i> Oops! something went catastrophically wrong. Please let the webmaster know about this.</strong></div>";
	exit;
}

print "<div class='alert alert-success'><h5>A new league called <strong>".$league_name."</strong> has been created. Now pass around the league url and password so others can join your league!</h5>
	<div class='league-link'><p><strong>league url</strong></p><p><h4><span class=\"label label-success\">https://hulawho.mv/join_league.php?url_id=".$league_url_id."</span></h4></p></div>
	<div class='league-password'><p><strong>league password</strong><p><h4><span class=\"label label-success\">".$league_password."</span></h4></p></div>
	</div>";

?>