<tbody>
					<?php	foreach($absen as $key =>$value){ ?>
						<?php if ($value->NAMA==""){break;}?><td><?php echo @$value->ID_PEGAWAI;?></td>
						<td><?php echo @$value->NAMA;?></td>
						<td><?php echo @$value->TOTAL_ABSEN;?></td>
						<?php }?>
					</tbody>