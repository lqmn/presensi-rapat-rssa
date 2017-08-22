

			<div class="col-sm-9" style="margin-left:25%">
				<div class="well">
					<div width=100% style="float:right;">
						
					</div>
					<!--
					<div class="pull-right">
						<select id="page" class="selectpicker" name="tabel">
							<option value="1" selected>Unverified</option>
							<option value="2">Semua Rapat</option>
							
						</select>
					</div>-->
					<h4>Upload dokumen presensi pegawai</h4>
					<br>
					
					

<?php echo form_open_multipart('c_admin/do_upload');?>




<div class="form-group">
			<label class="control-label col-sm-1" for="pwd">Bulan:</label>
			<div class="col-sm-11">

				<select class="selectpicker"  name="id_bulan">
					
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

		<div class="form-group">
			<label class="control-label col-sm-1" for="pwd">Upload:</label>
			<div class="col-sm-11">

			
				<input type="file" name="userfile" size="20" />
			</div>
		</div>


				<br>
<input type="submit" class="btn btn-primary"value="Upload" />

</form>
<br>
<hr>

<h4>Rekap Total Absen Pegawai</h4>
					<br>

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
<input type="submit" class="btn btn-primary"value="Lihat Rekap" />

</form>
					
					<!-- <button id="editPegawai" type="button" class="btn btn-info" data-target="#myModal">Edit</button> -->
					
				</div>
			</div>

	

</body>
	<!-- Custom CSS & JS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css" type="text/css">
	<script src="<?php echo base_url(); ?>assets/js/user_rapat.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
		var tabel;
	</script>
	
	
	

</html>

