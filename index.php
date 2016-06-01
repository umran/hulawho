<?php
//initialize sweepdrive session
require("init.php");
?>

<!DOCTYPE html>
<html>
	<header>

		<title>HulaWho | Euro 2016</title>
          	
		<!-- Load Bootstrap 3 -->
		<link href="bootstrap_3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

		<!-- Set Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">

		<!-- Load nprogress -->
		<link href="nprogress/nprogress.css" rel="stylesheet">

		<!-- Load Font-Awesome -->
		<link href="font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet">
		
		<!-- Load Custom CSS -->
		<link rel="stylesheet" type="text/css" href="css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">

<?php

if (isset($_SESSION["loggedin"])) {
if ($_SESSION["loggedin"] == 1 and isset($_SESSION["username"])) {

echo '<META HTTP-EQUIV="Refresh" Content="0; URL=logged_in.php">';
exit;
}
}
elseif (isset($_POST["username"]) and isset($_POST["password"])) {

	$sanuser = mysqli_real_escape_string($con, $_POST["username"]);
	$sanpass = md5(mysqli_real_escape_string($con, $_POST["password"]));

	$origsql = "SELECT * FROM users WHERE username = 'user2' AND password = 'pass2'";

	$s1 = str_replace("user2", $sanuser, $origsql);
	$s2 = str_replace("pass2", $sanpass, $s1);

	$checkquery = mysqli_query($con, $s2);

	if (mysqli_num_rows($checkquery) == 1) {

		$row = mysqli_fetch_assoc($checkquery);
		$email = $row["email"];
		
		//Set SESSION VARIABLES
		
		$_SESSION["username"] = $sanuser;
		$_SESSION["email"] = $email;
		$_SESSION["loggedin"] = 1;

?>

	</header>
		<body>
			<div class="alert alert-success">
        		<strong><i class="fa fa-check-circle-o"></i> Login Successful!</strong> Please wait while we load your files
        	</div>
		</body>
	</html>
			<meta http-equiv="refresh" content="2;index.php" />

<?php

	}

	else {
		?>
		
	</header>
		<body>
			<div class="alert alert-danger">
              	<strong><i class="fa fa-exclamation-triangle"></i> Oh Snap!</strong> Your account could not be found! <a href="index.php">Login Again</a>
        	</div>
		</body>
	</html>
		<?php	
	}
}

else {

	$fb = new Facebook\Facebook([
	  'app_id' => $fb_app_id,
	  'app_secret' => $fb_app_secret,
	  'default_graph_version' => 'v2.2',
	  ]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl($fb_app_redirect_uri, $permissions);

?>
		<style type="text/css">
		</style>
	</header>
	
	<body>
		<div class="status" id="status">
		</div>
		<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-default" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top: -15px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="index.php">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <button id="btn-login" type="submit" class="btn btn-primary">Login</a>

                                    </div>
                                    
                                    <div class="col-sm-12 controls">
                                    	<center><h6>OR</h6></center>
                    				<a class="btn btn-lg btn-facebook btn-block" href="<?= $loginUrl ?>">Login via facebook</a>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account?
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-15px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Username</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="username" placeholder="Username">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
																<div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwordconf" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-3">
                                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> Sign Up</button>  
                                    </div>
                                </div>
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
    </div>

		<!-- Scripts -->
		<script src="bootstrap_3.1.1/js/jquery-1.11.0.min.js"></script>
		<script src="bootstrap_3.1.1/js/bootstrap.min.js"></script>
		<script src="nprogress/nprogress.js"></script>
		<script type="text/javascript">

			$('#register2').click(function(e) {
				e.preventDefault();
				$('#register2').blur();
				var text = document.getElementById('signup-form').innerHTML;
				$("#form-area").html(text);
				$('#username-signup').focus();
			});

			$('#sign-in').click(function(e) {
				e.preventDefault();
				$('#sign-in').blur();
				var text = document.getElementById('signin-form').innerHTML;
				$("#form-area").html(text);
				$('#username-signin').focus();
			});

			/*$('#send-form').click(function(e) {
				e.preventDefault();
				NProgress.start();
				var data = $('#signup-ajax').serialize();
				$.ajax({
					url: 'signup.php',
					type: 'POST',
					data: data,
					success: function (msg, textStatus, request) { 
						$('#form-area').html(msg);
					},
					complete: function() { 
						NProgress.done(); 
					}
				});
    			
			});*/

			$("#signupform").submit(function() {

					var url = "signup.php"; // the script where you handle the form input.

					$.ajax({
						     type: "POST",
						     url: url,
						     data: $("#signupform").serialize(), // serializes the form's elements.
						     success: function(data)
						     {
						         $('#status').html(data); // show response from the php script.
										 $('#status').show();
						     }
						   });

					return false; // avoid to execute the actual submit of the form.
			});
		</script>

	</body>
</html>

<?php

}

?>
