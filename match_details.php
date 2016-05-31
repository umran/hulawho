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
	$time = $row['unix_time']-18000;
	
?>

								<div class="col-xs-6">
									<img class="img_block" src="images/icons/<?=$code_a?>.gif">
									<div class="cname" style="text-align:center; padding-top:5px;">
										<h5><strong><?=$team_a?></strong></h5>
									</div>
								</div>
								<div class="col-xs-6">
									<img class="img_block" src="images/icons/<?=$code_b?>.gif">
									<div class="cname" style="text-align:center; padding-top:5px;">
										<h5><strong><?=$team_b?></strong></h5>
									</div>	
								</div>

<?php	
}
else{
?>
								<div class="col-xs-12">
									<img src="images/wc2014.png">
								</div>
<?php
}
?>
