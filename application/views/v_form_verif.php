<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Konfirmasi Rapat  : <?php echo $tanggal_lengkap;?></h4>
</div>

<div class="modal-body">
	<h4>Rapat pada tanggal : <?php echo $tanggal;?></h4>
	<table id="tabel" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Judul Rapat</th>
				<th>Waktu Rapat</th>
				<th>Nama Ruang</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($waktu as $key => $value): ?>
				<tr>
					<td><?php echo $value->JUDUL_RAPAT; ?></td>
					<td><?php echo $value->WAKTU_RAPAT; ?></td>
					<td><?php echo $value->NAMA_RUANG; ?></td>

				</tr>
			<?php endforeach ?> 
		</tbody>
	</table>
</div>

<div class="modal-footer">
	<button id="accVerif" type="submit" class="btn btn-success" value=<?php echo $id;?>>Verifikasi</button>
	<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
</div>