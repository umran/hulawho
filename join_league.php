<?php

require("init.php");

if(!isset($_GET['url_id'])) {

	echo "<html>";
	require('header.php');
	echo "<body>";
	require('navbar.php');

?>
	<div class="alert alert-danger">
        <strong><i class="fa fa-exclamation-triangle"></i> Missing Parameter!</strong> A league ID was not provided.</a>
    </div></body></html>
<?php
	exit;
}

if(!isset($_SESSION['username'])){
	$_SESSION['redirect'] = 'join_league.php?url_id='.$_GET['url_id'];
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	exit;
}

if(isset($_SESSION['redirect'])) {
	unset($_SESSION['redirect']);
}

echo "<html>";
require('header.php');
echo "<body>";
require('navbar.php');

$league_url_id = mysqli_real_escape_string($con, $_GET['url_id']);

$name_query = "SELECT * FROM private_leagues WHERE url_id = '".$league_url_id."'";
$getname = mysqli_query($con, $name_query);

if (mysqli_num_rows($getname) == 1) {
	$row = mysqli_fetch_assoc($getname);
	$league_name = $row['name'];
} else {
?>
	<div class="alert alert-danger">
        <strong><i class="fa fa-exclamation-triangle"></i> Oh Snap!</strong> Either the league doesn't exist anymore or you've potentially found a sha256 hash collision!</a>
    </div></body></html>
<?php
	exit;
}

?>

<div class='container'>
	<div style="margin-top:20px;" id="leaguejoinstatus">
	</div>
	<div class="mainbox col-md-offset-3 col-md-6 col-xs-offset-2 col-xs-8 no-padding">
		<h4>Join <?=$league_name?></h4>
		<div class="panel panel-default">
			<div class="panel-body">
				<form id="joinleagueform" role="form">
				  <div class="form-group toggle-hide">
					<label for="text" class="control-label">Password</label>
					<input type="text" class="form-control" name="league_password" placeholder="League Password">
				  </div>
				  <input type='hidden' name='league_url_id' value='<?=$league_url_id?>'>
				  <button id="btn-joinleague" type="submit" class="btn btn-primary">Join</button>
				</form> 
			</div>  
		</div>    
	</div>
</div>

<!-- Scripts -->
<script src="bootstrap_3.1.1/js/jquery-1.11.0.min.js"></script>
<script src="bootstrap_3.1.1/js/bootstrap.min.js"></script>
<script src="nprogress/nprogress.js"></script>
<script src="select/bootstrap-select.min.js"></script>
<script type="text/javascript">
	$("#joinleagueform").submit(function() {

			var url = "league_join_process.php"; // the script where you handle the form input.

			$.ajax({
					 type: "POST",
					 url: url,
					 data: $("#joinleagueform").serialize(), // serializes the form's elements.
					 success: function(data)
					 {
					   $('#leaguejoinstatus').html(data); // show response from the php script.
					 }
				   });

			return false; // avoid to execute the actual submit of the form.
	});
</script>

<?php
	echo "</body>";
	echo "</html>";
?>