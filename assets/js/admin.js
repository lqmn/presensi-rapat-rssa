$(document).ready(function() {
	// var tabel_pegawai = $('#tablePegawai').DataTable( {
	// 	"ajax": {
	// 		"url": BASE_URL+"c_admin/get_table_pegawai",
	// 		"dataSrc": ""
	// 	},
	// 	"columns": [
	// 	{ "data": "ID_PEGAWAI" },
	// 	{ "data": "NIP" },
	// 	{ "data": "NAMA" },
	// 	{ "data": "ID_SATKER" },
	// 	{ "data": "STATUS" }
	// 	],'columnDefs': [{
	// 		'targets': 0,
	// 		'searchable':false,
	// 		'orderable':false,
	// 		'className': 'dt-body-center',
	// 		'render': function (data, type, full, meta){
	// 			return '<input type="checkbox" class="select" name="id[]" value="' 
	// 			+ $('<div/>').text(data).html() + '">';
	// 		}
	// 	}],
	// 	"columns": [
	// 	{ "data": "ID_PEGAWAI" },
	// 	{ "data": "NIP" },
	// 	{ "data": "NAMA" },
	// 	{ "data": "ID_SATKER" },
	// 	{ "data": "STATUS" },
	// 	{ "data": "ID_PEGAWAI" }
	// 	],'columnDefs': [{
	// 		'targets': 5,
	// 		'searchable':false,
	// 		'orderable':false,
	// 		'className': 'dt-body-center',
	// 		'render': function (data, type, full, meta){
	// 			return '<button type="button" class="editButton btn btn-info" data-toggle="modal" data-target="#myModal" value="'+$('<div/>').text(data).html() +'">Edit </button>';
	// 		}
	// 	}],
	// 	'order': [1, 'asc']
	// });

	// $('#select-all').on('click', function(){
	// 	var rows = tabel_pegawai.rows({ 'search': 'applied' }).nodes();
	// 	$('input[type="checkbox"]', rows).prop('checked', this.checked);
	// });

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


	// $(document).on('click','.editButton',function(event){
	// 	var data = $(this).val();
	// 	// console.log(data);
	// 	var requrl = BASE_URL+'c_admin/edit_form_pegawai';

	// 	$.ajax({
	// 		url:requrl,
	// 		type:'post',
	// 		data:{'id_edit':data},
	// 		success:function(data){
	// 			$('#modalContent').html(data);
	// 		}
	// 	});

	// })

	// $(document).on('click','#deletePegawai',function(event){
	// 	var requrl = BASE_URL+'c_admin/form_delete_pegawai';
	// 	$.ajax({
	// 		url:requrl,
	// 		success:function(data){
	// 			$('#modalContent').html(data);
	// 		}
	// 	});
	// })

	// $(document).on('click','#tambahPegawai',function(event){
	// 	var requrl = BASE_URL+'c_admin/form_pegawai';
	// 	$.ajax({
	// 		url:requrl,
	// 		success:function(data){
	// 			$('#modalContent').html(data);
	// 		}
	// 	});
	// })

	// $('#modalContent').on('submit','#formModal', function(){
	// 	var requrl = BASE_URL+'c_admin/insert_pegawai/';
	// 	var data = {};

	// 	// get data
	// 	$(this).find('[name]').each(function(index, value){
	// 		var name = $(this).attr('name');
	// 		var value = $(this).val();
	// 		data[name] = value;
	// 	});


	// 	$.ajax({
	// 		url:requrl,
	// 		type:'post',
	// 		data:data,
	// 		success: function(data){
	// 			$('#modalContent').html(data);
	// 		}
	// 	});

	// 	//handle redirect maybe?
	// 	return false;
	// });

	

	// $('#myModal').on('hidden.bs.modal', function() {
	// 	tabel_pegawai.ajax.reload();
	// });

	$(document).on('change','#page',function(){
		var x = $('#page').val();
		console.log(x);
		switch(parseInt(x)){
			case 1:
			window.location.href =  BASE_URL+'c_admin/pegawai';
			break;
			case 2:	
			window.location.href =  BASE_URL+'c_admin/user';
			break;
			case 3:	
			window.location.href =  BASE_URL+'c_admin/non_pegawai';
			break;
			default:
		}
	});
	
});