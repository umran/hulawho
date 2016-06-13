<?php
require("init.php");

if(!isset($_SESSION['username'])){
	header('Location: https://www.hulawho.mv');
	exit;
}

echo "<html>";
require('header.php');

?>

<body>

	<?php
		require('navbar.php');
	?>

	<div class='container'>
		<div class='row no-padding'>
			<div class='col-xs-12' style="margin-top:20px;" id="leaguecreationstatus">
			</div>
			<div class="mainbox col-md-6 col-xs-12">
				<h4>Create a new league</h4>
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="createleagueform" role="form">
						  <div class="form-group toggle-hide">
							<label for="text" class="control-label">League</label>
							<input type="text" class="form-control" name="league_name" placeholder="League Name">
						  </div>
						  <button id="btn-createleague" type="submit" class="btn btn-primary">Create</button>
						</form> 
					</div>  
				</div>    
			</div>
			
			<!-- Show private leagues -->
			<div class="mainbox col-md-6 col-xs-12">
				<h4>My Leagues</h4>
				<div id="leaguelist" class="list-group">
				
				</div>    
			</div>
			
			<!-- Show private leaderboards -->
			<div class='col-xs-12' id='privateleaderboards'>
			</div>
			
		</div>
	</div>

	<!-- Scripts -->
	<script src="bootstrap_3.1.1/js/jquery-1.11.0.min.js"></script>
	<script src="bootstrap_3.1.1/js/bootstrap.min.js"></script>
	<script src="nprogress/nprogress.js"></script>
	<script src="select/bootstrap-select.min.js"></script>
	<script type="text/javascript">
		
		function fetchLeagues() {
			$.ajax({
				type: "GET",
				url: "league_list.php",
				success: function(data) {
					$('#leaguelist').html(data);
				}
			});
		}
		
		function fetchLeaderboards() {
			$.ajax({
				type: "GET",
				url: "private_rankings.php",
				success: function(data) {
					$('#privateleaderboards').html(data);
				}
			})
		}
		
		$("#createleagueform").submit(function() {

				var url = "submit_league.php"; // the script where you handle the form input.

				$.ajax({
					     type: "POST",
					     url: url,
					     data: $("#createleagueform").serialize(), // serializes the form's elements.
					     success: function(data)
					     {
						   $('#leaguecreationstatus').html(data); // show response from the php script.
						   fetchLeagues();
					     }
					   });

				return false; // avoid to execute the actual submit of the form.
		});
		
		function init() {
			fetchLeagues();
			fetchLeaderboards();
		}
		
		window.onload = init;
	</script>
	
	<?php include_once("analyticstracking.php") ?>
	
</body>

<?php
echo "</html>";
?>