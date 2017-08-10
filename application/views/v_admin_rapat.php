

			<div class="col-sm-9" style="margin-left:25%">
				<div class="well">
					<div width=100% style="float:right;">
						
					</div><h4>Rapat</h4>
					<br>
					<table id="tabel" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr><th><input id="select-all" type="checkbox" /></th>
								<th>Waktu Rapat</th>
								<th>Nama Ruang</th>
								<th>User Pembuat</th>
								<th>Status</th>
								<th>Lihat Peserta</th>
								<th>Panel</th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php foreach ($dataPegawai as $key => $value): ?>
								<tr>
									<td><?php echo $value->ID_PEGAWAI; ?></td>
									<td><?php echo $value->NIP; ?></td>
									<td><?php echo $value->NAMA; ?></td>
									<td><?php echo $value->ID_SATKER; ?></td>
									<td><?php echo $value->STATUS; ?></td>
								</tr>
							<?php endforeach ?> -->
						</tbody>
					</table>
					<button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah</button>
					<!-- <button id="editPegawai" type="button" class="btn btn-info" data-target="#myModal">Edit</button> -->
					<button id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button>
				</div>
			</div>

	

</body>
	<!-- Custom CSS & JS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css" type="text/css">
	<script src="<?php echo base_url(); ?>assets/js/admin_rapat.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
		var tabel;
	</script>
	
	
	

</html>

