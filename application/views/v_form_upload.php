<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form upload</h4>
</div>

<div class="modal-body">
	<form id="fileForm" class="form-inline" action="" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-center">
					<input class="btn" type="file" accept=".xls,.xlsx" name="excel" id="inputExcel" required>
				</div>

				<div class="pull-right">
					<div class="form-group text-center">
						<select class="selectpicker" data-live-search="true" name="satker" required>
							<option disabled selected value="" style="display:none"> -- Pilih satuan kerja -- </option>
							<?php foreach ($satker as $key => $value): ?>
								<option value="<?php echo $value->ID_SATKER?>" data-tokens="<?php echo $value->NAMA_SATKER?>"><?php echo $value->NAMA_SATKER?></option>
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
</div>
<div class="modal-footer">
	<button id="save" type="button" class="btn btn-primary" disabled>Save</button>
</div>
<script type="text/javascript">
	$('.selectpicker').selectpicker('refresh');
</script>