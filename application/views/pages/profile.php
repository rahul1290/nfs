<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!--<h1>PROFILE PAGE</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

	<?php print_r($this->session->flashdata('msg'));?>

    <!-- Main content -->
    <section class="">

      <!-- Default box -->
      <div class="card offset-xs-1 col-xs-10 offset-sm-3 col-sm-6 offset-md-4 col-md-4 offset-lg-4 col-lg-3">
        <div class="card-header">
          <h3 class="card-title"></h3>
        <div class="card-body">
		
			<div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
				<?php 
					if($profile[0]['Photo'] == ''){ ?>
						<img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/images/avatar.png');?>" alt="User profile picture">
					<?php } else {  ?>
						<img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/');?><?php echo $this->session->userdata('role')?>/<?php echo $this->session->userdata('profile_pic'); ?>" alt="User profile picture">
					<?php } ?>
					<br/>
					<div class="btn btn-default btn-file">
						<i class="fas fa-pencil"></i>Change profile
						<input type="file" id="file" name="file" multiple>
					</div>
                </div>
				
				
					
                <h3 class="profile-username text-center"><?php echo $profile[0]['NAME']; ?></h3>

                <p class="text-muted text-center"><?php echo $this->session->userdata('role'); ?></p>

                <ul class="list-group list-group-unbordered mb-3">
					<li class="list-group-item">
						<b>UserId</b> <a class="float-right"><?= $profile[0]['UID']; ?></a>
					</li>
					<li class="list-group-item">
						<b>EmailId</b> <a class="float-right"><?= $profile[0]['EmailId']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Contact No.</b> <a class="float-right"><?= $profile[0]['CONTACTNO']; ?></a>
					</li>
                </ul>

                <a href="javascript:void(0);" class="btn btn-info btn-block" id="cngpass"><b>Change Password</b></a>
              </div>
              <!-- /.card-body -->
            </div>
		
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  
  
  
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">

			<form>
			  <div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Current Password</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="curr_pass" name="curr_pass" value="" placeholder="Enter Your current Password">
				  <span id="curr_pass_error"></span>
				</div>
			  </div>
			  <div class="form-group row">
				<label for="new_pass" class="col-sm-2 col-form-label">New Password</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="Password">
				  <span id="new_pass_error"></span>
				</div>
			  </div>
			  <div class="form-group row">
				<label for="conf_pass" class="col-sm-2 col-form-label">Confirm Password</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" id="conf_pass" name="conf_pass" placeholder="Password">
				  <span id="conf_pass_error"></span>
				</div>
			  </div>
			</form>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" id="change" class="btn btn-primary">change</button>
		  </div>
		</div>
	  </div>
	</div>
  
<script>
	$(document).ready(function(){	
		var baseUrl = $('#baseUrl').val();
		var currentpass = true;
		$(document).on('click','#cngpass',function(){
				$('#exampleModal').modal({
				  show: true,
				  backdrop : 'static'
				});
		});
	
		 $(document).on('blur','#curr_pass',function(){
			 var password = $(this).val();
			 $.ajax({
				url : baseUrl + 'Auth/checkCurrentPassword',
				data: {
					'password' : password,
				},
				type: 'POST',
				dataType: 'json',
				success: function(response){
					if(response.status == 200){
						currentpass = true;
						$('#curr_pass_error').html('<p class="text-success">Password Matched.</p>');
					} else {
						currentpass = false;
						$('#curr_pass_error').html('<p class="text-danger">Password Not Matched.</p>');
					}
				}
			});
		 });
		 
		 $(document).on('click','#change',function(){
			 var newPass = $('#new_pass').val();
			 var confPass = $('#conf_pass').val();
			 
			 if(newPass.length > 0){
					$('#new_pass_error').html('');
					if(confPass.length > 0){
						$('#conf_pass_error').html('');
						if(newPass == confPass){
							 $.ajax({
								url : baseUrl + 'Auth/changePassword',
								data: {
									'password' : newPass,
								},
								type: 'POST',
								dataType: 'json',
								success: function(response){
									if(response.status == 200){
										alert('Password changed.');
										location.reload();
									} else {
										alert('password not changed');
									}
								}
							});
						 } else {
							$('#conf_pass_error').html('<p class=""text-danger">Confirm password not matched.</p>');
						 }
							 
					} else {
						$('#conf_pass_error').html('<p class=""text-danger">Confirm password required.</p>');
					}
			 } else {
				 $('#new_pass_error').html('<p class="text-danger">New password required.</p>');
			 }
		 });




		 $(document).on('change','#file',function(){
			var formValue;
			formValue = new FormData();
			formValue.append('file', $('#file').prop('files')[0]);
			$.ajax({
				url: baseUrl + 'Auth/profileUpload',
				data: formValue,
				type: 'POST',
				dataType: 'json',
				beforeSend: function() {
					$('#loaderModal').modal({'show':true});

				},
				success: function(response){
					var x = '';
					if(response.status == 200){
						
					}
				},
				complete: function(xhr) {
					location.reload();
				},
				processData: false,
				contentType: false,
			});
		 });
	});
</script>