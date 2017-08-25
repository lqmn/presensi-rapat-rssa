<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/login.css"); ?>">
</head>
<body>

	<?php $this->load->view('navbar_guest'); ?>

	<div class="container text-center">
		<div class="row content">
			<div class="col-md-4 col-sm-3"></div>
			<div id="login" class="col-md-4 col-sm-6 card well">
				<img src="<?php echo base_url("assets/img/logo.png"); ?>" />
				<form id="loginForm">
					<div class="form-group">
						<input class="form-control" type="text" name="username" placeholder="Username" required>
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="password" placeholder="Password" required>
					</div>
					<div class="form-group">
						<p id="error">Login gagal</p>
						<button id="loginButton" class="btn btn-primary" type="submit">Login</button>
					</div>
				</form>
        
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.2.1.min.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/login.js"); ?>"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</body>
</html>