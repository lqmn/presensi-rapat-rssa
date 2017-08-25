<!DOCTYPE html>
<head>
	<title>Rapat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/DataTables/datatables.min.css"); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-select.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-datetimepicker.css");?>" />
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
	<div id="bigModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div id="bigModalContent" class="modal-content">
				//content from ajax loaded here

			</div>
		</div>
	</div>

	<?php $this->load->view('navbar_admin'); ?><br>

	<div class="container text-center">
		<div class="row content">
			<div class="col-sm-12 text-left">
				<h4>Rapat</h4>
				<br>
				<table id="tabel" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><input id="select-all" type="checkbox"/></th>
							<th>Judul Rapat</th>
							<th>Waktu</th>
							<th>Ruang</th>
							<th>Status</th>
							<th>Pembuat</th>
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
	<script type="text/javascript" src="<?php echo base_url("assets/js/moment.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap-datetimepicker.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/admin_rapat.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/rapat.js"); ?>"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</body>
</html>