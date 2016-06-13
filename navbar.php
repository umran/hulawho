<div class="navbar navbar-static-top navbar-default hidden-xs">
	<div class="container"><!--container-->
		<div class="navbar-header">
	
			<a class="navbar-brand" href="/"><img class="euro16" src="images/euro16.svg"/></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown" id="add-active">
				<button type="button" class="btn btn-primary navbar-btn dropdown-toggle" data-toggle="dropdown"><?=$username?></span></button>
				<ul class="dropdown-menu" role="menu">
					<li class="dropdown-plus-title"><?=$username?><b class="pull-right glyphicon glyphicon-chevron-up"></b></li>
					<li><a href="private_leagues.php" class="dropdown-plus-title"><i class="fa fa-group"></i> <strong>Private Leagues</strong></a></li>
					<li><a href="#" class="dropdown-plus-title"><i class="fa fa-check-circle-o"></i> <strong>Predictions</strong></a></li>
					<li><a href="#" class="dropdown-plus-title"><i class="fa fa-shopping-cart"></i> <strong>Shop</strong></a></li>
					<li><a href="#" class="dropdown-plus-title"><i class="fa fa-trophy"></i> <strong>Awards</strong></a></li>
					<li><a href="#" class="dropdown-plus-title"><i class="fa fa-cog"></i> <strong>Account Settings</strong></a></li>
					<li><a href="logout.php" class="dropdown-plus-title"><i class="fa fa-sign-out"></i> <strong>Logout</strong></a></li>						    
				</ul>			
			</li>
		</ul>
	</div><!--/.container-->
</div><!--/.navbar-->

<!-- Mobile Navbar -->
<div class="navbar navbar-static-top navbar-default visible-xs">
	<div class='container-fluid'>
		<div class="row no-padding">
			<div class="col-xs-2">
				<div class="navbar-header">
				  <a class="navbar-brand" href="/"><img class="euro16" src="images/euro16.svg"/></a>
				</div>
			</div>
			<div class="col-xs-10">
				<ul class="nav navbar-nav navbar-right">
					<li class=''>
						<a href='private_leagues.php'>
							<i class="fa fa-group"></i>
						</a>
					</li>
					<li class=''>
						<a href='#'>
							<i class="fa fa-cog"></i>
						</a>
					</li>
					<li class=''>
						<a href='logout.php'>
							<i class="fa fa-sign-out"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>