<!DOCTYPE html>
<html>
<head>
	<title>Jadwal rapat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/DataTables/datatables.min.css"); ?>">
	<style type="text/css">
		.table .borderless{
			border-bottom:0px !important;
		}
		.table .borderless th, .table .borderless td {
			border: 1px !important;
		}
		.fixed-table-container .borderless{
			border:0px !important;
		}
		.table-nonfluid {
			width: auto !important;
		}
	</style>
</head>
<body>
	<?php $this->load->view('navbar_guest'); ?><br>

	<div class="container-fluid text-center">
		<div class="row content">
			<div class="col-sm-12 text-left">
				<table id="tabelGuest" class="table">
					<thead>
						<tr>
							<th></th>
							<th>Waktu</th>
							<th>Ruang</th>
							<th>Judul</th>
						</tr>
					</thead>
				</table>

			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/DataTables/datatables.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/guest_detail.js"); ?>"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</body>
</html>