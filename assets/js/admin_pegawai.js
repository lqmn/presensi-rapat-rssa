$(document).ready(function() {
	
	var tabel = $('#tabel').DataTable({
		"dom": '<"toolbar">frtlp',
		"ajax": {
			"url": BASE_URL+"c_admin/get_table_pegawai",
			"dataSrc": ""
		},
		"columns": [
		{ "data": "ID_PEGAWAI" },
		{ "data": "NAMA" },
		{ "data": "NIP" },
		{ "data": "NAMA_SATKER" },
		{ "data": "ID_PEGAWAI" }
		],'columnDefs':[{
			'targets': 4,
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
		var requrl = BASE_URL+'c_admin/form_pegawai';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('submit','#insertForm', function(e){
		$('#insert').button('loading');
		var requrl = BASE_URL+'c_admin/insert_pegawai/';
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
		return false;
	});

	// edit
	$(document).on('click','.editButton',function(event){
		var data = $(this).val();
		// console.log(data);
		var requrl = BASE_URL+'c_admin/edit_form_pegawai';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('submit','#editForm', function(){
		$('#edit').button('loading');
		var requrl = BASE_URL+'c_admin/update_pegawai/';
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
		var requrl = BASE_URL+'c_admin/form_delete_pegawai';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#delete', function(){
		$('#delete').button('loading');

		var checked = [];
		$("input:checked", tabel.rows().nodes()).each(function(){
			checked.push($(this).val());
		});
		console.log(checked);
		var requrl = BASE_URL+'c_admin/delete_pegawai';

		$.ajax({
			url:requrl,
			type:'post',
			data: {"array_del": checked} ,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	});

});