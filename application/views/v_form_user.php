<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form User</h4>
</div>

<div class="modal-body">
	<form id="insertForm"class="form-horizontal" action="">

		<div class="form-group">
			<label class="control-label col-sm-3" for="email">Pegawai:</label>
			<div class="col-sm-9">
				<select class="selectpicker" data-live-search="true" name="pegawai" required>
					<option disabled selected value="" style="display:none"> -- Pilih pegawai -- </option>
					<?php foreach ($pegawai as $key => $value): ?>
						<option
						value="<?php echo $value->ID_PEGAWAI?>"
						data-tokens="<?php echo $value->NIP.' '.$value->NAMA.' '.$value->NAMA_SATKER?>">
						<?php echo $value->NIP.', '.$value->NAMA.', '.$value->NAMA_SATKER?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Password:</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="nama" placeholder="password" name="password" minlength=5 required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Otoritas:</label>
			<div class="col-sm-9">
				<select class="selectpicker"  name="otoritas" required>
					<option disabled selected value="" style="display:none"> -- Pilih otoritas -- </option>
					<option value="1" >Administrator</option>
					<option value="2" >Verifikator</option>
					<option value="3" >User Biasa </option>

				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button id="insert" type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</form>
</div>
<!-- <div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div> -->
<script type="text/javascript">
	$('.selectpicker').selectpicker('refresh');
</script>