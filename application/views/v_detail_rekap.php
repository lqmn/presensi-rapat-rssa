<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Peserta</h4>
</div>

<div class="modal-body">

	<table id="listPresensi" class="table" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="hidden">ID</th>
				<th class="hidden">Hitung</th>
				<th>Tanggal</th>
				<th>Lembur</th>
				<th>Hitung Lembur?</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($presensi as $key => $value): ?>
				<tr>
					<td class="hidden"><?php echo $value->ID_PRESENSI; ?></td>
					<td class="hidden hitungVal"><?php echo $value->HITUNG; ?></td>
					<td><?php echo $value->TANGGAL; ?></td>
					<td><?php echo $value->LEMBUR; ?></td>
					<td><input class="hitung" type="checkbox"></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<div id="result"></div>
	<button id="saveDetail" type="button" class="btn btn-primary">Save</button>
</div>

<!-- <div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div> -->
<script type="text/javascript">

</script>