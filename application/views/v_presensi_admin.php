<!DOCTYPE html>
<head>
	<title>Presensi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/DataTables/datatables.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-select.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-datetimepicker.css");?>" />
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css"); ?>"> -->
</head>
<body>

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div id="modalContent" class="modal-content">
				//content from ajax loaded here
			</div>
		</div>
	</div>

	<?php 
	if ($this->session->userdata('otoritas')==1) {
		$this->load->view('navbar_admin');
	}else{
		$this->load->view('navbar');
	}
	?><br>

	<div class="container text-center">
		<div class="row content">
			<div class="col-sm-12 text-left">
				<h4>Presensi</h4>
				<a href="<?php echo base_url("c_presensi/upload_page/"); ?>">
					<button class="btn btn-primary" id="uploadPage" type="button">Upload</button>
				</a>
				<button class="btn btn-primary" id="libur" type="button" data-toggle="modal" data-target="#myModal">Hari libur</button>
				<div class="pull-right">
					<select id="changeColumn" class="selectpicker" multiple>
						<option value="0" selected>NIP</option>
						<option value="1" selected>NAMA</option>
						<option value="2" selected>SATKER</option>
						<option value="3" selected>TAHUN</option>
						<option value="4" selected>BULAN</option>
					</select>
					<select id="rekapDropdown" class="selectpicker" name="tabel">
						<option value="1" selected>Presensi</option>
						<option value="2">Lembur</option>
					</select>
				</div>
				

				<br><br>
				<table id="tabelRekap" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>NIP</th>
							<th>NAMA</th>
							<th>SATKER</th>
							<th>TAHUN</th>
							<th>BULAN</th>
							<th>PRESENSI</th>
							<th>LEMBUR</th>
							<th class="checkbox">Panel</th>
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
	<script type="text/javascript" src="<?php echo base_url("assets/js/presensi.js"); ?>"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</body>
</html>