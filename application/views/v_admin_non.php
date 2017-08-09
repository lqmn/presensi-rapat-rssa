<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- dataTables -->
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>

	<!-- bootstrap-select -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>


	<!-- Custom CSS & JS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/admin.css" type="text/css">
	<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin_non.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</head>
<body>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<div id="modalContent" class="modal-content">
				//content from ajax loaded here modal 1
			</div>

		</div>
	</div>

	<nav class="navbar navbar-inverse visible-xs">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#">Logo</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">

					<li class="active"><a href="#">Admin</a></li>
					<li><a href="#">Presensi</a></li>
					<li><a href="#">Rapat</a></li>

				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-3 sidenav hidden-xs">
				<h2>Logo</h2>
				<ul class="nav nav-pills nav-stacked">

					<li class="active"><a href="#">Admin</a></li>
					<li><a href="#">Presensi</a></li>
					<li><a href="#">Rapat</a></li>

				</ul><br>
			</div>
			<br>

			<div class="col-sm-9">
				<div class="well">
					<div width=100% style="float:right;">
						<select id="page" class="selectpicker" name="tabel">
							<option value="1">Pegawai</option>
							<option value="2">User</option>
							<option value="3" selected>Non Pegawai</option>
						</select>
					</div><h4>Non Pegawai</h4>
					<br>
					<table id="tabel" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr><th><input name="select_all" value="1" id="select-all" type="checkbox" /></th>
								<th>Nama</th>
								<th>Institusi</th>
								<th>Panel</th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php foreach ($dataUser as $key => $value): ?>
								<tr>
									<td><?php echo $value->ID_PEGAWAI; ?></td>
									<td><?php echo $value->NIP; ?></td>
									<td><?php echo $value->NAMA; ?></td>
									<td><?php echo $value->ID_SATKER; ?></td>
									<td><?php echo $value->STATUS; ?></td>
								</tr>
							<?php endforeach ?> -->
						</tbody>
					</table>
					<button id="tambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah</button>
					
					<button id="hapus" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete</button>
				</div>
			</div>

		</div>
	</div>


</body>
</html>
