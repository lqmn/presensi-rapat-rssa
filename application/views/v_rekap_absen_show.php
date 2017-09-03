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
		<div class="row content" id="mainContent">
			<div class="col-sm-12 text-left" id="mainDiv">
				<h4>Rekap Absen</h4>
				<form class="form=horizontal" action="<?php echo base_url();?>c_admin/rekap_absen/" method="post">
	<div class="form-group">
			<label class="control-label col-sm-1" for="pwd">Bulan:</label>
			<div class="col-sm-11">

				<select class="selectpicker"  name="id_bulan2">
					
						<option value="1" >Januari</option>
						<option value="2" >Februari</option>
						<option value="3" >Maret</option>
						<option value="4" >April</option>
						<option value="5" >Mei</option>
						<option value="6" >Juni</option>
						<option value="7" >Juli</option>
						<option value="8" >Agustus</option>
						<option value="9" >September</option>
						<option value="10" >Oktober</option>
						<option value="11" >November</option>
						<option value="12" >Desember</option>

				        
				</select>
			</div>
		</div>
		<br>
		<br>
		<br>

		

				<br>
<input type="submit" id="rekapAbsen" class="btn btn-primary"value="Lihat Rekap Absen" />
<br>
<hr>
</form>
				
				
				


				<br>
				<table id="tabel" class="table table-striped" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>NIP</th>
							<th>NAMA</th>
							<th>Total Absen</th>
						
						</tr>
					</thead>
					<tbody>
					<?php	foreach($absen as $key =>$value){ ?>
						<td><?php echo @$value->NIP;?></td>
						<td><?php echo @$value->NAMA;?></td>
						<td><?php echo @$value->TOTAL_ABSEN;?></td>
						<?php }?>
					</tbody>
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