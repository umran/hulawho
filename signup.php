<?php
require('init.php');

if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["passwordconf"]) && !empty($_POST["email"])) {
	$newuser = $_POST["username"];
	$newpass = $_POST["password"];
  $newpassconf = $_POST["passwordconf"];
  $newemail = $_POST["email"];

  $sanuser = mysqli_real_escape_string($con, $newuser);
  $sanpass = md5(mysqli_real_escape_string($con, $newpass));
  $sanpassconf = md5(mysqli_real_escape_string($con, $newpassconf));
  $sanemail = mysqli_real_escape_string($con, $newemail);
  $cmp = strcmp($sanpass, $sanpassconf);

  $checkuserquery = "SELECT * FROM users WHERE username = 'userinp'";
  $checkemailquery = "SELECT * FROM users WHERE email = 'emailinp'";
  $checkemail = str_replace("emailinp", $sanemail, $checkemailquery);
  $checkuser = str_replace("userinp", $sanuser, $checkuserquery);
  $inputquery = "INSERT INTO users (username, password, email) VALUES ('".$sanuser."', '".$sanpass."', '".$sanemail."')";

  $queryuser = mysqli_query($con, $checkuser);
  $queryemail = mysqli_query($con, $checkemail);

	$errors = array();    

  if (mysqli_num_rows($queryuser) == 1) {
		array_push($errors, "The username is not available as it has already been taken.");
  }

  if (mysqli_num_rows($queryemail) == 1) {
  	array_push($errors, "The email address you provided is already in use! Is it possible that you have signed up with us in the past?");  
  }

  if ($cmp != 0) {
		array_push($errors, "The password combinations did not match. Please ensure that you typed the same value in the 'Password' and 'Confirm Password' fields."); 
  }

  if (count($errors)==0) {
		
		//create new entry for user in rankings table
		$q = "INSERT INTO rankings (username, gd_total, total) VALUES ('".$sanuser."', 0, 0)";
		mysqli_query($con, $q);		

		//create user
		$inputexecute = mysqli_query($con, $inputquery);		
		if(!$inputexecute){
			echo "Oops! something went wrong ".mysqli_error();
		}
		else{
			echo "<div class='alert alert-success'><strong><i class='fa fa-check-circle-o'></i> Registration Successful</strong> You may now <a href='index.php'>Sign In</a> to your account.</div>";
			$_SESSION["username"] = $sanuser;
			$_SESSION["email"] = $sanemail;
			$_SESSION["loggedin"] = 1;
		}
	}
	else {
		print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops! We encountered a few errors.</strong>";
		foreach($errors as $error){
			echo "<h6>".$error."</h6>";
		}
		print "</div>";
	}
}

else {
	echo "no values entered";
}
?>
