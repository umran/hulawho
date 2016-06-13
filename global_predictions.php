<?php

require('init.php');

print "<html>";
require('header.php');
require('navbar.php');
print "<body>";

$predictionsquery = "SELECT flags.flag as team_b_flag, therest.* from
(
SELECT flags.flag as team_a_flag,predictions.* FROM(
SELECT username,matches.unix_time as match_time, matches.team_a as team_a_name, matches.team_b as team_b_name,predictions.team_a as score_a,predictions.team_b as score_b FROM `predictions` inner join matches on predictions.match_id=matches.match_id order by matches.unix_time desc)predictions
INNER JOIN flags ON predictions.team_a_name = flags.teams)therest
INNER JOIN flags ON therest.team_b_name = flags.teams";

$fetchPredictions = mysqli_query($con, $predictionsquery);
?>

<div class="container container-predictions">
  <div class="row">
	<h4><strong>Predictions</strong></h4>
	<div class="table-responsive">	
		<table class="table table-striped">
		<thead>
		</thead>
		<tbody>

<?php
while($row = mysqli_fetch_assoc($fetchPredictions)) {
	$match_time = $row['match_time'];
	
	if ($match_time > time()) {
		continue;
	}
	
	echo "<tr>
		<td><div class='row'><div class='col-md-3 col-xs-4'><div class=''>".$row['username']."</div></div><div class='col-md-3 col-xs-2'><div class=''><img class='thumb_left' src='images/insignias/".strtolower($row['team_a_flag']).".svg'/><span class='hidden-xs'>".$row['team_a_name']."</span></div></div><div class='col-md-3 col-xs-4'><div class='score'>".$row['score_a']." - ".$row['score_b']."</div></div><div class='col-md-3 col-xs-2'><div class='pull-right'><span class='hidden-xs'>".$row['team_b_name']."</span><img class='thumb_right' src='images/insignias/".strtolower($row['team_b_flag']).".svg'/></div></div></div></td>
		</tr>";
}
?>

		</tbody>
		</table>
	</div>
  </div>
</div>