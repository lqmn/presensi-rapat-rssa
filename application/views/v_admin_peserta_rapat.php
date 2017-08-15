

			<div class="col-sm-9" style="margin-left:25%">
			<h4>Tambah Peserta Rapat</h4>
				<div class="well">
					
					<input type="hidden" class="id_rapat" name="id" value="<?php echo $rapat->ID_RAPAT ;?>">
					<h4>Nama Rapat : <?php echo $rapat->JUDUL_RAPAT;?></h4>
					<br>
					<h6> Ceklis nama yang ingin ditambahkan ke daftar rapat, lalu klik tombol tambah.</h6>
					
					<br>
					<table id="tabel" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr><th><input id="select-all" type="checkbox" /></th>
							    <th>Nama</th>
								<th>SATKER</th>
								<th>ASAL</th>
								
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
					
					<!-- <button id="editPegawai" type="button" class="btn btn-info" data-target="#myModal">Edit</button> -->
					<br>
					<br>
					<h4>Daftar Peserta Rapat</h4>
					<br>
					<table id="tabel2" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr><th><input id="select-all" type="checkbox" /></th>
							    <th>Nama</th>
								<th>SATKER</th>
								<th>ASAL</th>
								
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
					<br>
					<a href="<?php echo base_url();?>c_admin/rapat"<button id="tambah" type="button" class="btn btn-danger pull-right" >Selesai</button></a>
					<!-- <button id="editPegawai" type="button" class="btn btn-info" data-target="#myModal">Edit</button> -->
					<br>
					
				</div>
				
	

</body>
	<!-- Custom CSS & JS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css" type="text/css">
	<script src="<?php echo base_url(); ?>assets/js/admin_peserta.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
		var tabel;
	</script>
	
	
	

</html>

