$(document).ready(function() {
	$('#presensi-nav').addClass("active");


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

	$('#bigModalContent').on('click','#save', function(){
		$('#save').button('loading');
		var tabel = $('#tableConfirm').DataTable();
		
		var data =[]
		$(tabel.rows().nodes()).each(function(){
			var dataRow = $(this).children("td").map(function() {
				return $(this).text();
			}).get();
			dataRow[4]=$(this).find('.hitung').is(":checked");
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

	$('#bigModalContent').on('click','#tambahLibur',function(event){
		$('#tambahLibur').button('loading');

		var requrl = BASE_URL+'c_presensi/form_libur';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#bigModalContent').html(data);
			
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



	
	
	


