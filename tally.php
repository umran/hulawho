<?php
require("init.php");

$time = time();

$gameday = gameday($time) - 1;

print "the current gameday is ".$gameday."\n";
//retrieve all users

$q = "SELECT username FROM users";

$q_exec = mysqli_query($con, $q);
$users = array();
while($row = mysqli_fetch_array($q_exec)){
	array_push($users, $row['username']);
} 

foreach ($users as $user){
	print "fetching records for ".$user."\n";
	//load user's total points
	$tot_pts = 0;
	$gd_tot_pts =0;	
	
	//debugging code
	print "points initial: ".$tot_pts."\n";
	
	//retrieve user records from predictions table
	$q = "SELECT * FROM predictions WHERE username ='".$user."'";
	$q_exec = mysqli_query($con, $q);
	$n = mysqli_num_rows($q_exec);
	print "fetching per match records for ".$n." games \n";
	while ($row = mysqli_fetch_array($q_exec)){
		print "fetching records for match_id: ".$row['match_id']."\n";
		print "working on match_id: ".$row['match_id']."\n";
		//get match details from matches table and check if match has been played
		$q2 = "SELECT * FROM matches WHERE match_id=".$row['match_id'];
		$q2_exec = mysqli_query($con, $q2);
		$record = mysqli_fetch_array($q2_exec);
		if($record['is_over'] == false){
			print "match_id: ".$row['match_id']."has not yet been played, so skipping \n"; 
			continue;
		}
		else{
			//process the record
			$outcome_pts = 0;
			$score_pts = 0;
			
			$gd_outcome_pts = 0;
			$gd_score_pts = 0;
			
			print "initial outcome,score points for match_id: ".$row['match_id']." are: ".$outcome_pts.",".$score_pts."\n";

			//check if the winning team actual is equal to winning team predicted
			if ($record['a_score'] == $record['b_score']) {
				$act_result = "draw";	
			}
			elseif ($record['a_score'] < $record['b_score']){
				$act_result = $record['team_b'];
			}
			else{
				$act_result = $record['team_a'];
			}

			if ($row['team_a'] == $row['team_b']) {
				$prd_result = "draw";	
			}
			elseif ($row['team_a'] < $row['team_b']){
				$prd_result = $record['team_b'];
			}
			else{
				$prd_result = $record['team_a'];
			}

			if ($act_result == $prd_result){
				print "user predicted correct outcome for match_id: ".$row['match_id']."\n";
				$outcome_pts += 1;
				if ($gameday == $record['gameday']){
					$gd_outcome_pts += 1;				
				}
				//check if the score actual is equal to score predicted
				if($record['a_score'] == $row['team_a']){	
					if($record['b_score'] == $row['team_b']){
						print "also, user predicted correct score for match_id: ".$row['match_id']."\n"; 
						$score_pts += 2;
						if ($gameday == $record['gameday']){
							$gd_score_pts += 2;				
						}
					}
				}
			}
			print "final outcome,score points for match_id: ".$row['match_id']." are: ".$outcome_pts.",".$score_pts."\n";
			$tot_pts += ($outcome_pts + $score_pts);
			$gd_tot_pts += ($gd_outcome_pts + $gd_score_pts);
			//update is_checked status in predictions table						
		}
	}
	//debugging code
	print "gameday total points: ".$gd_tot_pts."\n";
	print "total points: ".$tot_pts."\n";
	
	//update user score in rankings table
	$update = "UPDATE rankings SET gd_total =".$gd_tot_pts.", total =".$tot_pts." WHERE username ='".$user."'";
	$update_exec = mysqli_query($con, $update);
	if(!$update_exec){
		print "error: mysql error!";
	}
	else{
		print "record for ".$user." has been updated successfully \n";
	} 
}

?>
