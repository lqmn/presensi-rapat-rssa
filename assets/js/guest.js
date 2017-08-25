function showPeserta(id_rapat, dt) {
	var html = '<div class="well"><h4>Peserta</h4> <table class="table"><tr><th>Nama</th><th>INSTITUSI</th><th>Pegawai</th></tr>';
	var requrl =  BASE_URL+'c_rapat/guest_data_peserta/'+id_rapat+'/';
	$.ajax({
		url:requrl,
		success:function(data){
			var databaru = JSON.parse(data);
			$.each( databaru, function( key, val ) {
				html= html+'<tr><td>'+val['NAMA']+'</td><td>'+val['INSTITUSI']+'</td><td>'+val['PEGAWAI']+'</td></tr>';
			});
			html = html+'</table></div>';
			dt.child(html).show();

		}
	});
	return html;
}

function updateClock (){
	var currentTime = new Date ();
	// console.log(currentTime);
	$("#clock").html(currentTime);
}
$(document).ready(function(){
	$('#jadwal-nav').addClass("active");

	tabelGuest = $('#tabelGuest').DataTable({
		'dom' : '<"#toolbar.pull-left">p<"row"<"col-sm-12"tr>>',
		"pageLength": 1,
		'ajax' : {
			'url': BASE_URL+'c_rapat/guest_data_rapat',
			'dataSrc': ''
		}, 'columns' : [
		{
			"className":'details-control',
			"orderable":false,
			"data":null,
			"defaultContent": '',
			"visible":false
		},
		{ "data": "WAKTU_RAPAT" },
		{ "data": "NAMA_RUANG" },
		{ "data": "JUDUL_RAPAT" }
		],initComplete:function(){
			$('#tabelGuest').DataTable().rows().every(function(){
				var id_rapat = this.data()['ID_RAPAT'];
				showPeserta(id_rapat,this);
			});
			$('#toolbar').html('<h3>Jadwal rapat</h3><p id="clock"></p>');
		}
	});

	setInterval(function(){
		if (tabelGuest.page.info().end==tabelGuest.page.info().pages) {
			tabelGuest.page('first').draw('page');
		}else{
			tabelGuest.page('next').draw('page');
		}
	}, 8000);


	setInterval('updateClock()', 1000);
})