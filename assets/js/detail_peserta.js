$(document).ready(function() {
	// table
	var id_rapat_global=$('.id_rapat').val();
	var tabel = $('#tabel').DataTable({
		
		"ajax": {
			"url": BASE_URL+"c_admin/get_table_detail_peserta/"+id_rapat_global,
			"dataSrc": ""
		},
	
		"columns": [
		{ "data": "ID" },
		{ "data": "NAMA" },
		{ "data": "SATKER" },
		{ "data": "ASAL" }
		],'columnDefs':[{
			'targets': 0,
			'searchable':false,
			'orderable':false,
			'className': 'dt-body-center',
			'render': function (data){
				return '<input type="checkbox" class="select" value="' + data + '">';
			}
		}
		
		]
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
	// $(document).on('click','#tambah',function(event){
		// var requrl = BASE_URL+'c_admin/form_rapat';
		// $.ajax({
			// url:requrl,
			// success:function(data){
				// $('#modalContent').html(data);
			// }
		// });
	// })

	// USED -> CONTIUE LATER $(document).on('click','#tambah', function(){
		// var requrl = BASE_URL+'c_admin/insert_peserta/';
		// var data = {};

		// $(document).find('[name]').each(function(index, value){
			// var name = $(this).attr('name');
			// var value = $(this).val();
			// data[name] = value;
		// });
		// console.log(data);
		
		// $.ajax({
			// url:requrl,
			// type:'post',
			// data:data,
			// success: function(data){
				// $(document).html(data);
			// }
		// });
	// });
	
	// $('#modalContent').on('click','#insertRapat', function(){
		// var requrl = BASE_URL+'c_admin/insert_rapat/';
		// var data = {};

		// $('#modalContent').find('[name]').each(function(index, value){
			// var name = $(this).attr('name');
			// var value = $(this).val();
			// data[name] = value;
		// });
		// console.log(data);
		
		// $.ajax({
			// url:requrl,
			// type:'post',
			// data:data,
			// success: function(data){
				// $('#modalContent').html(data);
			// }
		// });
	// });

	// edit
	$(document).on('click','.editButton',function(event){
		var data = $(this).val();
		// console.log(data);
		var requrl = BASE_URL+'c_admin/edit_form_rapat';
		
		$.ajax({
			url:requrl,
			type:'post',
			data:{'id_edit':data},
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	$('#modalContent').on('click','#updateRapat', function(){
		var requrl = BASE_URL+'c_admin/update_rapat/';
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

	// delete
	$(document).on('click','#hapus',function(event){
		var requrl = BASE_URL+'c_admin/form_delete_rapat';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	// $('#modalContent').on('click','#delete', function(){
		// var selected = [];
		// $('#tabel input:checked').each(function() {
			// selected.push($(this).attr('value'));
		// });
		// var requrl = BASE_URL+'c_admin/delete_rapat';
		// console.log(selected);
		// $.ajax({
			// url:requrl,
			// type:'post',
			// data: {"array_del": selected} ,
			// success:function(data){
				// $('#modalContent').html(data);
			// }
		// });
	// });
	
		$('#modalContent').on('click','#insertRapat', function(){
		var selected = [];
		var id_rapat=$('.id_rapat').val();
		$('#tabel input:checked').each(function() {
			selected.push($(this).attr('value'));

		});
		var requrl = BASE_URL+'c_admin/insert_peserta';
		console.log(selected);
		$.ajax({
			url:requrl,
			type:'post',
			data: {"array_del": selected,"id_rapat" : id_rapat} ,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	});
	
	$(document).on('click','#tambah',function(event){
		var requrl = BASE_URL+'c_admin/form_insert_rapat';
		$.ajax({
			url:requrl,
			success:function(data){
				$('#modalContent').html(data);
			}
		});
	})

	setInterval(function() {
		tabel.ajax.reload();
	}, 300000 );
});