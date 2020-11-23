<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>YESTERDAY DASHBOARD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Story Idea</a></li>
              <li class="breadcrumb-item active">Yesterday dashboard</li>
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
			<div class="row">

    			<table class="offset-3 col-6 table text-center table-striped" border="1">
    				<thead>
    					<tr id="cg_feeds_head" class="bg-info text-light text-bold">
    						<td>DATE</td>
    						<td>APPROVED</td>
    						<td>REJECTED</td>
    						<td>NOT SEEN</td>
    						<td>TOTAL</td>
    					</tr>
    				</thead>
    				<tbody id="cg_feeds_body">
    					<tr>
    						<td><?php echo $feed[0]['Date']; ?></td>
    						<td><a href="#"><?php echo $feed[0]['Approved']; ?></a></td>
    						<td><a href="#"><?php echo $feed[0]['Rejected']; ?></a></td>
    						<td><a href="#"><?php echo $feed[0]['NotSeen']; ?></a></td>
    						<td><?php echo $feed[0]['Total']; ?></td>
    					</tr>
    				</tbody>
    			</table>
					
				
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
	});
	

	
	
</script>