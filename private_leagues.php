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
		require('navbar.php')
	?>

	<div class='container'>
		<div style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		  <div class="panel panel-default">
			<div class="panel-heading">
			    <div class="panel-title">Start a new league</div>
			</div>  
			<div class="panel-body" >
			    <form id="createleagueform" class="form-horizontal" role="form">
				  <div id="leaguecreationstatus">
				  </div>
				  <div class="form-group">
					<label for="email" class="col-md-3 control-label">League</label>
					<div class="col-md-9">
					    <input type="text" class="form-control" name="league_name" placeholder="League Name">
					</div>
				  </div>

				  <div class="form-group">
					<!-- Button -->                                        
					<div class="col-md-offset-3 col-md-3">
					    <button id="btn-createuser" type="submit" class="btn btn-info">Create</button>  
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
	<script src="select/bootstrap-select.min.js"></script>
	<script type="text/javascript">
		$("#createleagueform").submit(function() {

				var url = "submit_league.php"; // the script where you handle the form input.

				$.ajax({
					     type: "POST",
					     url: url,
					     data: $("#createleagueform").serialize(), // serializes the form's elements.
					     success: function(data)
					     {
						   $('#leaguecreationstatus').html(data); // show response from the php script.
						   $('#leaguecreationstatus').show();
					     }
					   });

				return false; // avoid to execute the actual submit of the form.
		});
	</script>
</body>

<?php
echo "</html>";
?>