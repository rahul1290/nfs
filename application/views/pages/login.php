<style type="text/css">

.space{
padding:7px;	
}
.space-matter{
font-size:18px;
color : red !important;
}
.space-radius{
border-radius: 11px;
}



</style>

<body class="hold-transition login-page">

<input type="hidden" value="<?php echo base_url();?>" id="baseUrl" />
<div class="login-box">

  <div class="login-logo">
    <a href="#"><img class="img-fluid" src="<?php echo base_url('assets/images/solution_header.jpg');?>"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Here You Can Login?</p>
      <form action="<?php echo base_url('Auth/login');?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="identity" id="identity" placeholder="UserId" value="<?php if(set_value('identity') != ''){ echo set_value('identity'); } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
		<span id="identity_error" style="display:none;"></span>
		<?php echo form_error('identity'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<?php echo form_error('password'); ?>
        <div class="row">
          <!--<div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>-->
		  <div class="col-8">
			<p id="forgorpass" style="cursor:pointer;">Forgot password ?</p>
		  </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
		  <span id="forgot_password_error" style="display:none;"></span>
        </div>
      </form>
<?php /*
      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
	*/ ?>
	<?php echo $this->session->flashdata('msg'); ?>
	</div>
	
	
    <!-- /.login-card-body -->
  </div>
  <div class="login-logo">
	<a href="https://play.google.com/store/apps/details?id=com.ibc24.newsflow" title="https://play.google.com/store/apps/details?id=com.ibc24.newsflow" target="_blank"><img class="img-fluid space-radius" src="<?php echo base_url('assets/images/downloadapp.png');?>"></a>
	
  </div>
 <div class="login-logo">
    <a class="space" href="#" title="IT-9630086049"><img class="img-fluid space-radius" src="<?php echo base_url('assets/images/social/Phone.jpg');?>"></a>
	<a class="space" href="#" title="it@ibc24.in"><img class="img-fluid space-radius" src="<?php echo base_url('assets/images/social/email-logo.jpg');?>"></a>
	<a class="space" href="https://www.youtube.com/channel/UCBc13XYipnBIBE3Ff8QaaGg" title="https://www.youtube.com/channel/UCBc13XYipnBIBE3Ff8QaaGg"><img class="img-fluid space-radius" src="<?php echo base_url('assets/images/youtube.png');?>"></a>
	<a class="space" href="https://www.facebook.com/IBC24" title="https://www.facebook.com/IBC24" target="_blank"><img class="img-fluid space-radius" src="<?php echo base_url('assets/images/social/Fb.jpg');?>"></a>
	<a class="space" href="https://twitter.com/IBC24News/twitter-buzz-2" title="https://twitter.com/IBC24News/twitter-buzz-2" target="_blank"><img class="img-fluid space-radius" src="<?php echo base_url('assets/images/social/twitter.jpg');?>"></a>
  </div>
  
</div>

<!-- /.login-box -->
<!--<div class="login-logo">
    <a class="space-matter" href="#" target="popup" onclick="window.open('https://www.ibc24.in','name','width=600,height=400')" title="https://www.ibc24.in">Visit IBC24 Website - Click Here</a><br/>
	<a class="space-matter" href="https://employee.ibc24.in" title="https://employee.ibc24.in" target="_blank">Visit Employee Portal - Click Here</a><br/>
	<a class="space-matter" href="https://mail.ibc24.in" title="https://mail.ibc24.in" target="_blank">Visit Microsoft Outlook - Click Here</a>
  </div>-->
 
 
  
  
  <script>

  $(document).ready(function(){
	var baseUrl = $('#baseUrl').val();
	$(document).on('click','#forgorpass',function(){
		var identity = $('#identity').val();
		if(identity.length > 0){
			$.ajax({
				url : baseUrl+'Auth/forgotPassword',
				data: {
					'identity' : identity
				},
				type: 'POST',
				dataType: 'json',
				success: function(response){
					if(response.status == 200){
						$('#forgot_password_error').html('<p class="text-info"><b>Password sent in your mail-Id.</b><p>').show();
					} else {
						$('#forgot_password_error').html('<p class="text-danger"><b>'+ response.msg +'</b><p>').show();
					}
				}
			});
		} else{
			$('#forgot_password_error').html('<p class="text-danger"><b>Plese enter Identity.</b><p>').show();
		}
	});
  });
  </script>
</body>