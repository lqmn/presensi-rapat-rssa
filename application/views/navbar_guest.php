<style type="text/css">
	.navbar {
		margin-bottom: 0;
		border-radius: 0;
	}
</style>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="#">
				<img src="<?php echo base_url("assets/img/logo.png");?>" width="25px"></img>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav"> 
				<li id="jadwal-nav"><a href="<?php echo base_url("c_rapat/"); ?>">Jadwal</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li id="login-nav"><a href="<?php echo base_url("c_login/"); ?>">Login</a></li>
			</ul>
		</div>
	</div>
</nav>