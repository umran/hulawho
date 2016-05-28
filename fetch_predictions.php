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
		<td>".date('m-d-Y H:i:s', $row['time'])."&nbsp</td>
		<td>"."<img style='height:15px;' src='images/icons/".strtolower($row['team_a_flag']).".gif'/></td>
		<td>&nbsp".$row['team_a_name']."&nbsp</td>
		<td>".$row['score_a']."</td>
		<td>&nbspvs&nbsp</td>
		<td>".$row['score_b']."&nbsp</td>
		<td>".$row['team_b_name']."</td>
		<td>"."<img style='height:15px;' src='images/icons/".strtolower($row['team_b_flag']).".gif'/></td>
		<td>"."</td>
		</tr>";
	
}
echo "</table>";
?>
