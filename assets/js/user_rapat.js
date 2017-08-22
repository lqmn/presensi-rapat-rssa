$(document).ready(function() {
	// table
	var tabel = $('#tabel').DataTable({
			"dom": '<"toolbar">frtlp',
		"ajax": {
		
			"url": BASE_URL+"c_admin/get_table_rapat",
			"dataSrc": ""
		},
		"columns": [
		{ "data": "ID_RAPAT" },
		{ "data": "JUDUL_RAPAT" },
		{ "data": "WAKTU_RAPAT" },
		{ "data": "NAMA_RUANG" },
		{ "data": "NAMA_USER" },
		{ "data": "STATUS" },

		{ "data": "ID_RAPAT" }
		],'columnDefs':[{
			'targets': 6,

			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){

				return '<button type="button" class="editButton btn-xs btn-info pull-left" data-toggle="modal" data-target="#myModal" value="'+data+'"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="top" title="PICKLE RICK!"></span> Edit</button><br><br><a href="'+BASE_URL+'c_admin/lihatPeserta/'+data+'"><button type="button" class="lihatPesertaButton btn-xs btn-info pull-left" value="'+data+'">Lihat Peserta</button></a><br><br><a href="'+BASE_URL+'c_admin/peserta/'+data+'"><button type="button" class="pesertaButton btn-xs btn-info pull-left" value="'+data+'">Tambah Peserta</button></a>';

			}
		},{
			'targets': 0,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<input type="checkbox" class="select" value="' + data + '">';
			}
		}

		

		
		],"order": [],
		initComplete:function(){
			$('div.toolbar').html('<div style="float:left;"><button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah <span class="glyphicon glyphicon-plus"></span></button> <button id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
		}
	});

	$("#tabel").on('click','#select-all', function(){
		// var rows = tabel.table().node();
		// console.log(rows);
		var rows = tabel.rows().nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});

	$('#myModal').on('hidden.bs.modal', function() {
		tabel.ajax.reload();
	});

	// insert
	$(document).on('click','#tambah',function(event){
		
		var requrl = BASE_URL+'c_admin/form_rapat';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#insertRapat', function(){
		$('#insertRapat').button('loading');
		
		var requrl = BASE_URL+'c_admin/insert_rapat/';
		var data = {};

		$('#modalContent').find('[name]').each(function(index, value){
			var name = $(this).attr('name');
			var value = $(this).val();
			data[name] = value;
		});
		console.log(data);
		
		$.ajax({
			url:requrl,
			type:'post',
			data:data,
			success: function(data){
				$('#modalContent').html(data);
			}
		});
	});

	// edit
	$(document).on('click','.editButton',function(event){
		var data = $(this).val();
		// console.log(data);
		var requrl = BASE_URL+'c_admin/edit_form_rapat';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#updateRapat', function(){
		$('#updateRapat').button('loading');
		var requrl = BASE_URL+'c_admin/update_rapat/';
		var data = {};

		$('#modalContent').find('[name]').each(function(index, value){
			var name = $(this).attr('name');
			var value = $(this).val();
			data[name] = value;
		});

		$.ajax({
			url:requrl,
			type:'post',
			data:data,
			success: function(data){
				$('#modalContent').html(data);
			}
		});
	});

	// delete
	$(document).on('click','#hapus',function(event){
		var requrl = BASE_URL+'c_admin/form_delete_rapat';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#accVerif', function(){
		var dataRapat = $(this).val();
		var requrl = BASE_URL+'c_admin/verifikasi_rapat/'+dataRapat;
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	});
		$('#tabel').on('change','input:checkbox',function(){
		var selected = 0;
		$('.select:checked').each(function() {
			selected++;
		});
		if (selected>0) {
			$('#hapus').prop('disabled',false);
		}else{
			$('#hapus').prop('disabled',true);
		}
	})

	setInterval(function() {
		tabel.ajax.reload();
	}, 300000 );
});

$(document).on('click','#verif',function(event){
		
		var requrl = BASE_URL+'c_admin/form_verif';
		var data=$(this).val();
		$.ajax({
			url:requrl,
			type:'post',
			data:{"id_rapat" : data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})
	
	// $.ajax({
			// url:requrl,
			// type:'post',
			// data: {"array_del": selected} ,
			// success:function(data){
				// $('#modalContent').html(data);
			// }
		// });
	
	


$(document).on('change','#page',function(){
		var x = $('#page').val();
		console.log(x);
		switch(parseInt(x)){
			case 1:
			window.location.href =  BASE_URL+'c_admin/rapat';
			break;
			case 2:	
			window.location.href =  BASE_URL+'c_admin/all_rapat_ver';
			break;
			default:
		}
	});