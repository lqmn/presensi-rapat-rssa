<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form pegawai</h4>
</div>

<div class="modal-body">
	<form id="editForm"class="form-horizontal" action="">

		<div class="form-group">
			<label class="control-label col-sm-3" for="email">Nomor pegawai:</label>
			<div class="col-sm-9">
				<input type="hidden" name="id" value="<?php echo $pegawai->ID_PEGAWAI;?>" required>
				<input type="text" class="form-control" placeholder="Nomor pegawai" name="nomor" value="<?php echo $pegawai->NIP; ?>" required>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Nama pegawai:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="nama" placeholder="Nama pegawai" name="nama" value="<?php echo $pegawai->NAMA; ?>" required>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Satuan kerja:</label>
			<div class="col-sm-9">
				<select class="selectpicker" data-live-search="true" name="satker">

					<?php foreach ($satker as $key => $value): ?>
						<option value="<?php echo $value->ID_SATKER?>" data-tokens="<?php echo $value->NAMA_SATKER?>"
							<?php if ($pegawai->ID_SATKER==($value->ID_SATKER)): ?>
								<?php echo 'selected';?>
							<?php endif ?>><?php echo $value->NAMA_SATKER?>
						</option>
					<?php endforeach ?>

				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button id="edit" type="submit" class="btn btn-primary">Submit</button>
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