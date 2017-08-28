<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Peserta</h4>
</div>
<div class="modal-body">

	<table id="tabelLibur" class="table">
		<thead>
			<tr>
				<th><input id="all-libur" type="checkbox"></th>
				<th>Tanggal</th>
				<th>Keterangan</th>
			</tr>
		</thead>
	</table>


	<form id="liburForm" class="form-horizontal" action="">
		<div class="form-group">
			<label class="control-label col-sm-3" for="tanggal">Tanggal libur:</label>
			<div class="col-sm-9">
				<input type='text' id='tanggal' class="form-control" name="tanggal" required>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-3" for="ket">Keterangan:</label>
			<div class="col-sm-9">
				<input type='text' class="form-control" name="ket">
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
	$('#tanggal').datetimepicker({
		format: 'DD/MM/YYYY',
		locale : 'id',
		showClose : true
	});


</script>