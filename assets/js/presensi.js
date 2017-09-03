$(document).ready(function() {

	$('#presensi-nav').addClass("active");
	var tabelLibur;
	var tabelRekap = $('#tabelRekap').DataTable({
		"dom": "<'toolbar'>f" +
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
		initComplete:function(){
			$('div.toolbar').html('<div class="wow pull-right">&nbsp;</div>');

			var column = this.api().column(3);
			var select = $('<select class="form-control"><option value=""></option></select>')
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

	$(document).on('click','#hariLibur',function(event){
		$('#hariLibur').button('loading');
		$('#hariLibur').button('reset');

		var requrl = BASE_URL+'c_presensi/hari_libur';
		$.ajax({
			url:requrl,
			success:function(data){

				$('#bigModalContent').html(data);
				var tabel2 = $('#tableLibur').DataTable({

	"dom": '<"toolbar">f',
		
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
			success:function(data){
				tabelLibur.ajax.reload();
				$('#insert').button('reset');
				$('#liburForm')[0].reset();
			}
		});
	})

	$('#bigModalContent').on('click','#insertLibur', function(e){
		$('#insertLibur').button('loading');
	
		var requrl = BASE_URL+'c_presensi/insert_libur/';
		var data = {};

		$('#bigModalContent').find('[name]').each(function(index, value){
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

				$('#bigModalContent').html(data);
				var tabel2 = $('#tableLibur').DataTable({

	"dom": '<"toolbar">f'
		
});
			}
		});
		return false;
	});

	

	$('#bigModalContent').on('click','#hapus',function(event){
		$('#hapus').button('loading');
	
		var requrl = BASE_URL+'c_presensi/form_delete_hari_libur';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#contentConfirm').html(data);
			
			}
		});
	})



	$('#bigModalContent').on('click','#confirmDelete', function(){
		$('#confirmDelete').button('loading');
		
var checked = [];
var tabel2 = $('#tableLibur').DataTable();
		$("input:checked", tabel2.rows().nodes()).each(function(){
			checked.push($(this).val());
		});

		var requrl = BASE_URL+'c_presensi/delete_hari_libur';

		$.ajax({
			url:requrl,
			type:'post',
			data: {"array_del": checked} ,
			success:function(data){
				$('#bigModalContent').html(data);
				var tabel2 = $('#tableLibur').DataTable({

	"dom": '<"toolbar">f'
		
});
			}
		});
	});



});



	
	
	

	$(document).on('click','#libur', function(){
		presensi = tabelRekap.column(4);
		lembur = tabelRekap.column(5);
		column.visible(false);
		console.log(column);
	});

	$(document).on('change','#rekapDropdown',function(){
		presensi = tabelRekap.column(4);
		lembur = tabelRekap.column(5);
		var x = $('#rekapDropdown').val();

		switch(parseInt(x)){
			case 0:
			presensi.visible(true);
			lembur.visible(true);
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
});
