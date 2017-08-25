$(document).ready(function() {
	// table
	// alert('awdojawod');
	var id_rapat;
	var tabelPeserta;
	var tabel = $('#tabel').DataTable({
		"dom": "<'toolbar'>f" +
"<'row'<'col-sm-12'tr>>" +
"<'row'<'col-sm-5'l><'col-sm-7'p>>",
		"ajax": {
			"url": BASE_URL+"c_rapat/get_table_rapat",
			"dataSrc": ""
		},
		"columns": [
		{ "data": "ID_RAPAT" },
		{ "data": "JUDUL_RAPAT" },
		{ "data": "WAKTU_RAPAT" },
		{ "data": "NAMA_RUANG" },
		{ "data": "STATUS_AKTIVASI" },
		{ "data": "PEMBUAT" },
		{ "data": "ID_RAPAT" }
		],'columnDefs':[{
			'targets': 6,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<div class="dropdown"><button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Aksi <span class="caret"></span></button><ul class="dropdown-menu"><li class="editButton" data-toggle="modal" data-target="#myModal" value="'+data+'"><a href="#">Edit</a></li><li class="peserta" data-toggle="modal" data-target="#bigModal" value="'+data+'"><a href="#">Lihat peserta</a></li><li class="verif" data-toggle="modal" data-target="#myModal" value="'+data+'"><a href="#">Verifikasi</a></li></ul></div>';
			}
		},{
			'targets': 0,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<input type="checkbox" class="select" value="' + data + '">';
			}
		}],"order": [],
		initComplete:function(){
			$('div.toolbar').html('<div style="float:left;"><button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah <span class="glyphicon glyphicon-plus"></span></button></div><div class="wow pull-right">&nbsp;</div>');

			var column = this.api().column(4);
			var select = $('<select class="form-control"><option value="">Semua Rapat</option></select>')
			.appendTo( $('.wow')).on('change', function(){
				var val = $.fn.dataTable.util.escapeRegex($(this).val());
				console.log(val);
				column.search( val ? '^'+val+'$' : '', true, false ).draw();
			});

			column.data().unique().sort().each( function ( d, j ) {
				select.append( '<option value="'+d+'">'+d+'</option>' )
			});

		}
	});


	// insert
	$(document).on('click','#tambah',function(event){
		var requrl = BASE_URL+'c_rapat/form_rapat';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('submit','#insertForm', function(e){
		$('#insert').button('loading');
		var requrl = BASE_URL+'c_rapat/insert_rapat/';
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
		return false;
	});

	// edit
	$(document).on('click','.editButton',function(event){
		var data = $(this).val();
		console.log(data);
		var requrl = BASE_URL+'c_rapat/edit_form_rapat';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('submit','#editForm', function(){
		$('#edit').button('loading');
		var requrl = BASE_URL+'c_rapat/update_rapat/';
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
		return false;
	});

	// acc
	$(document).on('click','.verif',function(event){
		
		var requrl = BASE_URL+'c_rapat/form_verif';
		var data=$(this).val();
		$.ajax({
			url:requrl,
			type:'post',
			data:{"id_rapat" : data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	});

	$('#modalContent').on('click','#accVerif', function(){
		var dataRapat = $(this).val();
		var requrl = BASE_URL+'c_rapat/verifikasi_rapat/'+dataRapat;
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	});
});