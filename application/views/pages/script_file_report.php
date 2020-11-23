<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SCRIPT FILE REPORT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php ?>">Reports</a></li>
              <li class="breadcrumb-item active">Script File Report</li>
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
			
			<form name="f1" method="POST" action="<?php echo base_url('Report/scriptFileReport')?>">
			  <div class="form-row align-items-center">
				<div class="col-auto">
				  From Date:
					<div class="input-group date" id="reservationdate" data-target-input="nearest">
						<input type="text" name="fromdate" id="fromdate" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?php if(isset($fromdate)){ echo $fromdate; } else { echo date('d/m/Y'); } ?>" />
						<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				</div>
				<div class="col-auto mt-2">
				  To Date:
				  <div class="input-group mb-2">
					<div class="input-group date" id="reservationdate1" data-target-input="nearest">
						<input type="text" name="todate" id="todate" class="form-control datetimepicker-input" data-target="#reservationdate1" value="<?php if(isset($fromdate)){ echo $todate; } else { echo date('d/m/Y'); } ?>" />
						<div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				  </div>
				</div>
				<div class="col-auto mt-4">
				  <button type="submit" class="btn btn-success mb-2">View</button>
				</div>
			  </div>
			</form>
			
			<hr>
			<?php if(isset($fileresults) && $this->session->userdata('role') == 'STRINGER'){ ?>
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="example1">
						<thead class="bg-dark text-light">
							<tr>
								<th>SNo.</th>
								<th>Date</th>
								<th>Slug Name</th>
								<th>ASSIGNMENT STATUS</th>
								<th>DETAIL</th>
							</tr>
						</thead>
						<tbody>
							<?php $c = 1; foreach($fileresults as $fileresult){?>
									<tr>
										<td><?= $c; ?></td>
										<td><?= date("d/m/Y", strtotime($fileresult['Date'])); ?></td>
										<td><?= $fileresult['SlugID']; ?></td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Assign_Status']; ?>">
											<br/><?= $fileresult['ASSIGNMENT_TIME']; ?>
										</td>
										<td><a target="_blank" href="<?= base_url('Report/scriptFileReport/').$fileresult['Sno'];?>">
											<img src="<?php echo base_url('assets/images/'); ?>viewMore.jpg" />
										</a></td>
									</tr>
							<?php $c++; } ?>
						</tbody>
					</table>
				</div>
			<?php } 
			
			else if(isset($fileresults) && $this->session->userdata('role') == 'REPORTER'){ ?>
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="example1">
						<thead class="bg-dark text-light">
							<tr>
								<th>SNo.</th>
								<th>Date</th>
								<th>Slug Name</th>
								<th>ASSIGNMENT STATUS</th>
								<th>VSAT STATUS</th>
								<th>INPUT STATUS</th>
								<th>EDITOR STATUS</th>
								<th>OUTPUT STATUS</th>
								<th>COPY STATUS</th>
								<th>VT EDITOR STATUS</th>
								<th>PUBLISH CLIP NAME</th>
								<th>EXPECTED ONAIR</th>
								<th>DETAIL</th>
							</tr>
						</thead>
						<tbody>
							<?php $c = 1; foreach($fileresults as $fileresult){?>
									<tr>
										<td><?= $c; ?></td>
										<td><?= date("d/m/Y", strtotime($fileresult['Date'])); ?></td>
										<td><?= $fileresult['SlugID']; ?></td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Assign_Status']; ?>">
											<br/><?= $fileresult['ASSIGNMENT_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Vsat_Status']; ?>">
											<br/><?= $fileresult['VSAT_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Input_Status'];?>">
											<br/><?= $fileresult['INPUT_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Editor_Status']; ?>">
											<br/><?= $fileresult['EDITOR_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Output_Status']; ?>">
											<br/><?= $fileresult['OUTPUT_TIME']; ?>
										</td>
										<td>
											<?= $fileresult['Format']; ?>
											<br/><?= $fileresult['COPY_TIME']; ?>
										</td>
										<td><img class="statusImg" src="<?= base_url('assets/images/').$fileresult['VTEditor_Status']; ?>"></td>
										<td><?= $fileresult['VTEditor_Publish']; ?></td>
										<td><?= substr($fileresult['Expected_OnAir'],0,8); ?></td>
										<td><a target="_blank" href="<?= base_url('Report/scriptFileReport/').$fileresult['Sno'];?>">
											<img src="<?php echo base_url('assets/images/'); ?>viewMore.jpg" />
										</a></td>
										
									</tr>
							<?php $c++; } ?>
						</tbody>
					</table>
				</div>
			<?php } 
			else if(isset($fileresults) && $this->session->userdata('role') == 'WEBTEAM'){ ?>
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="example1">
						<thead class="bg-dark text-light">
							<tr>
								<th>SNo.</th>
								<th>STATE</th>
								<th>SLUG NAME</th>
								<th>ASSIGNMENT STATUS</th>
								<th>VSAT STATUS</th>
								<th>INPUT STATUS</th>
								<th>EDITOR STATUS</th>
								<th>OUTPUT STATUS</th>
								<th>COPY STATUS</th>
								<th>VT EDITOR STATUS</th>
								<th>PUBLISH CLIP NAME</th>
								<th>EXPECTED ONAIR</th>
								<th>DETAIL</th>
							</tr>
						</thead>
						<tbody>
							<?php $c = 1; foreach($fileresults as $fileresult){?>
									<tr>
										<td><?= $c; ?></td>
										<td>
											<?php echo $fileresult['StateCode'];?>/
											<?php echo $fileresult['Location'];?>/
											<?php echo $fileresult['Name'];?>/
										</td>
										<td><?= $fileresult['SlugID']; ?></td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Assign_Status']; ?>">
											<br/><?= $fileresult['ASSIGNMENT_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Vsat_Status']; ?>">
											<br/><?= $fileresult['VSAT_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Input_Status'];?>">
											<br/><?= $fileresult['INPUT_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Editor_Status']; ?>">
											<br/><?= $fileresult['EDITOR_TIME']; ?>
										</td>
										<td>
											<img class="statusImg" src="<?= base_url('assets/images/').$fileresult['Output_Status']; ?>">
											<br/><?= $fileresult['OUTPUT_TIME']; ?>
										</td>
										<td>
											<?= $fileresult['Format']; ?>
											<br/><?= $fileresult['COPY_TIME']; ?>
										</td>
										<td><img class="statusImg" src="<?= base_url('assets/images/').$fileresult['VTEditor_Status']; ?>"></td>
										<td><?= $fileresult['VTEditor_Publish']; ?></td>
										<td><?= substr($fileresult['Expected_OnAir'],0,8); ?></td>
										<td><a target="_blank" href="<?= base_url('Report/scriptFileReport/').$fileresult['Sno'];?>">
											<img src="<?php echo base_url('assets/images/'); ?>viewMore.jpg" />
										</a></td>
										
									</tr>
							<?php $c++; } ?>
						</tbody>
					</table>
				</div>
			<?php } ?>
			
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