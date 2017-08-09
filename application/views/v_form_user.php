<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form User</h4>
</div>

<div class="modal-body">
	<form id="formModal"class="form-horizontal" action="">
	
		<div class="form-group">
			<label class="control-label col-sm-3" for="email">Nomor pegawai:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" placeholder="Nomor pegawai" name="nip" required>
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Nama pegawai:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="nama" placeholder="Nama pegawai" name="nama" required>
			</div>
		</div> -->
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Password:</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="nama" placeholder="password" name="password" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Otoritas:</label>
			<div class="col-sm-9">
				<select class="selectpicker"  name="otoritas">
						<option value="1" >Administrator</option>
						<option value="2" >Verifikator</option>
						<option value="3" >User Biasa </option>
					        
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button id="insert" type="button" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
</div>
<script type="text/javascript">
	$('.selectpicker').selectpicker('refresh');
</script>