<div class="col-sm-12">

	<div class="col-sm-12 well" >
		<h4><?php echo $rapat->JUDUL_RAPAT;?></h4>

		<table id="tabel<?php echo $rapat->ID_RAPAT;?>" class="table table-striped table-bordered">
			<thead> 
				<tr>
					<th>Waktu Rapat</th>
					<th>Ruang Rapat</th>
					<!--<th>Nama</th>-->
					<th>Nama Peserta</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo @$rapat->WAKTU_RAPAT;?> </td>
					<!-- <td><?php echo @$rapat->NAMA_RUANG;?> </td> -->
					<td><?php echo @$rapat->JUDUL_RAPAT;?> </td>
					<td>
						<?php 
						foreach((array)$peserta as $key2 =>$peserta){ 
							if($rapat->ID_RAPAT== $peserta->ID_RAPAT){ 
								echo @$peserta->NAMA."<br>";
							} 
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


