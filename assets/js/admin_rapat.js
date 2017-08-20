$(document).ready(function() {
	// table
	// alert('awdojawod');
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
				return '<button type="button" class="editButton btn btn-info" data-toggle="modal" data-target="#myModal" value="'+data+'">Edit <span class="glyphicon glyphicon-edit"></span></button> <button type="button" class="peserta btn btn-info" data-toggle="modal" data-target="#bigModal" value="'+data+'">Peserta <span class="glyphicon glyphicon-edit"></span></button>';
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
			$('div.toolbar').html('<div style="float:left;"><button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah <span class="glyphicon glyphicon-plus"></span></button> <button id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
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
		var requrl = BASE_URL+'c_admin/form_delete_pegawai';
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
		var requrl = BASE_URL+'c_admin/delete_pegawai';

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
	$(document).on('click','.peserta',function(event){
		var id_edit = $(this).val();
		// console.log(data);
		var requrl = BASE_URL+'c_rapat/form_peserta';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':id_edit},
			success:function(data){
				$('#bigModalContent').html(data);

				$('#listPeserta').DataTable({
					"dom": '<"pesertaBar">frtlp',
					"ajax": {
						"url": BASE_URL+"c_rapat/get_table_peserta",
						type : 'POST',
						"data":{'id_edit':id_edit},
						"dataSrc": ""
					},
					"columns": [
					{ "data": "ID" },
					{ "data": "NAMA" },
					{ "data": "INSTITUSI" },
					{ "data": "PEGAWAI" }
					],'columnDefs':[{
						'targets': 0,
						'searchable':false,
						'orderable':false,
						'className': 'dt-body-center',
						'render': function (data){
							return '<input type="checkbox" class="select-peserta" value="' + data + '">';
						}
					}],"order": [],
					initComplete:function(){
						$('div.pesertaBar').html('<div style="float:left;"><button id="hapusPeserta" type="button" class="btn btn-danger" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
					}
				});
			}
		});

	})


	// handle check box each page
	$(document).on( 'draw.dt','#listPeserta',  function () {
		if ($('.select-peserta:checked').length == $('.select-peserta').length) {
			$('#all-peserta').prop('checked', true);
		}else{
			$('#all-peserta').prop('checked', false);
		}
	})

	$(document).on('change','#listPeserta input:checkbox',function(){
		// console.log(tabel);
		var tabelPeserta = $('#listPeserta').DataTable();
		if ($('.select-peserta:checked').length == $('.select-peserta').length) {
			$('#all-peserta').prop('checked', true);
		}else{
			$('#all-peserta').prop('checked', false);
		}

		// handle delete button
		var hitung = 0;
		$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
			hitung++;
		});

		if (hitung>0) {
			$('#hapusPeserta').prop('disabled',false);
		}else{
			$('#hapusPeserta').prop('disabled',true);
		}
		console.log(hitung);
	});

	$(document).on('click','#all-peserta', function(){
		var tabelPeserta = $('#listPeserta').DataTable();
		var rows = tabelPeserta.rows({ page: 'current' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
		// console.log(rows);
	});

	$(document).on('change','#pesertaButtonGroup input:radio', function(){
		if ($('#addPegawai').is(':checked')) {
			alert('awmdaodkao');
		}
	})

	$('#bigModalContent').on('click','#hapusPeserta', function(){
		var tabelPeserta = $('#listPeserta').DataTable();
		$('#hapusPeserta').button('loading');

		var checked = [];
		$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
			checked.push($(this).val());
		});
		console.log(checked);
		// var requrl = BASE_URL+'c_admin/delete_pegawai';

		// $.ajax({
		// 	url:requrl,
		// 	type:'post',
		// 	data: {"array_del": checked} ,
		// 	success:function(data){
		// 		$('#modalContent').html(data);
		// 	}
		// });
	});

});