<?php
require("init.php");

if ($_SESSION["loggedin"] != 1 || !isset($_SESSION["username"])) {

	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	exit;

}

?>

<!DOCTYPE html>
<html>
	<?php
	require('header.php');
	?>

	<body>
	
		<?php
			require('navbar.php');
		?>			

		<!-- Status Indicator -->
		<div class="status" id="status">
		</div>

		<!-- games row -->
		<div class="container" id="predictor">
			<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-horizontal">
							<div class="row row-relative" id="match-details">
								<div class="col-xs-12 col-absolute-default">
									<img class="img_block euro16-main" src="images/euro16.svg">
								</div>
							</div>
							<!-- begin form row -->
							<form role="form" id="prediction">
								<div class="row row-score">
									<div class="col-xs-5">
										<div class="form-group">
											<input type="text" class="form-control score-input" name="quant1" id="quant1">
										</div>
										<!-- score input field -->
										<!--<div class="form-group">
											<div class="input-group">
				      					<span class="input-group-btn">
				          				<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant1">
				              			<span class="glyphicon glyphicon-minus"></span>
				          				</button>
				      					</span>
				      					<input type="text" name="quant1" id="quant1" class="form-control input-number" value="0" min="0" max="100" style="text-align:center;">
				      						<span class="input-group-btn">
				          					<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant1">
				              				<span class="glyphicon glyphicon-plus"></span>
				          					</button>
				      						</span>
				  						</div>
										</div>-->
										<!-- end field -->
									</div>
									<div class="col-xs-offset-2 col-xs-5">
										<div class="form-group">
											<input type="text" class="form-control score-input pull-right" name="quant2" id="quant2">
										</div>
										<!-- score input field -->
										<!--<div class="form-group">
											<div class="input-group">
					    					<span class="input-group-btn">
					        				<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant2">
					            			<span class="glyphicon glyphicon-minus"></span>
					        				</button>
					    					</span>
					    					<input type="text" name="quant2" id="quant2" class="form-control input-number" value="0" min="0" max="100" style="text-align:center;">
					    						<span class="input-group-btn">
					        					<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant2">
					            				<span class="glyphicon glyphicon-plus"></span>
					        					</button>
					    						</span>
											</div>
										</div>-->
										<!-- end field -->	
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<!--<label for="inputTitle" class="col-sm-3 control-label">Select Game</label>-->
											<!--<div class="col-sm-12">-->
												<select class="selectpicker form-control" id="select-match">
													<option>Please select a game to predict...</option>												
													<?php
														include('fetch_games.php');
													?>
												</select>
											<!--</div>-->
										</div>
									</div>
								</div>
								<div class="row">
									<input id="match_id" type="hidden" name="match_id" value="">
									<div class="form-group">
										<div style="text-align:center;">
											<button type ="submit" class="btn btn-primary">Submit Score</button>
										</div>								
									</div>
								</div>
							</form>
							
							
							<!-- end form row -->
						</div>
					</div>
			</div>
		</div>
		
		<!-- Predictions table -->
		<div class="container container-predictions">
		  <div class="row">
			<h4><strong>Predictions</strong></h4>
			<div class="table-responsive">	
				<table class="table table-striped">
				<thead>
				</thead>
				<tbody id="predictions">
				</tbody>
				</table>
			</div>
		  </div>
		</div>
					
		<!-- rankings row -->
		<div class="container container-leaderboard">
		  <div class="row">
		  	<h4><strong>Public Leaderboard</strong></h4>
			<div class="table-responsive">
				<table class="table table-striped">
					<thead>
						<tr class="filters">
							<th>Position</th>
							<th>User</th>
							<th>Points Received Last Gameday</th>
							<th>Total Score</th>
						</tr>
					</thead>
					<tbody id="rankings">
					</tbody>
				</table>
		  </div>
		</div>
		
		<!-- scripts -->
		<script src="bootstrap_3.1.1/js/jquery-1.11.0.min.js"></script>
		<script src="bootstrap_3.1.1/js/bootstrap.min.js"></script>
		<script src="nprogress/nprogress.js"></script>
		<script src="select/bootstrap-select.min.js"></script>
		<script type="text/javascript">
			$('.selectpicker').selectpicker();

			$("#select-match").change(function() {

    			var $value = $(this).val();
				var url = "match_details.php"; // the script where you handle the form input.
			
				$.ajax({
					type: "POST",
					url: url,
					data: {match_id: $value}, // serializes the form's elements.
					success: function(data){
						$('#match-details').html(data); // show response from the php script.
					}
				});
				$('.row-score').show();
				$('input#match_id').val($value);
				$('input#quant1').val(0);
				$('input#quant2').val(0);
			});

			$("#prediction").submit(function() {

				var url = "submit.php"; // the script where you handle the form input.

				$.ajax({
			      type: "POST",
			      url: url,
			      data: $("#prediction").serialize(), // serializes the form's elements.
			      success: function(data)
					{
						$('#status').html(data); // show response from the php script.
						$('#status').show();
						setTimeout(function() {
							$('#status').hide();
						}, 5000);
						
						loadPredictions();
					}
				});

				return false; // avoid to execute the actual submit of the form.
			});

			function loadRankings() {
				var url = 'rankings.php';
				$.ajax({
					type: "POST",
					url: url,
					data: {league: 'global'},
					success: function(data){
						$('#rankings').html(data); // show response from the php script.
					}
				});
			}
     			
			function loadPredictions() {
				var url = 'fetch_predictions.php';
				$.ajax({
					type: "POST",
					url: url,
					data: {league: 'global'},
					success: function(data){
						$('#predictions').html(data); // show response from the php script.
					}
				});
			}
     			
			function initialize(){
				loadRankings();
				loadPredictions();
			}
      		
      		window.onload = initialize; 
		</script>
		<?php include_once("analyticstracking.php") ?>
		
	</body>
</html>