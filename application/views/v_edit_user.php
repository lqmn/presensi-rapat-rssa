<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Edit User</h4>
</div>

<div class="modal-body">
	<form id="formModal"class="form-horizontal" action="">
		<div class="form-group">
			<label class="control-label col-sm-3" for="email">Nomor pegawai:</label>
			<div class="col-sm-9">
			<input type="hidden" class="form-control" placeholder="Nomor pegawai" name="id" value="<?php echo $user->ID_USER;?>" required>
				<input type="text" class="form-control" placeholder="Nomor pegawai" name="nip" value="<?php echo $user->NIP_PEGAWAI;?>" required>
			</div>
		</div>
		 <div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Nama pegawai:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="nama" placeholder="Nama pegawai" value="<?php echo $user->NAMA_USER;?>" name="nama" required>
			</div>
		</div> 
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Password:</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" id="nama" placeholder="password" name="password" value="<?php echo $user->PASSWORD;?>" required>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Otoritas:</label>
			<div class="col-sm-9">
				<select class="selectpicker"  name="otoritas">
						<option value="1"<?php if ($user->OTORITAS==(1)): ?>
								<?php echo 'selected';?>
						<?php endif ?>>Administrator</option>
						
						<option value="2" <?php if ($user->OTORITAS==(2)): ?>
								<?php echo 'selected';?>
						<?php endif ?>>Verifikator</option>
						
						<option value="3" <?php if ($user->OTORITAS==(3)): ?>
								<?php echo 'selected';?>
						<?php endif ?>>User Biasa </option>
					        
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Status:</label>
			<div class="col-sm-9">
				<select class="selectpicker"  name="status">
						<option value="1"<?php if ($user->STATUS==(1)): ?>
								<?php echo 'selected';?>
						<?php endif ?>>Aktif</option>
						
						<option value="0" <?php if ($user->STATUS==(0)): ?>
								<?php echo 'selected';?>
						<?php endif ?>>Non aktif</option>
						
					        
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button id="edit" type="button" class="btn btn-primary">Submit</button>
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
</div>
<script type="text/javascript">
	$('.selectpicker').selectpicker('refresh');
</script>