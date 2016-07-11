<?php

require('init.php');

if(!isset($_SESSION['username'])){
	print "<div class='alert alert-info'><strong><i class='fa fa-info-circle'></i> Oops. Looks like you're not logged in.</strong> <a href='index.php'>Login</a> to your account.</div>";
	exit;
}

// retrieve all leagues user is a member of
$leagues_query = "SELECT * FROM league_members WHERE username = '".$_SESSION['username']."'";
$getleagues = mysqli_query($con, $leagues_query);

$leagues = array();

if(mysqli_num_rows($getleagues) < 1) {
	exit;
}

while($row = mysqli_fetch_assoc($getleagues)) {
	array_push($leagues, $row['league_url_id']);
}

$member_sets = array();

foreach($leagues as $league) {
	$league_members = array();
	
	// get league names
	$name_query = "SELECT * FROM private_leagues WHERE url_id = '".$league."'";
	$getname = mysqli_query($con, $name_query);
	$record = mysqli_fetch_assoc($getname);
	$league_name = $record['name'];
	$league_members[0] = $league_name;

	$members_query = "SELECT * FROM league_members WHERE league_url_id = '".$league."'";
	$getmembers = mysqli_query($con, $members_query);
	
	
	while($row = mysqli_fetch_assoc($getmembers)) {
		array_push($league_members, "'".$row['username']."'");
	}
	
	array_push($member_sets, $league_members);
}

// generate rankings table for each array in super array
	// retrieve rankings for each user in array

foreach($member_sets as $member_set) {
	$lname = array_shift($member_set);
	$members = implode(",", $member_set);
	// generate table
	$mem = "SELECT * FROM rankings WHERE username in (".$members.") ORDER BY total DESC, corr_ratio DESC";
	$getmem = mysqli_query($con, $mem);
	$n=0;
	$acc_prev = "";
	$total_prev = "";
	
	?>
	
	<!-- rankings row -->
	<h4><strong><?=$lname?></strong></h4>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr class="filters">
					<th>Position</th>
					<th>User</th>
					<th>Accuracy</th>
					<th>Total Score</th>
				</tr>
			</thead>
			<tbody>
	
	<?php
	while($row = mysqli_fetch_assoc($getmem)){	
		$username = $row['username'];
		$total = $row['total'];
		$acc = $row['corr_ratio'];
		
		if($total_prev != $total) {
			$n+=1;
		} else if($acc_prev != $acc){
			$n+=1;
		}
		
		$acc_prev = $acc;
		$total_prev = $total;

		?>

		<tr>
		  <td><?=$n?></td>
		  <td><?=$username?></td>
		  <td><?=$acc?></td>
		  <td><?=$total?></td>
		</tr>

		<?php
	}
	?>
	
			</tbody>
		</table>
	  </div>
	
	<?php
}

?>