
var formData;
$(document).ready(function() {
	$('#presensi-nav').addClass("active");
	$(document).on('submit','#fileForm',function(){
		// console.log('kawodkwaodk');
		var form = $('#fileForm')[0];
		// var test = $('#inputExcel').files[0];
		// console.log(form);

		formData = new FormData(form);
		// console.log(yay);
		// formdata.append('excelData',excelData,'wow.xlsx');

		$.ajax({
			url: BASE_URL+'c_presensi/upload',
			data: formData,
			type: 'POST',
			contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
			processData: false, // NEEDED, DON'T OMIT THIS
			success:function(data){
				$('#contentConfirm').html(data);
			}
			// ... Other options like success and etc
		});
		return false;
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

});