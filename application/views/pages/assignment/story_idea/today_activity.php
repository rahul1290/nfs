<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TODAY'S ACTIVITIES</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Story Idea</a></li>
              <li class="breadcrumb-item active">Today's activities</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

	<?php print_r($this->session->flashdata('msg'));?>

    
    <section class="">
	
      <!-- Default box -->
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
        
        	<ul class="nav nav-tabs" id="myTab" role="tablist">
          		<li class="nav-item" role="presentation">
            		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">CHATTISGARH</a>
          		</li>
          		<li class="nav-item" role="presentation">
            		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">MADHYA PRADESH</a>
          		</li>
        	</ul>
        	
        	<div class="tab-content" id="myTabContent">
      			<div class="tab-pane fade show active mt-4" id="home" role="tabpanel" aria-labelledby="home-tab">
      				<div class="row">
      					<div class="col-6">
        					<table class="table text-center table-striped" border="1" id="example1">
        						<thead>
            						<tr class="bg-success text-bold"><td colspan="5">CHATTISGARH [GREEN ZONE]</td></tr>
            						<tr id="cg_feeds_head" class="bg-dark text-light">
            							<td>LOCATION</td>
            							<td>NAME</td>
            							<td>TIME</td>
            							<td>SLUG NAME</td>
            							<td>DETAIL</td>
            						</tr>
        						</thead>
        						<tbody id="cg_feeds_body">
        							<?php foreach($feed['cg_green_zone'] as $cgfeed){ ?>
        								<tr>
            								<td><?php echo $cgfeed['Location']; ?></td>
            								<td><?php echo $cgfeed['Name']; ?></td>
            								<td><?php echo $cgfeed['Time']; ?></td>
            								<td><?php echo $cgfeed['SlugID']; ?></td>
            								<td><a target="_blank" href="<?php echo base_url('Assignment/feed-detail/').$cgfeed['Sno']; ?>"><i class="far fa-arrow nav-icon"></i><img src="<?php echo base_url('assets/images/');?>viewMore.jpg" /></a></td>
        								</tr>
        							<?php } ?>
        						</tbody>
        					</table>
      					</div>
      					
      					<div class="col-6">
        					<table class="table text-center table-striped" border="1" id="example2">
        						<thead>
            						<tr class="bg-danger text-bold"><td colspan="5">CHATTISGARH [RED ZONE]</td></tr>
            						<tr id="cg_feeds_head" class="bg-dark text-light">
            							<td>LOCATION</td>
            							<td>NAME</td>
            							<td>CONTACT NO</td>
            						</tr>
        						</thead>
        						<tbody id="cg_feeds_body">
        							<?php foreach($feed['cg_red_zone'] as $cgfeed){ ?>
        								<tr>
            								<td><?php echo $cgfeed['PLACE']; ?></td>
            								<td><?php echo $cgfeed['NAME']; ?></td>
            								<td><?php echo $cgfeed['CONTACTNO']; ?></td>
        								</tr>
        							<?php } ?>
        						</tbody>
        					</table>
      					</div>
      				</div>
      			</div>
      			
      			<!-- ////////////////////////////////////////////////
      			                           MP
      			//////////////////////////////////////////////////////// -->
      			
      			<div class="tab-pane fade mt-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      				<div class="row">
      					<div class="col-6">
      						<table class="table text-center table-striped" border="1" id="example3">
        						<thead>
            						<tr class="bg-success text-bold"><td colspan="5">MADHYA PRADESH [GREEN ZONE]</td></tr>
            						<tr class="bg-dark text-light">
            							<td>LOCATION</td>
            							<td>NAME</td>
            							<td>TIME</td>
            							<td>SLUG NAME</td>
            							<td>DETAIL</td>
            						</tr>
        						</thead>
        						<tbody>
        							<?php foreach($feed['mp_green_zone'] as $mpfeed){ ?>
        								<tr>
            								<td><?php echo $mpfeed['Location']; ?></td>
            								<td><?php echo $mpfeed['Name']; ?></td>
            								<td><?php echo $mpfeed['Time']; ?></td>
            								<td><?php echo $mpfeed['SlugID']; ?></td>
            								<td><a target="_blank" href="<?php echo base_url('Assignment/feed-detail/').$mpfeed['Sno']; ?>"><i class="far fa-arrow nav-icon"></i><img src="<?php echo base_url('assets/images/');?>viewMore.jpg" /></a></td>
        								</tr>
        							<?php } ?>
        						</tbody>
        					</table>
      					</div>
      					
      					<div class="col-6">
      						<table class="table text-center table-striped" border="1" id="example3">
        						<thead>
            						<tr class="bg-danger text-bold"><td colspan="5">MADHYA PRADESH [RED ZONE]</td></tr>
            						<tr class="bg-dark text-light">
            							<td>LOCATION</td>
            							<td>NAME</td>
            							<td>CONTACT NO</td>
            						</tr>
        						</thead>
        						<tbody>
        							<?php foreach($feed['mp_red_zone'] as $mpfeed){ ?>
        								<tr>
            								<td><?php echo $mpfeed['PLACE']; ?></td>
            								<td><?php echo $mpfeed['NAME']; ?></td>
            								<td><?php echo $mpfeed['CONTACTNO']; ?></td>
        								</tr>
        							<?php } ?>
        						</tbody>
        					</table>
      					</div>
      				</div>
      			</div>
      		</div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>
	
    <!-- /.content -->
  </div>
  
<script>
	$(document).ready(function(){
		var baseUrl = $('#baseUrl').val();
		$("#example1,#example2,#example3,#example4").DataTable({
			  "responsive": false,
			  "autoWidth": false,
			  //"searching": false,
			  "bSort": false
			});
	});
	

	
	
</script>