$(document).ready(function() {

	$('#presensi-nav').addClass("active");
	var tabelLibur;
	var tabelRekap = $('#tabelRekap').DataTable({
		"dom": "B<'toolbar'>f" +
		"<'row'<'col-sm-12'tr>>" +
		"<'row'<'col-sm-5'l><'col-sm-7'p>>",
		"ajax": {
			"url": BASE_URL+"c_presensi/get_tabel_rekap",
			"dataSrc": ""
		},
		buttons: [{
			extend: 'print',
			exportOptions: {
				columns: ':visible:not(.checkbox)'
			}
		},{
			extend: 'excel',
			exportOptions: {
				columns: ':visible:not(.checkbox)'
			}
		}],
		"columns": [
		{ "data": "NAMA" },
		{ "data": "SATKER" },
		{ "data": "TAHUN" },
		{ "data": "BULAN" },
		{ "data": "PRESENSI" },
		{ "data": "LEMBUR" },
		{ "data": "ID_REKAP" }
		],'columnDefs':[{
			'targets': 6,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<button type="button" class="detailPresensi btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" value="'+data+'"><span class="glyphicon glyphicon-edit"></span> Edit</button>';
			}
		}],"order": [],
		initComplete:function(){
			$('div.toolbar').html('<div id="option" class="pull-right">&nbsp;</div>');
			this.api().column(5).visible(false);

			var bulan = this.api().column(3);
			var selectBulan = $('<select class="form-control"><option value="">Semua Bulan</option></select>')
			.appendTo( $('#option')).on('change', function(){
				var val = $.fn.dataTable.util.escapeRegex($(this).val());
				console.log(val);
				bulan.search( val ? '^'+val+'$' : '', true, false ).draw();
			});

			bulan.data().unique().sort().each( function ( d, j ) {
				selectBulan.append( '<option value="'+d+'">'+d+'</option>' )
			});

			var tahun = this.api().column(2);
			var selectTahun = $('<select class="form-control"><option value="">Semua Tahun</option></select>')
			.appendTo( $('#option')).on('change', function(){
				var val = $.fn.dataTable.util.escapeRegex($(this).val());
				console.log(val);
				tahun.search( val ? '^'+val+'$' : '', true, false ).draw();
			});

			tahun.data().unique().sort().each( function ( d, j ) {
				selectTahun.append( '<option value="'+d+'">'+d+'</option>' )
			});
		}
	});

	$(document).on('click','#upload',function(event){
		var requrl = BASE_URL+'c_presensi/form_upload';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#bigModalContent').html(data);
			}
		});
	})

	$(document).on('submit','#fileForm',function(){
		$('#openFile').button('loading');
		var form = $('#fileForm')[0];

		var formData = new FormData(form);

		$.ajax({
			url: BASE_URL+'c_presensi/openFile',
			data: formData,
			type: 'POST',
			contentType: false,
			processData: false,
			success:function(data){
				$('#contentConfirm').html(data);
				var tabel = $('#tableConfirm').DataTable();
				$(".hitung", tabel.rows().nodes()).each(function(){
					this.checked = true;
				});
				$('#save').prop('disabled',false);
				$('#openFile').button('reset');
			}
		});
		return false;
	});

	$(document).on('click','#save', function(){
		$('#save').button('loading');
		var tabel = $('#tableConfirm').DataTable();
		
		var data =[]
		$(tabel.rows().nodes()).each(function(){
			var dataRow = $(this).children("td").map(function() {
				return $(this).text();
			}).get();
			dataRow[6]=$(this).find('.hitung').is(":checked");
			data.push(dataRow);
		});

		console.log(data);
		var requrl = BASE_URL+'c_presensi/upload';

		$.ajax({
			url:requrl,
			type:'post',
			data: {"data": data} ,
			success:function(data){
				$('#contentConfirm').html(data);
				$('#save').button('reset');
				setTimeout(function () {
					$('#save').prop("disabled", true);
				}, 0);
			}
		});
	});

	$(document).on('click','#libur',function(event){
		var requrl = BASE_URL+'c_presensi/form_libur';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);

				tabelLibur = $('#tabelLibur').DataTable({
					"dom": '<"liburBar">frtlp',
					"ajax": {
						"url": BASE_URL+"c_presensi/get_tabel_libur",
						type : 'POST',
						"dataSrc": ""
					},
					"columns": [
					{ "data": "ID_HARI_LIBUR" },
					{ "data": "TANGGAL" },
					{ "data": "KETERANGAN" }
					],'columnDefs':[{
						'targets': 0,
						'searchable':false,
						'orderable':false,
						'className': 'dt-body-center',
						'render': function (data){
							return '<input type="checkbox" class="select-libur" value="' + data + '">';
						}
					}],"order": [],
					initComplete:function(){
						$('div.liburBar').html('<div style="float:left;"><button id="hapusLibur" type="button" class="btn btn-danger" disabled>Delete <span class="glyphicon glyphicon-remove"></span></button></div>');
					}
				});
			}
		});
	})

	$(document).on('submit','#liburForm',function(){
		$('#insert').button('loading');
		var form = $('#liburForm')[0];
		// console.log(form);
		var formData = new FormData(form);
		var requrl = BASE_URL+'c_presensi/insert_libur';
		$.ajax({
			url:requrl,
			type:'post',
			data: formData,
			contentType: false,
			processData: false,
			success:function(data){
				tabelLibur.ajax.reload();
				$('#insert').button('reset');
				$('#liburForm')[0].reset();
			}
		});

		return false;
	})


	$(document).on('click','#hapusLibur', function(){
		$('#hapusLibur').button('loading');

		var checked = [];
		$(".select-libur:checked", tabelLibur.rows().nodes()).each(function(){
			checked.push($(this).val());
		});
		console.log(checked);
		var requrl = BASE_URL+'c_presensi/delete_libur';

		$.ajax({
			url:requrl,
			type:'post',
			data: {"array_del": checked} ,
			success:function(data){
				tabelLibur.ajax.reload();
				$('#hapusLibur').button('reset');
				setTimeout(function () {
					$('#hapusLibur').prop("disabled", true);
				}, 0);
			}
		});
	});

	// handle check box each page
	$(document).on( 'draw.dt','#tabelLibur',  function () {
		if ($('.select-libur:checked').length == $('.select-libur').length) {
			$('#all-libur').prop('checked', true);
		}else{
			$('#all-libur').prop('checked', false);
		}
	})

	$(document).on('change','#tabelLibur input:checkbox',function(){
		if ($('.select-libur:checked').length == $('.select-libur').length) {
			$('#all-libur').prop('checked', true);
		}else{
			$('#all-libur').prop('checked', false);
		}

		var hitung = 0;
		$(".select-libur:checked", tabelLibur.rows().nodes()).each(function(){
			hitung++;
		});

		if (hitung>0) {
			$('#hapusLibur').prop('disabled',false);
		}else{
			$('#hapusLibur').prop('disabled',true);
		}
	});

	$(document).on('click','#all-libur', function(){
		var rows = tabelLibur.rows({ page: 'current' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});

	$(document).on('change','#rekapDropdown',function(){
		presensi = tabelRekap.column(4);
		lembur = tabelRekap.column(5);
		var x = $('#rekapDropdown').val();

		switch(parseInt(x)){
			case 1:
			presensi.visible(true);
			lembur.visible(false);
			break;
			case 2:
			presensi.visible(false);
			lembur.visible(true);
			break;
		}
	});

	$('#myModal').on('hidden.bs.modal', function() {
		tabelRekap.ajax.reload();
	});

	// edit
	$(document).on('click','.detailPresensi',function(event){
		var data = $(this).val();
		// console.log(data);
		var requrl = BASE_URL+'c_presensi/detail_rekap/'+data;
		// console.log(requrl);
		
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
				var tabel = $('#listPresensi').DataTable();
				$(tabel.rows().nodes()).each(function(){
					if ($('.hitungVal',this).text()==1) {
						$('.hitung',this).prop('checked',true);
					}
				});
			}
		});
	})

	$(document).on('click','#saveDetail', function(){
		$('#saveDetail').button('loading');
		var tabel = $('#listPresensi').DataTable();
		
		var data =[]
		$(tabel.rows().nodes()).each(function(){
			var dataRow = $(this).children("td").map(function() {
				return $(this).text();
			}).get();
			// console.log(dataRow);
			var checked=$(this).find('.hitung').is(":checked");
			var d = [dataRow[0],checked];
			console.log(d);
			data.push(d);
		});

		console.log(data);
		var requrl = BASE_URL+'c_presensi/update_presensi_detail';

		$.ajax({
			url:requrl,
			type:'post',
			data: {"data": data},
			success:function(data){
				$('#result').html(data);
				$('#saveDetail').button('reset');
				// setTimeout(function () {
				// 	$('#saveDetail').prop("disabled", true);
				// }, 0);
			}
		});
	});
});