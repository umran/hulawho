<?php

require("init.php");

if(!isset($_SESSION['username'])){
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you're not logged in.</strong> <a href='index.php'>Login</a> to your account.</div>";
	exit;
}

// fetch all leagues managed by user

$league_query = "SELECT * FROM private_leagues WHERE admin = '".$_SESSION['username']."'";

$fetchleagues = mysqli_query($con, $league_query);

if (mysqli_num_rows($fetchleagues) < 1) {
	exit;
}

while($row = mysqli_fetch_assoc($fetchleagues)) {
	$league_name = $row['name'];
	$league_url_id = $row['url_id'];
	$league_password = $row['password'];
	
	print "<div class='list-group-item'>";
	print "<h4 class='list-group-item-heading'>".$league_name."</h4>";
	print "<div class='league-link'><p>league url</p><p><h4><span class=\"label label-danger\">https://hulawho.mv/join_league.php?url_id=".$league_url_id."</span></h4></p></div>";
	print "<div class='league-password'><p>league password<p><h4><span class=\"label label-danger\">".$league_password."</span></h4></p></div>";
	print "</div>";
}

?>