<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- dataTables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>

	<!-- bootstrap-select -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>

	<!-- Custom CSS & JS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css" type="text/css">
	<script src="<?php echo base_url(); ?>assets/js/admin_pegawai.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
		var tabel;
	</script>
</head>
<body>
	<?php if ($this->session->userdata('otoritas')!=1) {
		redirect('c_admin/error_authority', 'refresh');
	} ?>

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div id="modalContent" class="modal-content">
				//content from ajax loaded here
			</div>
		</div>
	</div>

	<nav class="navbar navbar-inverse visible-xs">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#">
					<img src="<?php echo base_url();?>assets/img/logo.png" width="25px"></img>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<p class="navbar-text">Logged in : <?php echo $this->session->userdata('nama'); ?> as administrator<br>NIP: <?php echo $this->session->userdata('username'); ?></p>
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo base_url();?>c_admin/pegawai"><span class="	glyphicon glyphicon-user"></span> Admin</a></li>
					<li><a href="<?php echo base_url();?>c_admin/presensi"><span class="glyphicon glyphicon-th-list"></span> Presensi</a></li>
					<li><a href="<?php echo base_url();?>c_admin/rapat"><span class="glyphicon glyphicon-briefcase"></span> Rapat</a></li>
					<li><a href="<?php echo base_url();?>c_admin/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-3 sidenav hidden-xs affix">
				<img src="<?php echo base_url();?>assets/img/logo.png" width="200px" height="200px"></img>
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="<?php echo base_url();?>c_admin/pegawai"><span class="	glyphicon glyphicon-user"></span> Admin</a></li>
					<li><a href="<?php echo base_url();?>c_admin/presensi"><span class="glyphicon glyphicon-th-list"></span> Presensi</a></li>
					<li><a href="<?php echo base_url();?>c_admin/rapat"><span class="glyphicon glyphicon-briefcase"></span> Rapat</a></li>
					<li><a href="<?php echo base_url();?>c_admin/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
				</ul><br>
				<p class="navbar-text">Logged in : <?php echo $this->session->userdata('nama'); ?> as administrator<br>NIP: <?php echo $this->session->userdata('username'); ?></p>
			</div>
			<br>
			<div class="col-sm-3 hidden-xs"></div>

			<div class="col-sm-9">
				<div class="well">
					<!-- content -->
					<div class="pull-right">
						<select id="page" class="selectpicker" name="tabel">
							<option value="1" selected>Pegawai</option>
							<option value="2">User</option>
							<option value="3">Non Pegawai</option>
						</select>
					</div><h4>Pegawai</h4>
					<br>
					<table id="tabel" class="table table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="center col-xs-1"><input id="select-all" type="checkbox"/></th>
								<th>Nama</th>
								<th>NIP</th>
								<th>Satker</th>
								<th>Panel</th>
							</tr>
						</thead>
					</table>

				</div>
			</div>
		</div>
	</div>

</body>
</html>
