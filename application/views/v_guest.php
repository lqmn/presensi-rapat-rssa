<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- dataTables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

	<!-- custom -->
	<script src="<?php echo base_url(); ?>assets/js/guest.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">WebSiteName</a>
			</div>
			<ul class="nav navbar-nav pull-right">
				<li class="active"><a href="<?php echo base_url();?>c_rapat/">Rapat</a></li>
				<li><a href="<?php echo base_url();?>c_login/welcome">Login</a></li>
			</ul>
		</div>
	</nav>
	<div class="well">
	<table id="tabelGuest" class="table">
		<thead>
			<tr>
				<th></th>
				<th>Waktu</th>
				<th>Ruang</th>
				<th>Judul</th>
			</tr>
		</thead>
	</table>
	</div>
</body>
</html>