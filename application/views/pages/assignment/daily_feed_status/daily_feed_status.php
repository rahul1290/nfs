<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DAILY FEED STATUS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
              <li class="breadcrumb-item active">Daily feed status</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

	<?php print_r($this->session->flashdata('msg'));?>

    <!-- Main content -->
    <section class="">

      <!-- Default box -->
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
			<div class="row">
				<div class="col-6">
					<div id="cg_green_zone_table" style="display:<?php if($this->uri->segment('4') == 'green'){ echo 'inline'; } else { echo "none"; }?>">
    					<table class="table text-center table-striped" border="1" id="example1">
    						<thead>
        						<tr class="bg-info text-bold"><td colspan="5">CHHATTISGARH</td></tr>
        						<tr class="bg-success">
        							<td colspan="5">
        								SWITCH TO &nbsp;
        								<a class="btn btn-danger" href="<?php echo base_url('Assignment/Daily-Feed-Status/CG/red/MP/').$this->uri->segment(6); ?>">RED ZONE</a>
        							</td>
        						</tr>
        						<tr id="cg_feeds_head" class="bg-dark text-light">
        							<td>LOCATION</td>
        							<td>NAME</td>
        							<td>TIME</td>
        							<td>SLUG NAME</td>
        							<td>DETAIL</td>
        						</tr>
    						</thead>
    						<tbody id="cg_feeds_body">
    							<?php foreach($feed['cg_feed'] as $cgfeed){ ?>
    								<tr>
        								<td><?php echo $cgfeed['Location']; ?></td>
        								<td><?php echo $cgfeed['Name']; ?></td>
        								<td><?php echo $cgfeed['Time']; ?></td>
        								<td><?php echo $cgfeed['SlugID']; ?></td>
        								<td><a target="_blank" href="<?php echo base_url('Assignment/Daily-Feed-Status/').$cgfeed['Sno']; ?>"><i class="far fa-arrow nav-icon"></i><img src="<?php echo base_url('assets/images/');?>viewMore.jpg" /></a></td>
    								</tr>
    							<?php } ?>
    						</tbody>
    					</table>
					</div>
					
					<div id="cg_red_zone_table" style="display:<?php if($this->uri->segment('4') == 'red'){ echo 'inline'; } else { echo "none"; }?>">
    					<table class="table text-center table-striped" border="1" id="example2">
    						<thead>
        						<tr class="bg-info text-bold"><td colspan="5">CHHATTISGARH</td></tr>
        						<tr class="bg-danger">
        							<td colspan="5">
        								SWITCH TO &nbsp;
        								<a class="btn btn-success" href="<?php echo base_url('Assignment/Daily-Feed-Status/CG/green/MP/').$this->uri->segment(6); ?>">GREEN ZONE</a>
        							</td>
        						</tr>
        						<tr id="cg_feeds_head" class="bg-dark text-light">
        							<td>LOCATION</td>
        							<td>NAME</td>
        							<td>CONTACT NO</td>
        						</tr>
    						</thead>
    						<tbody id="cg_feeds_body">
    							<?php foreach($feed['cg_feed_red_zone'] as $cgredfeed){ ?>
    								<tr>
        								<td><?php echo $cgredfeed['PLACE']; ?></td>
        								<td><?php echo $cgredfeed['NAME']; ?></td>
        								<td><?php echo $cgredfeed['CONTACTNO']; ?></td>
    								</tr>
    							<?php } ?>
    						</tbody>
    					</table>
					</div>
				</div>
				
				
				
				
				
				
				<div class="col-6">
					<div id="mp_green_zone_table" style="display: <?php if($this->uri->segment('6') == 'green'){ echo 'inline'; }else { echo 'none'; }?>">
    					<table class="table text-center table-striped" border="1" id="example3">
    						<thead>
        						<tr class="bg-info text-bold"><td colspan="5">MADHYA PRADESH</td></tr>
        						<tr class="bg-success">
        							<td colspan="5">
        								SWITCH TO &nbsp;
        								<a class="btn btn-danger" href="<?php echo base_url('Assignment/Daily-Feed-Status/CG/').$this->uri->segment('6').'/MP/red'; ?>">RED ZONE</a>
        							</td>
        						</tr>
        						<tr class="bg-dark text-light">
        							<td>LOCATION</td>
        							<td>NAME</td>
        							<td>TIME</td>
        							<td>SLUG NAME</td>
        							<td>DETAIL</td>
        						</tr>
    						</thead>
    						<tbody>
    							<?php foreach($feed['mp_feed'] as $mpfeed){ ?>
    								<tr>
        								<td><?php echo $mpfeed['Location']; ?></td>
        								<td><?php echo $mpfeed['Name']; ?></td>
        								<td><?php echo $mpfeed['Time']; ?></td>
        								<td><?php echo $mpfeed['SlugID']; ?></td>
        								<td><a target="_blank" href="<?php echo base_url('Assignment/Daily-Feed-Status/').$mpfeed['Sno']; ?>"><i class="far fa-arrow nav-icon"></i><img src="<?php echo base_url('assets/images/');?>viewMore.jpg" /></a></td>
    								</tr>
    							<?php } ?>
    						</tbody>
    					</table>
					</div>
					
					<div id="mp_red_zone_table"  style="display: <?php if($this->uri->segment('6') == 'red'){ echo 'inline'; }else { echo 'none'; }?>">
    					<table class="table text-center table-striped" border="1" id="example2">
    						<thead>
        						<tr class="bg-info text-bold"><td colspan="5">MADHYA PRADESH</td></tr>
        						<tr class="bg-danger">
        							<td colspan="5">
        								SWITCH TO &nbsp;
        								<a class="btn btn-success" href="<?php echo base_url('Assignment/Daily-Feed-Status/CG/').$this->uri->segment('4').'/MP/green'; ?>">GREEN ZONE</a>
        							</td>
        						</tr>
        						<tr class="bg-dark text-light">
        							<td>LOCATION</td>
        							<td>NAME</td>
        							<td>CONTACT NO</td>
        						</tr>
    						</thead>
    						<tbody>
    							<?php foreach($feed['mp_feed_red_zone'] as $mpredfeed){ ?>
    								<tr>
        								<td><?php echo $mpredfeed['PLACE']; ?></td>
        								<td><?php echo $mpredfeed['NAME']; ?></td>
        								<td><?php echo $mpredfeed['CONTACTNO']; ?></td>
    								</tr>
    							<?php } ?>
    						</tbody>
    					</table>
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
		var cgZone = 'green';
		var mpZone = 'red';
		
		 $("#example1,#example2,#example3,#example4").DataTable({
			  "responsive": false,
			  "autoWidth": false,
			  //"searching": false,
			  "bSort": false
			});

		 setInterval(function(){
			location.reload();
		}, 36000);
	});

	
	
</script>