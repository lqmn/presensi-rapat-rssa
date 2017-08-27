<!DOCTYPE html>
<head>
	<title>Presensi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/DataTables/datatables.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-select.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css"); ?>">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

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
				<h4>Presensi</h4>
				<button class="btn btn-info btn-lg" id="upload" type="button" data-toggle="modal" data-target="#bigModal">Upload</button>
				
<button style="margin-right:10px;"class="btn btn-primary btn-lg pull-right" id="hariLibur" type="button" data-toggle="modal" data-target="#bigModal">Hari Libur</button>
				
				<button class="btn btn-info btn-lg pull-right" style="margin-right:10px;"id="rekapAbsen" type="button" data-toggle="modal" data-target="#bigModal">Rekap Absen</button>
				
				
				<button style="margin-right:10px;"class="btn btn-info btn-lg pull-right" id="rekapLembur" type="button" data-toggle="modal" data-target="#bigModal">Rekap Lembur</button>


				<br>
				<table id="tabel" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>NIP</th>
							<th>NAMA</th>
							<th>Satker</th>
							<th>Bulan</th>
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
	<script type="text/javascript" src="<?php echo base_url("assets/js/presensi.js"); ?>"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
	<!-- bootstrap-datetimepicker -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.css" />
</body>
</html>