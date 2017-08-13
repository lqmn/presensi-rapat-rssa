
<div class="col-sm-12" style="background-color:;">
<div class="col-sm-1" > 
</div>
<div class="col-sm-4" style="background-color:;">
<input type="hidden" class="id_rapat" name="id" value="<?php echo $rapat->JUDUL_RAPAT;?>">
					<h4>Judul Rapat : <?php echo $rapat->JUDUL_RAPAT;?></h4>
					<h4>Tanggal Rapat :<?php $d = date_parse_from_format("Y-m-d", $rapat->WAKTU_RAPAT); 
					$tanggal;
					echo " ".$d["day"]." ";
					if($d["month"]==1){
						echo 'Januari';
					}
					
					else if ($d["month"]==2){
						echo 'Februari';
					}
					else if ($d["month"]==3){
						echo 'Maret';
					}
					else if ($d["month"]==4){
						echo 'April';
					}
					else if ($d["month"]==5){
						echo 'Mei';
					}
					else if ($d["month"]=6){
						echo 'Juni';
					}
					else if ($d["month"]==7){
						echo 'Juli';
					}
					else if ($d["month"]==8){
						echo 'Agustus';
					}
					else if ($d["month"]==9){
						echo 'September';
					}
					else if ($d["month"]==10){
						echo 'Oktober';
					}
					else if ($d["month"]==11){
						echo 'November';
					}
					else if ($d["month"]==12){
						echo 'Desember';
					}
					echo " ".$d["year"]." ";
					
				
					
					
					
					
					?> </h5>
					<h4>Waktu Rapat :<?php $date = strtotime($rapat->WAKTU_RAPAT);
					echo " ".date('H:i', $date);
					 ?></h4>
					 
					 <h4>Lokasi Rapat : Ruang <?php echo " ".$rapat->NAMA_RUANG;?></h4>
					<br>
					
					
					<br>
</div>


<div class="col-sm-6" >
			
				<div class="well">
					
					
					
					<h4>Peserta rapat</h4>
					
					<table id="tabel<?php echo $rapat->ID_RAPAT;?> " class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead> 

							<tr>
						
							    <th>Nama</th>
								<th>SATKER</th>
								<th>ASAL</th>
								
							</tr>
						</thead>
						<tbody>
							
								
								<?php  foreach($peserta as $key2 =>$peserta){ ?>
							<?php if($rapat->ID_RAPAT== $peserta->ID_RAPAT){ ?>
								<tr>
									<td><?php echo $peserta->NAMA; ?></td>
									<td><?php echo $peserta->SATKER; ?></td>
									<td><?php echo $peserta->ASAL; ?></td>
								
								</tr>
								
							<?php } ?>
					<?php } ?>
						</tbody>
					</table>
					
					
					
					<!-- <button id="editPegawai" type="button" class="btn btn-info" data-target="#myModal">Edit</button> -->
					
					
				</div>
				
				</div>
			<hr>	
	</div>


