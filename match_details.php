<?php

require("init.php");

if(!empty($_POST['match_id']) && is_numeric($_POST['match_id'])){
	$match_id = $_POST['match_id'];
	$match_id = mysqli_real_escape_string($con, $match_id);

	//get match details from the database
	$q = "SELECT * FROM matches WHERE match_id ='".$match_id."'";
	$q_exec = mysqli_query($con, $q);

	$row = mysqli_fetch_array($q_exec);
	
	//set meta details	
	$gameday = $row['gameday'];
	$team_a = $row['team_a'];
	$team_b = $row['team_b'];
	$code_a = getcode($team_a);
	$code_b = getcode($team_b);	
	$time = $row['unix_time'];
	
?>

								<div class="col-xs-5 col-absolute-left padded-left11">
									<div class='img-container'>
										<img class="img_block icon-md" src="images/insignias/<?=$code_a?>.svg">
										<div class="cname" style="text-align:center; padding-top:5px;">
											<h5><strong><?=$team_a?></strong></h5>
										</div>
									</div>
								</div>
								<div class="col-xs-2 col-absolute-middle">
									<div class="vs">
										<h4>vs</h4>
									</div>
								</div>
								<div class="col-xs-5 col-absolute-right padded-right11">
									<div class='img-container pull-right'>
										<img class="img_block icon-md" src="images/insignias/<?=$code_b?>.svg">
										<div class="cname" style="text-align:center; padding-top:5px;">
											<h5><strong><?=$team_b?></strong></h5>
										</div>
									</div>
								</div>

<?php	
}
else{
?>
								<div class="col-xs-12 col-absolute-default">
									<img class="img_block euro16-main" src="images/euro16.svg">
								</div>
<?php
}
?>
