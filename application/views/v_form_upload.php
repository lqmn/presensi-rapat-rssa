<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form pegawai</h4>
</div>

<div class="modal-body">
	<form id="fileForm" class="form-inline" action="" enctype="multipart/form-data">
		<div class="row">
			<div class="form-group col-sm-4 text-center">

					<input class="btn" type="file" accept=".xls,.xlsx" name="excel" id="inputExcel" hidden>
			</div>

			<div class="form-group col-sm-4 text-center">
				<select class="selectpicker" data-live-search="true" name="satker" required>
					<option disabled selected value="" style="display:none"> -- Pilih satuan kerja -- </option>
					<?php foreach ($satker as $key => $value): ?>
						<option value="<?php echo $value->ID_SATKER?>" data-tokens="<?php echo $value->NAMA_SATKER?>"><?php echo $value->NAMA_SATKER?></option>
					<?php endforeach ?>
				</select>

			</div>
			<div class="form-group col-sm-4 text-center">
				<button id="uploadSubmit" type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</form>
	<div id="contentConfirm">
	
	</div>

	<table>
		
	</table>
</div>
<!-- <div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div> -->
<script type="text/javascript">
	$('.selectpicker').selectpicker('refresh');
</script>