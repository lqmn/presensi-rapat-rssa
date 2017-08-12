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


	
</head>
<body>
<?php if ($this->session->userdata('otoritas')!=1) {
			// echo "admin";
			redirect('c_admin/error_authority', 'refresh');
		} ?>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div id="modalContent" class="modal-content">
				//content from ajax loaded here modal
			</div>

		</div>
	</div>


	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-3 sidenav hidden-xs" style="position:fixed">
				<img src="<?php echo base_url();?>assets/img/logo.png" width="200px" height="200px"></img>
				<ul class="nav nav-pills nav-stacked" >

				<li class="active"><a href="<?php echo base_url();?>c_admin/pegawai">Admin</a></li>
					<li><a href="<?php echo base_url();?>c_admin/presensi">Presensi</a></li>
					<li><a href="<?php echo base_url();?>c_admin/rapat">Rapat</a></li>
					<li><a href="<?php echo base_url();?>c_admin/logout">Logout</a></li>
					<li style="margin-top:55%">Logged in : <?php echo $this->session->userdata('nama_user'); ?> as administrator</li>
					<li >NIP: <?php echo $this->session->userdata('nip_pegawai');            ?> </li>
					
					
				
				
					

				</ul><br>
			</div>
			<br>

			<div class="col-sm-9" style="margin-left:25%">
				<div class="well">
					<div width=100% style="float:right;">
						<select id="page" class="selectpicker" name="tabel">
							<option value="1">Pegawai</option>
							<option value="2" selected>User</option>
							<option value="3">Non Pegawai</option>
						</select>
					</div><h4>User</h4>
					<br>
					<table id="tabel" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><input name="select_all" value="1" id="select-all" type="checkbox" /></th>
								<th>Username</th>
								<th>Otoritas</th>
								<th>Panel</th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php foreach ($dataUser as $key => $value): ?>
								<tr>
									<td><?php echo $value->ID_PEGAWAI; ?></td>
									<td><?php echo $value->NIP; ?></td>
									<td><?php echo $value->NAMA; ?></td>
									<td><?php echo $value->ID_SATKER; ?></td>
									<td><?php echo $value->STATUS; ?></td>
								</tr>
							<?php endforeach ?> -->
						</tbody>
					</table>
					<button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah</button>
					
					<button id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button>
				</div>
			</div>

		</div>
	</div>


</body>
<!-- Custom CSS & JS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css" type="text/css">
	<script src="<?php echo base_url(); ?>assets/js/admin_user.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</html>
