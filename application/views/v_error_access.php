<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RESTRICTED ACCESS</title>
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
	<script src="<?php echo base_url(); ?>assets/js/admin_user.js"></script>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
	<div class="col-md-4 content" >
	</div>
	
	<div class="col-md-4 content" >
        <br>
        <br>
        <br>
        <br>
                <h1 align="center">RESTRICTED FOR ADMINISTRATOR ONLY </h1>
        <div class="col-md-12">
        <form class="form-horizontal" method="POST" action="<?php echo base_url()."c_login/";?>">
              <button type="submit" class="btn btn-default" name="submit" >Back</button>
            <div class="form-group">
		
              
            </div>
          
		
        </form>
        </div>

       
    </div>
	<div class="col-md-4 content" >
	</div>

</body>
</html>