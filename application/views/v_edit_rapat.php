<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form pegawai</h4>
</div>

<div class="modal-body">
	<form id="editForm" class="form-horizontal" action="">
		<div class="form-group">
			<label class="control-label col-sm-3" for="judul">Judul rapat:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" placeholder="Judul Rapat" name="judul" value="<?php echo $rapat->JUDUL_RAPAT ?>" required>
			</div>
		</div>

		<?php $waktu = explode(' ',$rapat->WAKTU_RAPAT);?>
		<div class="form-group">
			<label class="control-label col-sm-3" for="tanggal">Tanggal rapat:</label>
			<div class="col-sm-9">
				<input type='text' id='tanggal' class="form-control" name="tanggal" value="<?php echo $waktu[0] ?>" required>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-3" for="waktu">Waktu rapat:</label>
			<div class="col-sm-9">
				<input type='text' id='waktu' class="form-control" name="waktu" value="<?php echo $waktu[1] ?>" required>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >Ruang Rapat:</label>
			<div class="col-sm-9">
				<select class="selectpicker" data-live-search="true" name="ruang" required>
					<option disabled selected value="" style="display:none"> -- Pilih ruang rapat -- </option>
					<?php foreach ($ruang as $key => $value): ?>
						<option value="<?php echo $value->ID_RUANG ?>" data-tokens="<?php echo $value->NAMA_RUANG ?>" <?php if($rapat->ID_RUANG == $value->ID_RUANG){ echo 'selected';}?>><?php echo $value->NAMA_RUANG ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<input type="hidden" name="id" value="<?php echo $rapat->ID_RAPAT;?>" required>
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

	$('#tanggal').datetimepicker({
		format: 'DD/MM/YYYY',
		locale : 'id',
		// minDate: new Date(),
		showClose : true
	});

	$('#waktu').datetimepicker({
		format: 'HH:mm',
		locale : 'id',
		// minDate: new Date(),
		showClose : true
	});
</script>