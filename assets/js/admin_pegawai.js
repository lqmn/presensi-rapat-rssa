$(document).ready(function() {
	// table
	var tabel = $('#tabel').DataTable({
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
				return '<button type="button" class="editButton btn btn-info" data-toggle="modal" data-target="#myModal" value="'+data+'"><span class="glyphicon glyphicon-edit"></span> Edit</button>';
			}
		},{
			'targets': 0,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<input type="checkbox" class="select" value="' + data + '">';
			}
		}],"order": []
	});

	$("#tabel").on('click','#select-all', function(){
		// var rows = tabel.table().node();
		// console.log(rows);
		var rows = tabel.rows().nodes();
		$('input[type="checkbox"]', rows).prop('checked', this.checked);
	});

	$('#myModal').on('hidden.bs.modal', function() {
		tabel.ajax.reload();
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
		var selected = [];
		$('.select:checked').each(function() {
			selected.push($(this).attr('value'));
		});
		var requrl = BASE_URL+'c_admin/delete_pegawai';
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

	setInterval(function() {
		tabel.ajax.reload();
	}, 300000 );
});