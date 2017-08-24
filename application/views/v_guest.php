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
	<?php $this->load->view('navbar_guest'); ?>

	<div class="container-fluid text-center">
		<div class="row content">
			<div class="col-sm-12 text-left">

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
		</div>
	</div>

</body>
</html>