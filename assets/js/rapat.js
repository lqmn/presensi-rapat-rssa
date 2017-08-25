$(document).ready(function() {
	$('#rapat-nav').addClass("active");
	tabel = $("#tabel").DataTable();
	var id_rapat;
	var tabelPeserta;

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

	// peserta
	$(document).on('click','.peserta',function(event){
		id_rapat = $(this).val();
		// console.log(data);
		var requrl = BASE_URL+'c_rapat/form_peserta';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':id_rapat},
			success:function(data){
				$('#bigModalContent').html(data);

				tabelPeserta = $('#listPeserta').DataTable({
					"dom": '<"pesertaBar">frtlp',
					"ajax": {
						"url": BASE_URL+"c_rapat/get_table_peserta",
						type : 'POST',
						"data":{'id_edit':id_rapat},
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
						$('div.pesertaBar').html('<div style="float:left;"><button id="hapusPeserta" type="button" class="btn btn-danger buttonPeserta" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
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
			$('.buttonPeserta').prop('disabled',false);
		}else{
			$('.buttonPeserta').prop('disabled',true);
		}
		// console.log(hitung);
	});

	$(document).on('click','#all-peserta', function(){

		var rows = tabelPeserta.rows({ page: 'current' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
		// console.log(rows);
	});

	$(document).on('change','#pesertaButtonGroup input:radio', function(){
		if ($('#list').is(':checked')) {

			tabelPeserta.destroy();
			tabelPeserta = $('#listPeserta').DataTable({
				"dom": '<"pesertaBar">frtlp',
				"ajax": {
					"url": BASE_URL+"c_rapat/get_table_peserta",
					type : 'POST',
					"data":{'id_edit':id_rapat},
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
					$('div.pesertaBar').html('<div style="float:left;"><button id="hapusPeserta" type="button" class="btn btn-danger buttonPeserta" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
				}
			});

		}else if ($('#addPegawai').is(':checked')) {

			tabelPeserta.destroy();
			tabelPeserta = $('#listPeserta').DataTable({
				"dom": '<"pesertaBar">frtlp',
				"ajax": {
					"url": BASE_URL+"c_rapat/get_table_all_peserta_pegawai",
					type : 'POST',
					"data":{'id_edit':id_rapat},
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
					$('div.pesertaBar').html('<div style="float:left;"><button id="tambahPesertaPegawai" type="button" class="btn btn-primary buttonPeserta" disabled>Tambah <span class="glyphicon glyphicon-plus"></span></button></div>');
				}
			});

		}else if ($('#addNon').is(':checked')) {

			tabelPeserta.destroy();
			tabelPeserta = $('#listPeserta').DataTable({
				"dom": '<"pesertaBar">frtlp',
				"ajax": {
					"url": BASE_URL+"c_rapat/get_table_all_peserta_non",
					type : 'POST',
					"data":{'id_edit':id_rapat},
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
					$('div.pesertaBar').html('<div style="float:left;"><button id="tambahPesertaNon" type="button" class="btn btn-primary buttonPeserta" disabled>Tambah <span class="glyphicon glyphicon-plus"></span></button></div>');
				}
			});

		}
	})

	$('#bigModalContent').on('click','#hapusPeserta', function(){
		$('.buttonPeserta').button('loading');

		var checked = [];
		$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
			checked.push($(this).val());
		});
		console.log(checked);
		var requrl = BASE_URL+'c_rapat/delete_peserta';

		$.ajax({
			url:requrl,
			type:'post',
			data: {"array_del": checked} ,
			success:function(data){
				tabelPeserta.ajax.reload();
				$('.buttonPeserta').button('reset');
				setTimeout(function () {
					$('.buttonPeserta').prop("disabled", true);
				}, 0);
			}
		});
	});

	$('#bigModalContent').on('click','#tambahPesertaPegawai', function(){
		$('.buttonPeserta').button('loading');

		var checked = [];
		$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
			checked.push($(this).val());
		});
		console.log(checked);
		var requrl = BASE_URL+'c_rapat/tambah_peserta_pegawai';

		$.ajax({
			url:requrl,
			type:'post',
			data: {'id_pegawai': checked,'id_rapat':id_rapat} ,
			success:function(data){
				tabelPeserta.ajax.reload();
				$('.buttonPeserta').button('reset');
				setTimeout(function () {
					$('.buttonPeserta').prop("disabled", true);
				}, 0);
			}
		});
	});

	$('#bigModalContent').on('click','#tambahPesertaNon', function(){
		$('.buttonPeserta').button('loading');

		var checked = [];
		$(".select-peserta:checked", tabelPeserta.rows().nodes()).each(function(){
			checked.push($(this).val());
		});
		console.log(checked);
		var requrl = BASE_URL+'c_rapat/tambah_peserta_non';

		$.ajax({
			url:requrl,
			type:'post',
			data: {'id_non': checked,'id_rapat':id_rapat} ,
			success:function(data){
				tabelPeserta.ajax.reload();
				$('.buttonPeserta').button('reset');
				setTimeout(function () {
					$('.buttonPeserta').prop("disabled", true);
				}, 0);
			}
		});
	});
});