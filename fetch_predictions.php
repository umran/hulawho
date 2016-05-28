<?php

require("init.php");

//get all available games and game info


$pd = "SELECT flags.flag as team_b_flag, therest.* from
(
SELECT flags.flag as team_a_flag,predictions.* FROM(
SELECT username,matches.team_a as team_a_name, matches.team_b as team_b_name,predictions.team_a as score_a,predictions.team_b as score_b,predictions.time FROM `predictions` inner join matches on predictions.match_id=matches.match_id order by time desc)predictions
INNER JOIN flags ON predictions.team_a_name = flags.teams)therest
INNER JOIN flags ON therest.team_b_name = flags.teams where username='$username'  order by time desc";
$pd_exec = mysqli_query($con, $pd);
echo "<table >";
while ($row = mysqli_fetch_assoc($pd_exec)){
	
		echo "<tr>
		<td>".date('m-d-Y H:i:s', $row['time'])."</td>
		<td><img class='thumb' src='images/icons/".strtolower($row['team_a_flag']).".gif'/>&nbsp".$row['team_a_name']."</td>
		<td><div class='score'>".$row['score_a']." - ".$row['score_b']."</div></td>
		<td><div class='pull-right'>".$row['team_b_name']."&nbsp<img class='thumb' src='images/icons/".strtolower($row['team_b_flag']).".gif'/></div></td>
		<td>"."</td>
		</tr>";
	
}
echo "</table>";
?>
