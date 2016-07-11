<?php

require("init.php");

if($_POST["league"] == "global"){

	//load rankings from global rankings table
	$q="SELECT * FROM rankings ORDER BY total DESC, corr_ratio DESC";
	$q_exec = mysqli_query($con,$q);

	$n=0;
	$acc_prev = "";
	$total_prev = "";
	while($row = mysqli_fetch_assoc($q_exec)){	
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
}
else {
	include("league_tally.php");
}
?>
