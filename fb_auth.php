<?php
	$existsQuery = "SELECT * FROM users WHERE fb_id =".$userId;
	$execExistsQuery = mysqli_query($con, $existsQuery);
	
	var $row = mysqli_fetch_assoc($execExistsQuery);
	
	if($row){
		$username = $row['username'];
		
		//set session
		echo "<div class='alert alert-success'><strong><i class='fa fa-check-circle-o'></i> Registration Successful</strong> You will now be redirected to your account.</div>";
		$_SESSION["username"] = $username;
		$_SESSION["loggedin"] = 1;
		
		echo "<META HTTP-EQUIV='Refresh' Content='0; URL=logged_in.php'>";
		exit;
		
	}
?>