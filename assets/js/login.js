$(document).ready(function() {
	$(document).on('submit','#loginForm', function(e){
		$('#loginButton').button('loading');
		var requrl = BASE_URL+'c_login/proses_login/';
		var data = {};

		$('#loginForm').find('[name]').each(function(index, value){
			var name = $(this).attr('name');
			var value = $(this).val();
			data[name] = value;
		});
		// console.log(data);
		
		$.ajax({
			url:requrl,
			type:'post',
			data:data,
			success: function(data){
				if (data==0) {
					$('#error').show();
				}else{
					window.location.href = BASE_URL+'c_login/loginsuccess/';
				}
				$('#loginButton').button('reset');
			}
		});
		return false;
	});
});