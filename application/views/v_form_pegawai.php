<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form pegawai</h4>
</div>

<div class="modal-body">
	<form id="insertForm" class="form-horizontal" action="">
		<div class="form-group">
			<label class="control-label col-sm-3" for="email">Nomor pegawai:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" placeholder="Nomor pegawai" name="nomor" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Nama pegawai:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="nama" placeholder="Nama pegawai" name="nama" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Satuan kerja:</label>
			<div class="col-sm-9">

				<select class="selectpicker" data-live-search="true" name="satker" required>
					<option disabled selected value="" style="display:none"> -- Pilih satuan kerja -- </option>
					<?php foreach ($satker as $key => $value): ?>
						<option value="<?php echo $value->ID_SATKER?>" data-tokens="<?php echo $value->NAMA_SATKER?>"><?php echo $value->NAMA_SATKER?></option>
					<?php endforeach ?>
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