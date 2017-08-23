$(document).ready(function() {
	// table
	// alert('awdojawod');
	var id_rapat;
	var tabelPeserta;
	var tabel = $('#tabel').DataTable({
		"dom": '<"toolbar">frtlp',
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
				return '<div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Aksi <span class="caret"></span></button><ul class="dropdown-menu"><li class="editButton" data-toggle="modal" data-target="#myModal" value="'+data+'"><a href="#">Edit</a></li><li class="peserta" data-toggle="modal" data-target="#bigModal" value="'+data+'"><a href="#">Lihat peserta</a></li><li class="verif" data-toggle="modal" data-target="#myModal" value="'+data+'"><a href="#">Verifikasi</a></li></ul></div>';
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
			$('div.toolbar').html('<div style="float:left;"><button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah <span class="glyphicon glyphicon-plus"></span></button> <button id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div><div class="wow pull-right">&nbsp;</div>');

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

	// delete
	$(document).on('click','#hapus',function(event){
		var requrl = BASE_URL+'c_rapat/form_delete_rapat';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#delete', function(){
		$('#delete').button('loading');

		var checked = [];
		$("input:checked", tabel.rows().nodes()).each(function(){
			checked.push($(this).val());
		});
		console.log(checked);
		var requrl = BASE_URL+'c_rapat/delete_rapat';

		$.ajax({
			url:requrl,
			type:'post',
			data: {"array_del": checked} ,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	});

	// peserta
	// $(document).on('click','.peserta',function(event){
	// 	id_rapat = $(this).val();
	// 	// console.log(data);
	// 	var requrl = BASE_URL+'c_rapat/form_peserta';
		
	// 	$.ajax({
	// 		url:requrl,
	// 		type:'post',
	// 		data:{'id_edit':id_rapat},
	// 		success:function(data){
	// 			$('#bigModalContent').html(data);

	// 			tabelPeserta = $('#listPeserta').DataTable({
	// 				"dom": '<"pesertaBar">frtlp',
	// 				"ajax": {
	// 					"url": BASE_URL+"c_rapat/get_table_peserta",
	// 					type : 'POST',
	// 					"data":{'id_edit':id_rapat},
	// 					"dataSrc": ""
	// 				},
	// 				"columns": [
	// 				{ "data": "ID" },
	// 				{ "data": "NAMA" },
	// 				{ "data": "INSTITUSI" },
	// 				{ "data": "PEGAWAI" }
	// 				],'columnDefs':[{
	// 					'targets': 0,
	// 					'searchable':false,
	// 					'orderable':false,
	// 					'className': 'dt-body-center',
	// 					'render': function (data){
	// 						return '<input type="checkbox" class="select-peserta" value="' + data + '">';
	// 					}
	// 				}],"order": [],
	// 				initComplete:function(){
	// 					$('div.pesertaBar').html('<div style="float:left;"><button id="hapusPeserta" type="button" class="btn btn-danger buttonPeserta" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
	// 				}
	// 			});
	// 		}
	// 	});
	// })

	// // handle check box each page
	// $(document).on( 'draw.dt','#listPeserta',  function () {
	// 	if ($('.select-peserta:checked').length == $('.select-peserta').length) {
	// 		$('#all-peserta').prop('checked', true);
	// 	}else{
	// 		$('#all-peserta').prop('checked', false);
	// 	}
	// })

	// $(document).on('change','#listPeserta input:checkbox',function(){
	// 	// console.log(tabel);
	// 	if ($('.select-peserta:checked').length == $('.select-peserta').length) {
	// 		$('#all-peserta').prop('checked', true);
	// 	}else{
	// 		$('#all-peserta').prop('checked', false);
	// 	}

	// 	// handle delete button
	// 	var hitung = 0;
	// 	$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
	// 		hitung++;
	// 	});

	// 	if (hitung>0) {
	// 		$('.buttonPeserta').prop('disabled',false);
	// 	}else{
	// 		$('.buttonPeserta').prop('disabled',true);
	// 	}
	// 	// console.log(hitung);
	// });

	// $(document).on('click','#all-peserta', function(){

	// 	var rows = tabelPeserta.rows({ page: 'current' }).nodes();
	// 	$('input[type="checkbox"]', rows).prop('checked', this.checked);
	// 	// console.log(rows);
	// });

	// $(document).on('change','#pesertaButtonGroup input:radio', function(){
	// 	if ($('#list').is(':checked')) {

	// 		tabelPeserta.destroy();
	// 		tabelPeserta = $('#listPeserta').DataTable({
	// 			"dom": '<"pesertaBar">frtlp',
	// 			"ajax": {
	// 				"url": BASE_URL+"c_rapat/get_table_peserta",
	// 				type : 'POST',
	// 				"data":{'id_edit':id_rapat},
	// 				"dataSrc": ""
	// 			},
	// 			"columns": [
	// 			{ "data": "ID" },
	// 			{ "data": "NAMA" },
	// 			{ "data": "INSTITUSI" },
	// 			{ "data": "PEGAWAI" }
	// 			],'columnDefs':[{
	// 				'targets': 0,
	// 				'searchable':false,
	// 				'orderable':false,
	// 				'className': 'dt-body-center',
	// 				'render': function (data){
	// 					return '<input type="checkbox" class="select-peserta" value="' + data + '">';
	// 				}
	// 			}],"order": [],
	// 			initComplete:function(){
	// 				$('div.pesertaBar').html('<div style="float:left;"><button id="hapusPeserta" type="button" class="btn btn-danger buttonPeserta" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
	// 			}
	// 		});

	// 	}else if ($('#addPegawai').is(':checked')) {

	// 		tabelPeserta.destroy();
	// 		tabelPeserta = $('#listPeserta').DataTable({
	// 			"dom": '<"pesertaBar">frtlp',
	// 			"ajax": {
	// 				"url": BASE_URL+"c_rapat/get_table_all_peserta_pegawai",
	// 				type : 'POST',
	// 				"data":{'id_edit':id_rapat},
	// 				"dataSrc": ""
	// 			},
	// 			"columns": [
	// 			{ "data": "ID" },
	// 			{ "data": "NAMA" },
	// 			{ "data": "INSTITUSI" },
	// 			{ "data": "PEGAWAI" }
	// 			],'columnDefs':[{
	// 				'targets': 0,
	// 				'searchable':false,
	// 				'orderable':false,
	// 				'className': 'dt-body-center',
	// 				'render': function (data){
	// 					return '<input type="checkbox" class="select-peserta" value="' + data + '">';
	// 				}
	// 			}],"order": [],
	// 			initComplete:function(){
	// 				$('div.pesertaBar').html('<div style="float:left;"><button id="tambahPesertaPegawai" type="button" class="btn btn-primary buttonPeserta" disabled>Tambah <span class="glyphicon glyphicon-plus"></span></button></div>');
	// 			}
	// 		});

	// 	}else if ($('#addNon').is(':checked')) {

	// 		tabelPeserta.destroy();
	// 		tabelPeserta = $('#listPeserta').DataTable({
	// 			"dom": '<"pesertaBar">frtlp',
	// 			"ajax": {
	// 				"url": BASE_URL+"c_rapat/get_table_all_peserta_non",
	// 				type : 'POST',
	// 				"data":{'id_edit':id_rapat},
	// 				"dataSrc": ""
	// 			},
	// 			"columns": [
	// 			{ "data": "ID" },
	// 			{ "data": "NAMA" },
	// 			{ "data": "INSTITUSI" },
	// 			{ "data": "PEGAWAI" }
	// 			],'columnDefs':[{
	// 				'targets': 0,
	// 				'searchable':false,
	// 				'orderable':false,
	// 				'className': 'dt-body-center',
	// 				'render': function (data){
	// 					return '<input type="checkbox" class="select-peserta" value="' + data + '">';
	// 				}
	// 			}],"order": [],
	// 			initComplete:function(){
	// 				$('div.pesertaBar').html('<div style="float:left;"><button id="tambahPesertaNon" type="button" class="btn btn-primary buttonPeserta" disabled>Tambah <span class="glyphicon glyphicon-plus"></span></button></div>');
	// 			}
	// 		});

	// 	}
	// })

	// $('#bigModalContent').on('click','#hapusPeserta', function(){
	// 	$('.buttonPeserta').button('loading');

	// 	var checked = [];
	// 	$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
	// 		checked.push($(this).val());
	// 	});
	// 	console.log(checked);
	// 	var requrl = BASE_URL+'c_rapat/delete_peserta';

	// 	$.ajax({
	// 		url:requrl,
	// 		type:'post',
	// 		data: {"array_del": checked} ,
	// 		success:function(data){
	// 			tabelPeserta.ajax.reload();
	// 			$('.buttonPeserta').button('reset');
	// 			setTimeout(function () {
	// 				$('.buttonPeserta').prop("disabled", true);
	// 			}, 0);
	// 		}
	// 	});
	// });

	// $('#bigModalContent').on('click','#tambahPesertaPegawai', function(){
	// 	$('.buttonPeserta').button('loading');

	// 	var checked = [];
	// 	$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
	// 		checked.push($(this).val());
	// 	});
	// 	console.log(checked);
	// 	var requrl = BASE_URL+'c_rapat/tambah_peserta_pegawai';

	// 	$.ajax({
	// 		url:requrl,
	// 		type:'post',
	// 		data: {'id_pegawai': checked,'id_rapat':id_rapat} ,
	// 		success:function(data){
	// 			tabelPeserta.ajax.reload();
	// 			$('.buttonPeserta').button('reset');
	// 			setTimeout(function () {
	// 				$('.buttonPeserta').prop("disabled", true);
	// 			}, 0);
	// 		}
	// 	});
	// });

	// $('#bigModalContent').on('click','#tambahPesertaNon', function(){
	// 	$('.buttonPeserta').button('loading');

	// 	var checked = [];
	// 	$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
	// 		checked.push($(this).val());
	// 	});
	// 	console.log(checked);
	// 	var requrl = BASE_URL+'c_rapat/tambah_peserta_non';

	// 	$.ajax({
	// 		url:requrl,
	// 		type:'post',
	// 		data: {'id_non': checked,'id_rapat':id_rapat} ,
	// 		success:function(data){
	// 			tabelPeserta.ajax.reload();
	// 			$('.buttonPeserta').button('reset');
	// 			setTimeout(function () {
	// 				$('.buttonPeserta').prop("disabled", true);
	// 			}, 0);
	// 		}
	// 	});
	// });

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