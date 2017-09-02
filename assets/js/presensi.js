$(document).ready(function() {

	$('#presensi-nav').addClass("active");
	var tabelLibur;
	var tabelRekap = $('#tabelRekap').DataTable({
		"dom": "<'row'<'col-sm-9'><'col-sm-3'f>>" +
			"<'row'<'col-sm-12'tr>>" +
			"<'row'<'col-sm-5'l><'col-sm-7'p>>",
		"ajax": {
			"url": BASE_URL+"c_presensi/get_tabel_rekap",
			"dataSrc": ""
		},
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
				return '<input type="button" class="detail-rekap" value="' + data + '">';
			}
		}],"order": [],
		initComplete:function(){}
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
			dataRow[5]=$(this).find('.hitung').is(":checked");
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


});