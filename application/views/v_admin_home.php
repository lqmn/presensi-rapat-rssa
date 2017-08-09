<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>

	<nav class="navbar navbar-inverse visible-xs">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#">Logo</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">

					<li><a href="<?php echo base_url();?>/c_admin/pegawai/">Admin</a></li>
					<li><a href="#">Presensi</a></li>
					<li><a href="#">Rapat</a></li>

				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-3 sidenav hidden-xs" style="position:fixed">
				<img src="<?php echo base_url();?>assets/img/logo.png" width="200px" height="200px"></img>
				<ul class="nav nav-pills nav-stacked" >

					<li class="active"><a href="<?php echo base_url();?>c_admin/pegawai">Admin</a></li>
					<li><a href="#">Presensi</a></li>
					<li><a href="#">Rapat</a></li>
					<li><a href="<?php echo base_url();?>c_admin/logout">Logout</a></li>
					<li style="margin-top:55%">Logged in : <?php echo $this->session->userdata('nama_user'); ?> as administrator</li>
					<li >NIP: <?php echo $this->session->userdata('nip_pegawai');            ?> </li>
					
					
				
				
					

				</ul><br>
			</div>
			<br>

			<div class="col-sm-9" style="margin-left:25%">
				<div class="well">
					<h4>Dashboard</h4>
					<p>Some text..</p>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="well">
							<h4>Users</h4>
							<p>1 Million</p> 
						</div>
					</div>
					<div class="col-sm-3">
						<div class="well">
							<h4>Pages</h4>
							<p>100 Million</p> 
						</div>
					</div>
					<div class="col-sm-3">
						<div class="well">
							<h4>Sessions</h4>
							<p>10 Million</p> 
						</div>
					</div>
					<div class="col-sm-3">
						<div class="well">
							<h4>Bounce</h4>
							<p>30%</p> 
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="well">
							<p>Text</p> 
							<p>Text</p> 
							<p>Text</p> 
						</div>
					</div>
					<div class="col-sm-4">
						<div class="well">
							<p>Text</p> 
							<p>Text</p> 
							<p>Text</p> 
						</div>
					</div>
					<div class="col-sm-4">
						<div class="well">
							<p>Text</p> 
							<p>Text</p> 
							<p>Text</p> 
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8">
						<div class="well">
							<p>Text</p> 
						</div>
					</div>
					<div class="col-sm-4">
						<div class="well">
							<p>Text</p> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
