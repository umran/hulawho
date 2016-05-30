<?php
require("init.php");

if ($_SESSION["loggedin"] != 1 || !isset($_SESSION["username"])) {

	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
	exit;

}

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

		<!-- Load Bootstrap Select -->
		<link href="select/bootstrap-select.min.css" rel="stylesheet">
		
		<link href="css/style.css" rel="stylesheet">

	</header>

	<body>
		<!-- nav bar row -->

		<div class="main-nav navbar navbar-static-top navbar-default theme-bg" id="main-nav">
			<div class="container"><!--container-->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
      				</button>
			
					<a class="navbar-brand" href="#" id="toggle-nav"><img src="images/wc2014.png" width="50px" height="50px"/></a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown hidden-xs" id="add-active">
							<button type="button" class="btn btn-primary navbar-btn dropdown-toggle" data-toggle="dropdown"><?=$username?> <span class="caret"></span></button>
							<ul class="dropdown-menu" role="menu">
								<li class="dropdown-plus-title"><?=$username?><b class="pull-right glyphicon glyphicon-chevron-up"></b></li>
					      <li><a href="logout.php" class="dropdown-plus-title"><i class="fa fa-sign-out"></i> <strong>logout</strong></a></li>
								<!--<li class="divider"></li>-->						    
							</ul>			
						</li>
						<li class="hidden-md hidden-lg hidden-sm"><a href="logout.php"><i class="fa fa-sign-out"></i> <strong>logout</strong></a></li>
					</ul>
				</div>
			</div><!--/.container-->
		</div><!--/.navbar-->			

		<!-- Status Indicator -->
		<div class="status" id="status">
		</div>

		<!-- games row -->
		<div class="container" id="predictor">
			<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<div class="form-horizontal">
							<div class="row" id="match-details">
								<div class="col-xs-12">
									<img class="logo_center" src="images/wc2014.png">
								</div>
							</div>
							<!-- begin form row -->
							<form role="form" id="prediction">
								<div class="row">
									<div class="col-xs-6">
										<!-- score input field -->
										<div class="form-group">
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
										</div>
										<!-- end field -->
									</div>
									<div class="col-xs-6">
										<!-- score input field -->
										<div class="form-group">
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
										</div>
										<!-- end field -->	
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group">
											<!--<label for="inputTitle" class="col-sm-3 control-label">Select Game</label>-->
											<div class="col-sm-12">
												<select class="selectpicker form-control" id="select-match">
													<option>Please select a game to predict...</option>												
													<?php
														include('fetch_games.php');
													?>
												</select>
											</div>
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
		<div class="container">
		  <div class="row">
	    	<div class="panel panel-primary filterable">
	      	<div class="panel-heading">
	        	<h3 class="panel-title"><strong>Predictions</strong></h3>
	       	</div>
	        <thead>	
			<table class="table" id="predictions">
			<?php
			//	include('fetch_predictions.php');
			?>
            </thead>
			</table>
         	</div>
		  </div>
		</div>
					
		<!-- rankings row -->
		<div class="container">
		  <div class="row">
	    	<div class="panel panel-primary filterable">
	      	<div class="panel-heading">
	        	<h3 class="panel-title"><strong>Leaderboard</strong></h3>
	          <div class="pull-right">
	            <button class="btn btn-primary btn-xs btn-filter"><span class="glyphicon glyphicon-search"></span> Filter</button>
	         	</div>
	       	</div>
	        <table class="table">
	        	<thead>
	          	<tr class="filters">
                <th><input type="text" class="form-control" placeholder="#" disabled></th>
                <th><input type="text" class="form-control" placeholder="User" disabled></th>
                <th><input type="text" class="form-control" placeholder="GD" disabled></th>
                <th><input type="text" class="form-control" placeholder="TOT" disabled></th>
              </tr>
            </thead>
            <tbody id="rankings">
           	</tbody>
         	</table>
     		</div>
		  </div>
		</div>
		
		<!-- scripts -->
		<script src="bootstrap_3.1.1/js/jquery-1.11.0.min.js"></script>
		<script src="bootstrap_3.1.1/js/bootstrap.min.js"></script>
		<script src="nprogress/nprogress.js"></script>
		<script src="select/bootstrap-select.min.js"></script>
		<script type="text/javascript">
			$('.selectpicker').selectpicker();
			
			//plugin bootstrap minus and plus
			//http://jsfiddle.net/laelitenetwork/puJ6G/
			$('.btn-number').click(function(e){
			    e.preventDefault();
    
			    fieldName = $(this).attr('data-field');
			    type      = $(this).attr('data-type');
			    var input = $("input[name='"+fieldName+"']");
			    var currentVal = parseInt(input.val());
			    if (!isNaN(currentVal)) {
				  if(type == 'minus') {
		
					if(currentVal > input.attr('min')) {
					    input.val(currentVal - 1).change();
					} 
					if(parseInt(input.val()) == input.attr('min')) {
					    $(this).attr('disabled', true);
					}

				  } else if(type == 'plus') {

					if(currentVal < input.attr('max')) {
					    input.val(currentVal + 1).change();
					}
					if(parseInt(input.val()) == input.attr('max')) {
					    $(this).attr('disabled', true);
					}

				  }
			    } else {
				  input.val(0);
			    }
			});
			
			$('.input-number').focusin(function(){
			   $(this).data('oldValue', $(this).val());
			});
			
			$('.input-number').change(function() {
    
			    minValue =  parseInt($(this).attr('min'));
			    maxValue =  parseInt($(this).attr('max'));
			    valueCurrent = parseInt($(this).val());
    
			    name = $(this).attr('name');
			    if(valueCurrent >= minValue) {
				  $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
			    } else {
				  alert('Sorry, the minimum value was reached');
				  $(this).val($(this).data('oldValue'));
			    }
			    if(valueCurrent <= maxValue) {
				  $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
			    } else {
				  alert('Sorry, the maximum value was reached');
				  $(this).val($(this).data('oldValue'));
			    }
    
    
			});
			
			$(".input-number").keydown(function (e) {
			  // Allow: backspace, delete, tab, escape, enter and .
			  if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
				 // Allow: Ctrl+A
				(e.keyCode == 65 && e.ctrlKey === true) || 
				 // Allow: home, end, left, right
				(e.keyCode >= 35 && e.keyCode <= 39)) {
				     // let it happen, don't do anything
				     return;
			  }
			  // Ensure that it is a number and stop the keypress
			  if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			  }
			});

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

			$(document).ready(function(){
				$('.filterable .btn-filter').click(function(){
				    var $panel = $(this).parents('.filterable'),
				    $filters = $panel.find('.filters input'),
				    $tbody = $panel.find('.table tbody');
				    if ($filters.prop('disabled') == true) {
				        $filters.prop('disabled', false);
				        $filters.first().focus();
				    } else {
				        $filters.val('').prop('disabled', true);
				        $tbody.find('.no-result').remove();
				        $tbody.find('tr').show();
				    }
				});

				$('.filterable .filters input').keyup(function(e){
				    /* Ignore tab key */
				    var code = e.keyCode || e.which;
				    if (code == '9') return;
				    /* Useful DOM data and selectors */
				    var $input = $(this),
				    inputContent = $input.val().toLowerCase(),
				    $panel = $input.parents('.filterable'),
				    column = $panel.find('.filters th').index($input.parents('th')),
				    $table = $panel.find('.table'),
				    $rows = $table.find('tbody tr');
				    /* Dirtiest filter function ever ;) */
				    var $filteredRows = $rows.filter(function(){
				        var value = $(this).find('td').eq(column).text().toLowerCase();
				        return value.indexOf(inputContent) === -1;
				    });
				    /* Clean previous no-result if exist */
				    $table.find('tbody .no-result').remove();
				    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
				    $rows.show();
				    $filteredRows.hide();
				    /* Prepend no-result row if all rows are filtered */
				    if ($filteredRows.length === $rows.length) {
				        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
				    }
				});
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
	</body>
</html>
