<?php
require("init.php");

$time = time();

$gameday = gameday($time);

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
	
}

?>
		
