<!DOCTYPE html>
<html>
<?php if(isset($header)){ print_r($header); }?>

<body class="hold-transition sidebar-mini">
<input type="hidden" id="baseUrl" value="<?php echo base_url();?>" />

<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php if(isset($topnavbar)){ print_r($topnavbar); }?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php if(isset($sidenavbar)){ print_r($sidenavbar); }?>

  <!-- Content Wrapper. Contains page content -->
<div class="main-header" style="padding: 0px;">
  	<section class="">
      	<div class="card">
        	<div class="card-header" style="background-color: transparent;">
          		<div class="input-group input-group-sm">
            		<?php if($this->uri->segment(1) == 'search'){
            		    $str = $this->uri->segment('2');
            		} else {
            		    $str = '';
            		}
            		?>
        			<input id="search" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" value="<?= $str; ?>">
        			<div class="input-group-append">
          				<button class="btn btn-navbar" id="btn-search" type="button" style="background-color: #00000024;">
        					<i class="fas fa-search" style="font-size:large !important;"></i>
          				</button>
        			</div>
        		</div>
			</div>
		</div>
	</section>
</div>
		
  
  <?php if(isset($body)){ print_r($body); }?>
  <!-- /.content-wrapper -->

  <?php if(isset($footer)){ print_r($footer); }?>
  <!-- /.control-sidebar -->
</div>

</body>
</html>
