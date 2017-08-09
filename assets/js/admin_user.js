$(document).ready(function() {
	// table
	var tabel_user = $('#tabel').DataTable({
		"ajax": {
			"url": BASE_URL+"c_admin/get_table_user",
			"dataSrc": ""
		},
		"columns": [
		{ "data": "ID_USER" },
		{ "data": "NIP_PEGAWAI" },
		{ "data": "NAMA_USER" },
		{ "data": "PASSWORD" },
		{ "data": "STATUS" },
		{ "data": "OTORITAS" },
		{ "data": "ID_USER" },
		],'columnDefs':[{
			'targets': 6,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<button type="button" class="editButton btn btn-info" data-toggle="modal" data-target="#myModal" value="'+data+'"><span class="glyphicon glyphicon-edit"></span> Edit</button>';
			}
		},{
			'targets': 0,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<input type="checkbox" class="select" value="'+data+'">';
			}
		}],
		'order': [1, 'asc']
	});

	$("#tabel").on('click','#select-all', function(){
		// var rows = tabel_pegawai.table().node();
		console.log(rows);
		var rows = tabel_user.rows().nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});

	$('#myModal').on('hidden.bs.modal', function() {
		tabel_user.ajax.reload();
	});

	// insert
	$(document).on('click','#tambah',function(event){
		var requrl = BASE_URL+'c_admin/form_user';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#insert', function(){
		var requrl = BASE_URL+'c_admin/insert_user/';
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
	});
	
	// edit
	$(document).on('click','.editButton',function(event){
		var data = $(this).val();
		// console.log(data);
		var requrl = BASE_URL+'c_admin/edit_form_user';
		
		// console.log(data);
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#edit', function(){
		var requrl = BASE_URL+'c_admin/update_user/';
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


	
	

	// $(document).on('click','#deletePegawai',function(event){
		// var requrl = BASE_URL+'c_admin/form_delete_pegawai';
		// $.ajax({
			// url:requrl,
			// success:function(data){
				// $('#modalContent').html(data);
			// }
		// });
	// })


	// delete
	$(document).on('click','#hapus',function(event){
		var requrl = BASE_URL+'c_admin/form_delete_user';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#delete', function(){
		var selected = [];
		$('#tabel input:checked').each(function() {
			selected.push($(this).attr('value'));
		});
		var requrl = BASE_URL+'c_admin/delete_user';
		console.log(selected);
		$.ajax({
			url:requrl,
			type:'post',
			data: {"array_del": selected} ,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	});
});