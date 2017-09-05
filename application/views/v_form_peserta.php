<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Peserta</h4>
</div>

<div class="modal-body">

	<div id="pesertaButtonGroup" class="btn-group btn-group-justified" data-toggle="buttons">
		<label class="btn btn-default active">
			<input type="radio" name="options" id="list" autocomplete="off" checked> List peserta
		</label>
		<label class="btn btn-default">
			<input type="radio" name="options" id="addPegawai" autocomplete="off"> Tambah pegawai
		</label>
		<label class="btn btn-default">
			<input type="radio" name="options" id="addNon" autocomplete="off"> Tambah non pegawai
		</label>
	</div><br>

	<table id="listPeserta" class="table" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="center col-xs-1"><input id="all-peserta" type="checkbox"/></th>
				<th>Nama</th>
				<th>Institusi</th>
			</tr>
		</thead>
	</table>
	<div id="form">
		<h4>Non Pegawai Baru</h4>
		<form id="nonForm" class="form-horizontal" action="">
			<div class="form-group">
				<label class="control-label col-sm-3" for="tanggal">Nama:</label>
				<div class="col-sm-9">
					<input type='text' class="form-control" name="nama" required>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-3" for="ket">Institusi:</label>
				<div class="col-sm-9">
					<input type='text' class="form-control" name="institusi">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button id="insertNon" type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- <div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div> -->
<script type="text/javascript">

</script>