

		
				

				<tbody>

					<tr>
						<?php foreach($absen as $key =>$value){ ?>
						<?php IF($value->NAMA==""){ echo "";}
else { 
						?>
						<td><?php echo $value->NAMA ;?></td>
						<td><?php echo $value->ID_PEGAWAI ;?></td>
						<td><?php echo $value->TOTAL_ABSEN ;?></td>
					
						<?php }}?>
					
						
					
					</tr>
				</tbody>
					
	


