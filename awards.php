<?php

require('init.php');

print "<html>";
require('header.php');
require('navbar_unauth.php');
print "<body>";

?>

<div class='container'>
	<div class='row'>
		<h4><strong>Winners</strong></h4>
		
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					
					<tr class="filters">
						<th>Title</th>
						<th>User</th>
						<th>Games Predicted</th>
						<th>Accuracy</th>
						<th>Total Score</th>
					</tr>
				
				</thead>
				<tbody id="rankings">		
					
					<tr class="success">
					  <td>1st Place Winner</td>
					  <td>mshamin</td>
					  <td>51</td>
					  <td>17.65</td>
					  <td>50</td>
					</tr>

		
					<tr class="success">
					  <td>2nd Place Winner</td>
					  <td>ymns</td>
					  <td>43</td>
					  <td>18.6</td>
					  <td>40</td>
					</tr>

		
					<tr class="success">
					  <td>3rd Place Winner</td>
					  <td>Afa Moosa</td>
					  <td>45</td>
					  <td>17.78</td>
					  <td>40</td>
					</tr>

		
					<tr class="warning">
					  <td>Group Stage Winner</td>
					  <td>mshamin</td>
					  <td>51</td>
					  <td>17.65</td>
					  <td>50</td>
					</tr>

		
					<tr class="info">
					  <td>Loyalty Card Winner</td>
					  <td>Natti</td>
					  <td>51</td>
					  <td>15.69</td>
					  <td>40</td>
					</tr>

		
					<tr class="info">
					  <td>Loyalty Card Winner</td>
					  <td>mshamin</td>
					  <td>51</td>
					  <td>17.65</td>
					  <td>50</td>
					</tr>
				
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php

print "</body>";
print "</html>";

?>