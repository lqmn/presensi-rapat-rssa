<table id="tablePegawai" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>NIP</th>
			<th>Nama</th>
			<th>Satker</th>
			<th>Status</th>
			<th>Panel</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($dataPegawai as $key => $value): ?>
			<tr>
				<td><?php echo $value->NIP; ?></td>
				<td><?php echo $value->NAMA; ?></td>
				<td><?php echo $value->ID_SATKER; ?></td>
				<td><?php echo $value->STATUS; ?></td>
				
			</tr>
		<?php endforeach ?>
	</tbody>
</table>