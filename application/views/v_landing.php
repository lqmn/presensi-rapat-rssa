
<div class="col-sm-12" style="margin-right:10% margin-left:10%">
			
				<div class="well">
					
					
					
					
					<input type="hidden" class="id_rapat" name="id" value="<?php echo $rapat->JUDUL_RAPAT;?>">
					<h4>Nama Rapat : <?php echo $rapat->JUDUL_RAPAT;?></h4>
					<h5>Daftar peserta : </h5>
					
					<br>
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
				
	



