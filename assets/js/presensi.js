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

});