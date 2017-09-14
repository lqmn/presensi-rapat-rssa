<!DOCTYPE html>
<head>
	<title>Presensi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/DataTables/datatables.min.css"); ?>">
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
				<form id="fileForm" class="form-inline" action="" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group text-center">
								<input class="btn" type="file" accept=".xls,.xlsx" name="excel" id="inputExcel" required>
							</div>

							<div class="pull-right">
								<div class="form-group text-center">
									<select class="selectpicker" data-live-search="true" name="satker" required>
										<?php foreach ($satker as $key => $value): ?>
											<option value="<?php echo $value->ID_SATKER?>" data-tokens="<?php echo $value->NAMA_SATKER?>" <?php if ($this->session->userdata('id_satker')==$value->ID_SATKER) { echo 'selected'; } ?>><?php echo $value->NAMA_SATKER?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="form-group ">
									<button id="openFile" type="submit" class="btn btn-primary">Open</button>
								</div>
							</div>
						</div>
					</div>
				</form><br>
				<div id="contentConfirm">

				</div>
				<button id="save" type="button" class="btn btn-primary" disabled>Save</button>

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