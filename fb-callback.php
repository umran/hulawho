<?php
require("init.php");

$fb = new Facebook\Facebook([
  'app_id' => $fb_app_id,
  'app_secret' => $fb_app_secret,
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($fb_app_id); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }
}

$userId = $tokenMetadata->getField('user_id');

//check if user already exists in database
$existsQuery = "SELECT * FROM users WHERE fb_id ='".$userId."'";
$execExistsQuery = mysqli_query($con, $existsQuery);

$row = mysqli_fetch_assoc($execExistsQuery);

if($row){
	$username = $row['username'];
	
	//set session
	$_SESSION["username"] = $username;
	$_SESSION["loggedin"] = 1;
	
	header('Location: http://hulawho.mv/logged_in.php');
	exit;
	
}

//if user does not exist, create new user

$_SESSION['fb_access_token'] = (string) $accessToken;
$_SESSION['fb_id'] = $userId;

require("header.php");

?>
<body>
	<div class='container'>
		<div style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		  <div class="panel panel-default">
			<div class="panel-heading">
			    <div class="panel-title">Please enter a username</div>
			</div>  
			<div class="panel-body" >
			    <form id="createuserform" class="form-horizontal" role="form">
				  <div id="fbsignupstatus">
				  </div>
				  <div class="form-group">
					<label for="email" class="col-md-3 control-label">Username</label>
					<div class="col-md-9">
					    <input type="text" class="form-control" name="username" placeholder="Username">
					</div>
				  </div>

				  <div class="form-group">
					<!-- Button -->                                        
					<div class="col-md-offset-3 col-md-3">
					    <button id="btn-createuser" type="submit" class="btn btn-info">Continue</button>  
					</div>
				  </div>
			    </form>
			 </div>
		   </div>        
		</div>
	</div>

	<!-- Scripts -->
	<script src="bootstrap_3.1.1/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript">
		$("#createuserform").submit(function() {

				var url = "fb_signup.php"; // the script where you handle the form input.

				$.ajax({
					     type: "POST",
					     url: url,
					     data: $("#createuserform").serialize(), // serializes the form's elements.
					     success: function(data)
					     {
						   $('#fbsignupstatus').html(data); // show response from the php script.
						   $('#fbsignupstatus').show();
					     }
					   });

				return false; // avoid to execute the actual submit of the form.
		});
	</script>
</body>