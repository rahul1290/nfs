<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STORY IDEA REPORT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php ?>">Report</a></li>
              <li class="breadcrumb-item active">Story Idea Report</li>
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
        <div class="card-header">
          <h3 class="card-title"></h3>
		  </div>
        <div class="card-body">
		
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="example1">
					<thead class="bg-dark">
						<tr>
							<th>STORY IDEA ID</th>
							<th>DATE</th>
							<th>LOCATION</th>
							<th>NAME</th>
							<th>STORY NAME</th>
							<th>SCRIPT</th>
							<th>APPROVAL STATUS</th>
							<th>APPROVAL REMARKS</th>
							<th>DETAIL</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($storyideas as $storyidea){ ?>
						<tr>
							<td><?php echo $storyidea['StoryIdeaID']; ?></td>
							<td><?php echo  date("d/m/Y", strtotime($storyidea['Date'])); ?></td>
							<td><?php echo $storyidea['Location']; ?></td>
							<td><?php echo $storyidea['Name']; ?></td>
							<td><?php echo $storyidea['StoryID']; ?></td>
							<td ><?php echo $storyidea['Description']; ?></td>
							<td><?php echo $storyidea['Approval_Status']; ?></td>
							<td><?php echo $storyidea['Approval_Remarks']; ?></td>
							<td><a target="_blank" href="<?php echo base_url('Report/storyIdeaReport/').$storyidea['Sno']; ?>"><i class="far fa-arrow nav-icon"></i><img src="<?php echo base_url('assets/images/');?>viewMore.jpg" /></a></td>
						</tr>	
					<?php } ?>
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
		 $("#example1").DataTable({
			  "responsive": false,
			  "autoWidth": false,
			  "bSort": false,
			  aoColumns : [
				{ sWidth: '5%' },
				{ sWidth: '5%' },
				{ sWidth: '10%' },
				{ sWidth: '10%' },
				{ sWidth: '10%' },
				{ sWidth: '30%' },
				{ sWidth: '10%' },
				{ sWidth: '10%' },
				{ sWidth: '10%' }
			  ]
			});
	});
</script>