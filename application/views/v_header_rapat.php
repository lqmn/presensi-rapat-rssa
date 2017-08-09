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
	
	<!-- bootstrap-datetimepicker -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.css" />
	



</head>
<body>
<?php if ($this->session->userdata('otoritas')!=1) {
			// echo "admin";
			redirect('c_admin/error_authority', 'refresh');
		} ?>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div id="modalContent" class="modal-content">
				//content from ajax loaded here
			</div>

		</div>
	</div>
		<div class="col-sm-3 sidenav hidden-xs" style="position:fixed">
				<img src="<?php echo base_url();?>assets/img/logo.png" width="200px" height="200px"></img>
				<ul class="nav nav-pills nav-stacked" >

					<li ><a href="<?php echo base_url();?>c_admin/pegawai">Admin</a></li>
					<li><a href="<?php echo base_url();?>c_admin/presensi">Presensi</a></li>
					<li class="active"><a href="<?php echo base_url();?>c_admin/rapat">Rapat</a></li>
					<li><a href="<?php echo base_url();?>c_admin/logout">Logout</a></li>
					<li style="margin-top:55%">Logged in : <?php echo $this->session->userdata('nama_user'); ?> as administrator</li>
					<li >NIP: <?php echo $this->session->userdata('nip_pegawai');            ?> </li>
				</ul><br>
			</div>
			<br>