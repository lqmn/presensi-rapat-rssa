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
				<li id="presensi-nav"><a href="#">Presensi</a></li>
				<li id="rapat-nav"><a href="<?php echo base_url("c_rapat/"); ?>">Rapat</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php 
				$namaOtoritas;
				switch ($this->session->userdata('otoritas')) {
					case 1: $namaOtoritas='Administrator';
					break;
					case 2: $namaOtoritas='Verifikator';
					break;
					case 3: $namaOtoritas='User';
					break;
				}
				?>
				<p class="navbar-text">Signed as <?php echo $this->session->userdata('username').', '.$this->session->userdata('nama').', '.$namaOtoritas; ?></p>
				<li id="logout-nav"><a href="<?php echo base_url("c_login/logout"); ?>">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>