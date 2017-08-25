<!DOCTYPE html>
<head>
	<title>user - Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/DataTables/datatables.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-select.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css"); ?>">
</head>
<body>

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div id="modalContent" class="modal-content">
				//content from ajax loaded here
			</div>
		</div>
	</div>

	<?php $this->load->view('navbar_admin'); ?><br>

	<div class="container text-center">
		<div class="row content">
			<div class="col-sm-12 text-left">

				<div class="pull-right">
					<select id="page" class="selectpicker" name="tabel">
						<option value="1">Pegawai</option>
						<option value="2" selected>User</option>
						<option value="3">Non Pegawai</option>
					</select>
				</div>
				<h4>User</h4>
				<br>
				<table id="tabel" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><input id="select-all" type="checkbox"/></th>
							<th>Username</th>
							<th>Otoritas</th>
							<th>Panel</th>
						</tr>
					</thead>
				</table>

			</div>
		</div>
	</div>


	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/DataTables/datatables.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-select.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/admin_user.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/admin.js"); ?>"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</body>
</html>