<!DOCTYPE html>
<head>
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap-select.min.css"); ?>">
</head>
<body>

	<?php

	if ($this->session->userdata('otoritas')==1) {
		$this->load->view('navbar_admin');
	}elseif ($this->session->userdata('otoritas')>1) {
		$this->load->view('navbar');
	}else{
		$this->load->view('navbar_guest');
	}

	?><br>

	<div class="container text-center">
		<div class="row content">
			<div class="col-sm-12 text-left">
				<h2>Access Denied</h2>
				<p>You do not have access to the page you requested.</p><br>
				<a href="<?php echo base_url(); ?>">Return to home page</a>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</body>
</html>