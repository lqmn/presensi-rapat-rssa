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
			<a class="navbar-brand" href="<?php echo base_url(); ?>">
				<img src="<?php echo base_url("assets/img/logo.png");?>" width="25px"></img>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav"> 
				<li id="jadwal-nav"><a href="<?php echo base_url("c_rapat/jadwal"); ?>">Jadwal</a></li>
				<li id="jadwal-detail-nav"><a href="<?php echo base_url("c_rapat/jadwal_detail"); ?>">Detail Jadwal</a></li>
			</ul>

			<div class="navbar-right">
				<ul class="nav navbar-nav">
					<li id="login-nav"><a href="<?php echo base_url("c_login/login_form"); ?>">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>