<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STORY IDEA VIEW</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php ?>">Entry Form</a></li>
              <li class="breadcrumb-item active">Story Idea</li>
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
				<table class="table table-bordered">
					<tr>
						<td><b>State</b></td>
						<td><?= $storyideaview[0]['StateCode']; ?></td>
						<td><b>Location</b></td>
						<td><?= $storyideaview[0]['Location']; ?></td>
						<td><b>CityCode</b></td>
						<td><?= $storyideaview[0]['CityCode']; ?></td>
						<td><b>Name</b></td>
						<td><?= $storyideaview[0]['Name']; ?></td>
					</tr>
					<tr>
						<td><b>Story Idea ID</b></td>
						<td colspan="9"><?= $storyideaview[0]['StoryIdeaID']; ?></td>
					</tr>
					<tr>
						<td><b>Story Name</b></td>
						<td colspan="9"><?= $storyideaview[0]['StoryID']; ?></td>
					</tr>
					<tr>
						<td><b>Script</b></td>
						<td colspan="9"><?= $storyideaview[0]['Description']; ?></td>
					</tr>
					<tr>
						<td><b>Status</b></td>
						<td colspan="9"><?= $storyideaview[0]['Approval_Status']; ?></td>
					</tr>
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