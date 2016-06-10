<?php

//get all available games and game info

//get current time
$time = time();

$q = "SELECT * FROM matches";
$q_exec = mysqli_query($con, $q);

while ($row = mysqli_fetch_assoc($q_exec)){
	$match_time = $row['unix_time'] - 21600;	
	if($match_time>$time){
		echo "<option value='".$row['match_id']."'>".$row['team_a']." vs ".$row['team_b']."</option>\n";
	}
	else{
		continue;
	}
}

?>
