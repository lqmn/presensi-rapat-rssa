<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container">
	<div class="card card-container">
		<img id="profile-img" class="profile-img-card" src="<?php echo base_url(); ?>assets/img/logo.png" />

		<?php
			if (isset($logout_message)) {
				echo "<div class='message'>";
				echo $logout_message;
				echo "</div>";
			}
		?>

		<?php
			if (isset($message_display)) {
				echo "<div class='message'>";
				echo $message_display;
				echo "</div>";
			}
		?>

		<?php echo form_open('c_login/user_login_process'); ?>

		<?php
			echo "<div class='error_msg'>";
			if (isset($error_message)) {
				echo $error_message;
			}
			echo validation_errors();
			echo "</div>";
		?>

		<div class="form-signin">
			<!-- <label>UserName :</label> -->
			<input class="form-control" type="text" name="username" id="name" placeholder="Username">
			<!-- <label>Password :</label> -->
			<input class="form-control" type="password" name="password" id="password" placeholder="password">
			<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit">Sign in</button>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>

</body>
</html>