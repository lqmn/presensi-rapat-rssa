$(document).ready(function() {
	
	var tabel = $('#tabel').DataTable( {
		"dom": '<"toolbar">frtlp',
		"ajax": {
			"url": BASE_URL+"c_admin/get_table_non",
			"dataSrc": ""
		},
		"columns": [
		{ "data": "ID" },
		{ "data": "NAMA" },
		{ "data": "INSTITUSI" },
		{ "data": "ID" },
		],'columnDefs':[{
			'targets': 3,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<button type="button" class="editButton btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" value="'+data+'"><span class="glyphicon glyphicon-edit"></span> Edit</button>';
			}
		},{
			'targets': 0,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<input type="checkbox" class="select" value="' + data + '">';
			}
		}],"order": [],
		initComplete:function(){
			$('div.toolbar').html('<div style="float:left;"><button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Tambah</button> <button id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" disabled><span class="glyphicon glyphicon-remove"></span> Delete</button></div>');
		}
	});
	
	// insert
	$(document).on('click','#tambah',function(event){
		var requrl = BASE_URL+'c_admin/form_non';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('submit','#insertForm', function(){
		$('#insert').button('loading');
		var requrl = BASE_URL+'c_admin/insert_non/';
		var data = {};

		$('#modalContent').find('[name]').each(function(index, value){
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
				$('#modalContent').html(data);
			}
		});
		return false;
	});

	// edit
	$(document).on('click','.editButton',function(event){
		var data = $(this).val();
		console.log(data);
		var requrl = BASE_URL+'c_admin/edit_form_non';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})
	
	$('#modalContent').on('submit','#formEdit', function(){
		$('#edit').button('loading');
		var requrl = BASE_URL+'c_admin/update_non/';
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
		return false;
	});

	// delete
	$(document).on('click','#hapus',function(event){
		var requrl = BASE_URL+'c_admin/form_delete_non';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#delete', function(){
		$('#delete').button('loading');
		var selected = [];
		$('.select:checked').each(function() {
			selected.push($(this).attr('value'));
		});
		var requrl = BASE_URL+'c_admin/delete_non';
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