<?php

require("init.php");

if(!isset($_SESSION['username'])){
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you're not logged in.</strong> <a href='index.php'>Login</a> to your account.</div>";
	exit;
}

if(empty($_POST["league_password"])) {
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you didn't submit the league password.</strong></div>";
	exit;
}

if(empty($_POST["league_url_id"])) {
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. We didn't receive the league ID parameter.</strong></div>";
	exit;
}

// check membership

$username = $_SESSION['username'];
$league_url_id = mysqli_real_escape_string($con, $_POST['league_url_id']);
$league_password = mysqli_real_escape_string($con, $_POST['league_password']);

$userexists = "SELECT * FROM league_members WHERE username = '".$username."' AND league_url_id='".$league_url_id."'";

$checkuser = mysqli_query($con, $userexists);

if (mysqli_num_rows($checkuser) == 1) {
	print "<div class='alert alert-warning'><strong><i class='fa fa-info-circle'></i> Looks like you are already a member of the league. Nothing more to do here.</strong></div>";
	exit;
}

// check password

$passwordmatches = "SELECT * FROM private_leagues WHERE url_id = '".$league_url_id."' AND password = '".$league_password."'";
$checkpassword = mysqli_query($con, $passwordmatches);

if (mysqli_num_rows($checkpassword) < 1) {
	print "<div class='alert alert-warning'><strong><i class='fa fa-info-circle'></i> The password you entered was incorrect. Please try again.</strong></div>";
	exit;
}

// do join

$member_query = "INSERT INTO league_members (username, league_url_id) VALUES ('".$username."','".$league_url_id."')";
$add_member = mysqli_query($con, $member_query);

if(!$add_member) {
	print "<div class='alert alert-danger'><strong><i class='fa fa-warning'></i> Oops! something went catastrophically wrong. Please let the webmaster know about this.</strong></div>";
	exit;
}

print "<div class='alert alert-success'>You have successfully joined the league!</div>";

?>