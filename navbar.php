<div class="main-nav navbar navbar-static-top navbar-default theme-bg" id="main-nav">
	<div class="container"><!--container-->
		<div class="navbar-header">
			<!--<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>-->
	
			<a class="navbar-brand" href="#" id="toggle-nav"><img class="euro16" src="images/euro16.svg"/></a>
		</div>
		
		<!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">-->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown hidden-xs" id="add-active">
					<button type="button" class="btn btn-primary navbar-btn dropdown-toggle" data-toggle="dropdown"><?=$username?> <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu">
						<li class="dropdown-plus-title"><?=$username?><b class="pull-right glyphicon glyphicon-chevron-up"></b></li>
						<li><a href="private_leagues.php" class="dropdown-plus-title"><i class="fa fa-group"></i> <strong>Private Leagues</strong></a></li>
						<li><a href="logout.php" class="dropdown-plus-title"><i class="fa fa-sign-out"></i> <strong>Logout</strong></a></li>
						<!--<li class="divider"></li>-->						    
					</ul>			
				</li>
				<!--<li class="hidden-md hidden-lg hidden-sm"><a href="logout.php"><i class="fa fa-sign-out"></i> <strong>logout</strong></a></li>-->
			</ul>
		<!--</div>-->
	</div><!--/.container-->
</div><!--/.navbar-->