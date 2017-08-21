

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

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" class="btn btn-primary"value="Upload" />

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

