$(document).ready(function() {
	tabel = $("#tabel").DataTable();

	$(document).on('change','#page',function(){
		var x = $('#page').val();
		console.log(x);
		switch(parseInt(x)){
			case 1:
			window.location.href =  BASE_URL+'c_admin/pegawai';
			break;
			case 2:	
			window.location.href =  BASE_URL+'c_admin/user';
			break;
			case 3:	
			window.location.href =  BASE_URL+'c_admin/non_pegawai';
			break;
			default:
		}
	});

	setInterval(function() {
		tabel.ajax.reload();
		$('#hapus').prop('disabled',true);
	}, 300000 );
	
	$(document).on('change','#pageVer',function(){
		var x = $('#pageVer').val();
		console.log(x);
		switch(parseInt(x)){
			case 1:
			window.location.href =  BASE_URL+'c_admin/rapat';
			break;
			case 2:	
			window.location.href =  BASE_URL+'c_admin/rapat_verified';
			break;
			case 3:	
			window.location.href =  BASE_URL+'c_admin/all_rapat';
			break;
			default:
		}
	});
	
	// handle check box each page
	$('#tabel').on( 'draw.dt',  function () {
		if ($('.select:checked').length == $('.select').length) {
			$('#select-all').prop('checked', true);
		}else{
			$('#select-all').prop('checked', false);
		}
	})

	$('#tabel').on('change','input:checkbox',function(){
		// console.log(tabel);
		if ($('.select:checked').length == $('.select').length) {
			$('#select-all').prop('checked', true);
		}else{
			$('#select-all').prop('checked', false);
		}

		// handle delete button
		var hitung = 0;
		$("input:checked", tabel.rows().nodes()).each(function(){
			hitung++;
		});

		if (hitung>0) {
			$('#hapus').prop('disabled',false);
		}else{
			$('#hapus').prop('disabled',true);
		}
		// console.log(hitung);
	});

	$("#tabel").on('click','#select-all', function(){
		var rows = tabel.rows({ page: 'current' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
		// console.log(rows);
	});
	
	$('#myModal').on('hidden.bs.modal', function() {
		tabel.ajax.reload();
		$('#hapus').prop('disabled',true);
	});
});