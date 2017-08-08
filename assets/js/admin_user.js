$(document).ready(function() {
	var tabel_user = $('#tableUser').DataTable( {
		"ajax": {
			"url": BASE_URL+"c_admin/get_table_user",
			"dataSrc": ""
		},
		"columns": [
		{ "data": "ID_USER" },
		{ "data": "NIP_PEGAWAI" },
		{ "data": "NAMA_USER" },
		{ "data": "STATUS" },
		{ "data": "OTORITAS" }
		],'columnDefs': [{
			'targets': 0,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data, type, full, meta){
				return '<input type="checkbox" class="select" name="id[]" value="' 
				+ $('<div/>').text(data).html() + '">';
			}
		}],
		"columns": [
		{ "data": "ID_USER" },
		{ "data": "NIP_PEGAWAI" },
		{ "data": "NAMA_USER" },
		{ "data": "STATUS" },
		{ "data": "OTORITAS" },
		{ "data": "ID_USER" }
		],'columnDefs': [{
			'targets': 5,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data, type, full, meta){
				return '<button type="button" class="editButton btn btn-info" data-toggle="modal" data-target="#myModal2" value="'+$('<div/>').text(data).html() +'">Edit </button>';
			}
		}],
		'order': [1, 'asc']
	});

	$('#select-all').on('click', function(){
		var rows = tabel_user.rows({ 'search': 'applied' }).nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});

	// $('#modalContent').on('click','#insert', function(){
	// 	var selected = [];
	// 	$('#tablePegawai input:checked').each(function() {
	// 		selected.push($(this).attr('value'));
	// 	});
	// 	var requrl = BASE_URL+'c_admin/delete_pegawai';
	// 	console.log(selected);
	// 	$.ajax({
	// 		url:requrl,
	// 		type:'post',
	// 		data: {"array_del": selected} ,
	// 		success:function(data){
	// 			$('#modalContent').html(data);
	// 		}
	// 	});
	// });


	$(document).on('click','.editButton',function(event){
		var data = $(this).val();
		 console.log(data);
		var requrl = BASE_URL+'c_admin/edit_form_user';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':data},
			success:function(data){
				$('#modalContent2').html(data);
			}
		});

	})
	
	

	// $(document).on('click','#deletePegawai',function(event){
		// var requrl = BASE_URL+'c_admin/form_delete_pegawai';
		// $.ajax({
			// url:requrl,
			// success:function(data){
				// $('#modalContent').html(data);
			// }
		// });
	// })

	$(document).on('click','#tambahUser',function(event){
		var requrl = BASE_URL+'c_admin/form_user';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('submit','#formModal', function(){
		var requrl = BASE_URL+'c_admin/insert_user/';
		var data = {};
       
		// get data

		$(this).find('[name]').each(function(index, value){

			var name = $(this).attr('name');
			var value = $(this).val();
			data[name] = value;
		});
// alert(data);
		
		$.ajax({
			url:requrl,
			type:'post',
			data:data,
			success: function(data){
				$('#modalContent').html(data);
			}
		});

		// handle redirect maybe?
		return false;
	});
	
	
	$('#modalContent2').on('submit','#formModal', function(){
		var requrl = BASE_URL+'c_admin/update_user/';
		var data = {};
       
		// get data

		$(this).find('[name]').each(function(index, value){

			var name = $(this).attr('name');
			var value = $(this).val();
			data[name] = value;
		});
// alert(data);
		
		$.ajax({
			url:requrl,
			type:'post',
			data:data,
			success: function(data){
				$('#modalContent2').html(data);
			}
		});

		// handle redirect maybe?
		return false;
	});


	

	$('#myModal').on('hidden.bs.modal', function() {
		tabel_user.ajax.reload();
	});
	
	$('#myModal2').on('hidden.bs.modal', function() {
		tabel_user.ajax.reload();
	});

});