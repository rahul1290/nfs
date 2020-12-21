<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>SEARCH LIST</h1>
          </div>
		  <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php ?>">Search string</a></li>
              <li class="breadcrumb-item active"><?php echo $this->uri->segment('2'); ?></li>
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
						<thead class="bg-dark text-light">
							<tr>
								<th>SNo.</th>
								<th>TIME</th>
								<th>LOCATION</th>
								<th>NAME</th>
								<th>SLUG NAME</th>
								<th>SCRIPT</th>
								<th>LOG SHEET</th>
								<th>ASSIGNMENT STATUS</th>
								<th>INPUT STATUS</th>
								<th>EDITOR STATUS</th>
								<th>OUTPUT STATUS</th>
								<th>EXPECTED ONAIR</th>
								<th>DETAIL</th>
							</tr>
						</thead>
						<tbody>
							<?php $c = 1; foreach($fileresults as $fileresult){?>
									<tr>
										<td><?= $c; ?></td>
										<td><?= $fileresult['Time']; ?></td>
										<td><?= $fileresult['Location']; ?></td>
										<td><?= $fileresult['Name']; ?></td>
										<td><?= $fileresult['SlugID']; ?></td>
										<td><?= $fileresult['DESCRIPTION1']; ?></td>
										<td><?= $fileresult['Logsheet']; ?></td>
										
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Assign_Status']; ?>">
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Input_Status']; ?>">
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Editor_Status'];?>">
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Output_Status']; ?>">
										</td>
										<td><?= substr($fileresult['Expected_OnAir'],0,8); ?></td>
										<td><a target="_blank" href="<?= base_url('Report/scriptFileReport/').$fileresult['Sno'];?>">
											<img src="<?php echo base_url('assets/images/'); ?>viewMore.jpg" />
										</a></td>
										
									</tr>
							<?php $c++; } ?>
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
			  "bSort": false
			});
			
		$('#reservationdate').datetimepicker({
			format: 'DD/MM/YYYY'
		});
		$('#reservationdate1').datetimepicker({
			format: 'DD/MM/YYYY'
		});
	});
</script>