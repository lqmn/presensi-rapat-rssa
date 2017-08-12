<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Edit Non Pegawai</h4>
</div>

<div class="modal-body">
	<form id="formEdit"class="form-horizontal" action="">
		<div class="form-group">
			<label class="control-label col-sm-3" for="email">Nama:</label>
			<div class="col-sm-9">
			<input type="hidden" class="form-control" placeholder="Nomor pegawai" name="id" value="<?php echo $non->ID;?>" required>
				<input type="text" class="form-control" placeholder="Nomor pegawai" name="nama" value="<?php echo $non->NAMA;?>" required>
			</div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Institusi:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="nama" placeholder="Nama pegawai" value="<?php echo $non->INSTITUSI;?>" name="institusi" required>
			</div>
		</div> 
		
		
		
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button id="edit" type="submit" class="btn btn-primary">Submit</button>
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