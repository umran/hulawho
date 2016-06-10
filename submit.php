<?php

require('init.php');

if(!isset($_SESSION['username'])){
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you're not logged in.</strong> <a href='index.php'>Login</a> to your account.</div>";
	exit;
}

if(is_numeric($_POST['match_id']) && is_numeric($_POST['quant1']) && is_numeric($_POST['quant2']) ){

	$score_a = $_POST['quant1'];
	$score_b = $_POST['quant2'];
	$match_id = $_POST['match_id'];

	$score_a = mysqli_real_escape_string($con, $score_a);	
	$score_b = mysqli_real_escape_string($con, $score_b);
	$match_id = mysqli_real_escape_string($con, $match_id);

	//get current time
	$current_time = time();

	//set username
	$username = $_SESSION['username'];

	//get match time and compare with current time
	$q = "SELECT * FROM matches where match_id=".$match_id;
	$q_exec = mysqli_query($con, $q);
	$row = mysqli_fetch_assoc($q_exec);
	$match_time = $row["unix_time"] - 18000;
	
	if($current_time>$match_time){
		print "<div class='alert alert-warning'><strong><i class='fa fa-frown-o'></i> Oops. You were too late.</strong> Either the match has already begun or it's over.</div>";
		exit;
	}
	
	//check if user has already predicted this game
	$q = "SELECT * FROM predictions WHERE username='".$username."'";
	$q_exec = mysqli_query($con, $q);
	
	$match_id_exists = false;
	while($row = mysqli_fetch_assoc($q_exec)){
		if ($row['match_id'] == $match_id){
			$match_id_exists = true;
		}
	}
	if ($match_id_exists == true){
		//update the existing record
		$q = "UPDATE predictions SET team_a=".$score_a.", team_b=".$score_b.", time=".$current_time." WHERE match_id=".$match_id." AND username='".$username."'";
		$msg = "<div class='alert alert-success'><strong><i class='fa fa-check-circle-o'></i> Success!</strong> We noticed you made a prediction for this game earlier and promptly updated your prediction. Cheers!</div>";
	}	
	else{
		//create new entry
		$q = "INSERT INTO predictions (match_id, team_a, team_b, username, time) VALUES (".$match_id.",".$score_a.",".$score_b.",'".$username."',".$current_time.")";
		$msg = "<div class='alert alert-success'><strong><i class='fa fa-check-circle-o'></i> Success!</strong> Your prediction for this game has been saved.</div>";
	}
	$q_exec = mysqli_query($con, $q);
	if(!$q_exec){
		print "<div class='alert alert-danger'><strong><i class='fa fa-exclamation-triangle'></i> Oops. Something Went Wrong</strong></div>";
	}
	else{
		print $msg;
	}
}
else{
	print "<div class='alert alert-danger'><strong><i class='fa fa-exclamation-triangle'></i> Please make sure you've entered integers as scores.</strong></div>";
}

?>
