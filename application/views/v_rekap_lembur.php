

		
				

				<tbody>

					<tr>
						<?php foreach($absen as $key =>$value){ ?>
						<td><?php echo $value->NAMA ;?></td>
						<td><?php echo $value->ID_USER ;?></td>
						<td><?php if($lembur<0){echo 0;}else echo $lembur ;?></td>
						<?php }?>

					
						
					
					</tr>
				</tbody>
					
	


