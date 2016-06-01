<?php
require('init.php');

if(!empty($_POST["username"]) && !empty($_SESSION["fb_access_token"]) && !empty($_SESSION["fb_id"])) {
  
  $sanuser = mysqli_real_escape_string($_POST["username"]);
  $sanfb_id = mysqli_real_escape_string($_SESSION["fb_id"]);

  $checkuserquery = "SELECT * FROM users WHERE username =".$sanuser;
  
  $existsQuery = "SELECT * FROM users WHERE fb_id =".$sanfb_id;
  
  $inputquery = "INSERT INTO users (username, fb_id) VALUES (".$sanuser.", ".$sanfb_id.")";
  $q = "INSERT INTO rankings (username, gd_total, total) VALUES (".$sanuser.", 0, 0)";

  $queryuser = mysqli_query($con, $checkuserquery);
  $execExistsQuery = mysqli_query($con, $existsQuery);

  $errors = array();    

  if (mysqli_num_rows($queryuser) == 1) {
    print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops! The username is not available as it has already been taken.</strong>";
    exit;
  } elseif (mysqli_num_rows($execExistsQuery) == 1) {
    print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops! This facebook account already has a username associated with it.</strong>";
    exit;
  }
		
  //create new entry for user in rankings table
  $inputexecute1 = mysqli_query($con, $q);		

  //create user
  $inputexecute2 = mysqli_query($con, $inputquery);		
  
  if(!$inputexecute1 || !$inputexecute2){
    echo "Oops! something went wrong ".mysqli_error();
  }
  else{
    $_SESSION["username"] = $sanuser;
    $_SESSION["loggedin"] = 1;
    echo "<div class='alert alert-success'><strong><i class='fa fa-check-circle-o'></i> Registration Successful</strong> You may now <a href='index.php'>Sign In</a> to your account.</div>";
    echo $sanuser;
    echo $sanfb_id;
  }
}

else {
	echo "no values entered";
}
?>
