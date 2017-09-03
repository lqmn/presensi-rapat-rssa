<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Hari Libur</h4>
</div>

<div class="modal-body">

	<button class="btn btn-success" id="tambahLibur"style="margin-bottom:25px">Tambah Hari Libur</button>
	<button class="btn btn-danger"id="hapus"style="margin-bottom:25px">Hapus</button>

<table class="table table-striped table-bordered" id="tableLibur"> 

<thead>
	<tr>
<th ></th>
<th>Tanggal</th>
</tr>
</thead>

<tbody>
	<div id="contentConfirm">

	</div>

<?php echo "<br><h4>".@$pesan."</h4>";?>
	<?php foreach($libur as $key =>$value){?>
	<tr>
	<td><input class="hitung" type="checkbox" value=<?php echo $value->ID_HARI_LIBUR;?> ></input></td>
<td><?php $date = date_create_from_format('Y-m-d',$value->TANGGAL );
$bulan=" ";
if($date->format('m')=='01'){
	$bulan="Januari";
	

}
else if($date->format('m')=='02'){
$bulan="Februari";
	
}
else if($date->format('m')=='03'){
$bulan="Maret";
	
}
else if($date->format('m')=='04'){
$bulan="April";
	
}
else if($date->format('m')=='05'){
$bulan="Mei";
	
}
else if($date->format('m')=='06'){
$bulan="Juni";

}
else if($date->format('m')=='07'){
	$bulan="Juli";
}
else if($date->format('m')=='08'){
$bulan="Agustus";
	
}
else if($date->format('m')=='09'){
$bulan="September";


}
else if($date->format('m')=='10'){
	$bulan="Oktober";

}
else if($date->format('m')=='11'){
	$bulan="November";
	
}
else if($date->format('m')=='12'){
	
	$bulan="Desember";
}

echo $date->format('d')." ".$bulan." ".$date->format('Y');?></td>
</tr>
<?php }?>

	</tbody> 

	</table>
	<br>
	<div id="contentConfirm">

	</div>
</div>
<div class="modal-footer">
	<button id="save" type="button" class="btn btn-primary" disabled>Save</button>
</div>
<script type="text/javascript">
	$('.selectpicker').selectpicker('refresh');
</script>