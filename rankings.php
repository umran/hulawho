<?php

require("init.php");

if($_POST["league"] == "global"){

	//load rankings from global rankings table
	$q="SELECT * FROM rankings ORDER BY total DESC";
	$q_exec = mysqli_query($con,$q);

	$n=0;
	$total_prev = "";
	while($row = mysqli_fetch_assoc($q_exec)){	
		$username = $row['username'];
		$gd_total = $row['gd_total'];
		$total = $row['total'];

		if($total_prev != $total){
			$n+=1;
		}
		
		$total_prev = $total;

		?>

		<tr>
		  <td><?=$n?></td>
		  <td><?=$username?></td>
		  <td><?=$gd_total?></td>
		  <td><?=$total?></td>
		</tr>

		<?php
	}
}
else {
	include("league_tally.php");
}
?>
