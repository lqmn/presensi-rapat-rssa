<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Form Rapat</h4>
</div>

<div class="modal-body">
	<form id="formModal"class="form-horizontal" action="">
	
			<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Judul Rapat :</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="nama" placeholder="Judul Rapat" name="judul" required>
			</div>
		</div>
		
		<!--<div class="form-group">
			<label class="control-label col-sm-3" >Tanggal & waktu rapat :</label>
			<div class="col-sm-9">
			<div class='input-group date' id='datetimepicker1' >
                    <input type='text' class="form-control" name="tanggal"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
				</div>
			
		</div> -->
		<div class="form-group">
			<label class="control-label col-sm-3" >Tanggal :</label>
			<div class="col-sm-9">
			<div class='input-group date' id='datetimepicker2' >
                    <input type='text' class="form-control" name="tanggal"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
				</div>
			
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-3" >Waktu rapat :</label>
			<div class="col-sm-9">
			<div class='input-group date' id='datetimepicker3' >
                    <input type='text' class="form-control" name="waktu"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
				</div>
			
		</div>
		
			<div class="form-group">
			<label class="control-label col-sm-3" for="pwd">Ruang Rapat:</label>
			<div class="col-sm-9">

				<select class="selectpicker" data-live-search="true" name="ruang">
					<?php foreach ($ruang as $key => $value): ?>
						<option value="<?php echo $value->ID_RUANG ?>" data-tokens="<?php echo $value->NAMA_RUANG ?>"><?php echo $value->NAMA_RUANG ?></option>
					<?php endforeach ?>          
				</select>
			</div>
		</div>
	
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button id="insertRapat" type="button" class="btn btn-primary">Submit</button>
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
<!-- datetimepicker-->
	<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
					format: 'DD/MM/YYYY HH:mm',
        
                    locale : 'en'
                });
            });
        </script>
		
		<script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker({
					format: 'YYYY/MM/DD',
        
                    locale : 'en'
                });
            });
        </script>
		
		<script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
					format: 'LT',
        
                    locale : 'id'
                });
            });
        </script>