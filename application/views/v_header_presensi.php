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
<?php if ($this->session->userdata('otoritas')==0) {
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
		<div class="col-sm-3 sidenav hidden-xs" style="position:fixed ; <!--background-color:#7CFC00;"-->
				<img src="<?php echo base_url();?>assets/img/logo.png" width="200px" height="200px"></img>
				<ul class="nav nav-pills nav-stacked" >
				
				<?php if ($this->session->userdata('otoritas')==1) { ?>
			  <li><a href="<?php echo base_url();?>c_admin/pegawai"><span class="	glyphicon glyphicon-user"></span> Admin</a></li>
				<?php }?>
		
					
					<li class="active"><a href="<?php echo base_url();?>c_admin/presensi"><span class="glyphicon glyphicon-th-list"></span> Presensi</a></li>
					<li ><a href="<?php echo base_url();?>c_admin/rapat"><span class="glyphicon glyphicon-briefcase"></span> Rapat</a></li>
					<li><a href="<?php echo base_url();?>c_admin/logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
				</ul><br>
				<p class="navbar-text">Logged in : <?php echo $this->session->userdata('nama'); ?> as <?php if($this->session->userdata('otoritas')==1){ echo "Administrator";} else if ($this->session->userdata('otoritas')==2){ echo "Verifikator";} else {echo "User";}?><br>NIP: <?php echo $this->session->userdata('username'); ?></p>
			</div>
			<br>