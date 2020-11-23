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
  <?php if(isset($body)){ print_r($body); }?>
  <!-- /.content-wrapper -->

  <?php if(isset($footer)){ print_r($footer); }?>
  <!-- /.control-sidebar -->
</div>

</body>
</html>
