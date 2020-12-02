<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TODAY'S ACTIVITY</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php ?>">Reports</a></li>
              <li class="breadcrumb-item active">Script File Dashboard</li>
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
        <div class="card-header text-center">
		  <img class="img-fluid" src="<?php echo base_url('assets/images/indicator.jpg')?>" />
		  </div>
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
      			<table class="table table-bordered table-striped" id="example1">
      				<thead>
      					<tr class="bg-dark text-center">
          					<th>SNO.</th>
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
      				<tbody class="text-center">
      					<?php $c=1; foreach($activities as $activity){
      					    if($activity['StateCode'] != 'CG'){ 
      					        continue;
      					    }
      					?>	
      						<tr>
          						<td><?php echo $c++; ?>.</td>
          						<td><?php echo '<span class="text-danger text-bold">'.$activity['StateCode'].'</span><br/><span class="text-primary text-bold">'.$activity['Location'].'</span><br/><small>'.$activity['Name'].'</small>'; ?></td>
          						<td><?php echo '<span class="text-primary text-bold">'.$activity['SlugID'].'</span><br/><span class="text-danger text-bold">'.substr($activity['Time'],0,8).'</span>'; ?></td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Assign_Status']; ?>" />
          							<br/><span class="text-bold text-danger"><?php echo $activity['Assign_Date1']; ?></span>
          							<br/><small><?php echo $activity['Assign_ID']; ?></small>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/'.$activity['Vsat_Status']); ?>" /><br/>
          							<span class="text-bold text-danger"><?php echo $activity['Vsat_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Input_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['Input_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/'.$activity['Editor_Status']); ?>" />
          							<br/><span class="text-bold text-danger"><?php echo $activity['Editor_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Output_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['Output_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Copy_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['Copy_Date1']; ?></span>
          							<br/><small><?php echo $activity['Copy_ID']; ?></small>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['VTEditor_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['VTEditor_Date1']; ?></span>
          							<br/><small><?php echo $activity['VTEditor_ID']; ?></small>
          							
								</td>
          						<td><?php echo $activity['VTEditor_Publish']; ?></td>
          						<td class="text-success text-bold"><?php echo substr($activity['Expected_OnAir'],0,8); ?></td>
          						<td>
          							<a target="_blank" href="<?= base_url('Assignment/report/scriptFileReport/').$activity['Sno'];?>">
										<img src="<?php echo base_url('assets/images/'); ?>viewMore.jpg" />
									</a>
								</td>
      						</tr>
      					<?php } ?>
      				</tbody>
      			</table>
      		</div>
      		
      		
      		<!-- ///////////////////////
      		            MP 
      		    ///////////////////////
      		-->
      		<div class="tab-pane fade mt-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      			<table class="table table-bordered table-striped" id="example2">
      				<thead>
      					<tr class="bg-dark text-center">
          					<th>SNO.</th>
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
      				<tbody class="text-center">
      					<?php $c=1; foreach($activities as $activity){
      					    if($activity['StateCode'] != 'MP'){ 
      					        continue;
      					    }
      					?>	
      						<tr>
          						<td><?php echo $c++; ?>.</td>
          						<td><?php echo '<span class="text-danger text-bold">'.$activity['StateCode'].'</span><br/><span class="text-primary text-bold">'.$activity['Location'].'</span><br/><small>'.$activity['Name'].'</small>'; ?></td>
          						<td><?php echo '<span class="text-primary text-bold">'.$activity['SlugID'].'</span><br/><span class="text-danger text-bold">'.substr($activity['Time'],0,8).'</span>'; ?></td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Assign_Status']; ?>" />
          							<br/><span class="text-bold text-danger"><?php echo $activity['Assign_Date1']; ?></span>
          							<br/><small><?php echo $activity['Assign_ID']; ?></small>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/'.$activity['Vsat_Status']); ?>" /><br/>
          							<span class="text-bold text-danger"><?php echo $activity['Vsat_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Input_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['Input_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/'.$activity['Editor_Status']); ?>" />
          							<br/><span class="text-bold text-danger"><?php echo $activity['Editor_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Output_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['Output_Date1']; ?></span>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['Copy_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['Copy_Date1']; ?></span>
          							<br/><small><?php echo $activity['Copy_ID']; ?></small>
          						</td>
          						<td>
          							<img class="statusImg" src="<?php echo base_url('assets/images/').$activity['VTEditor_Status']; ?>"/>
          							<br/><span class="text-bold text-danger"><?php echo $activity['VTEditor_Date1']; ?></span>
          							<br/><small><?php echo $activity['VTEditor_ID']; ?></small>
          							
								</td>
          						<td><?php echo $activity['VTEditor_Publish']; ?></td>
          						<td class="text-success text-bold"><?php echo substr($activity['Expected_OnAir'],0,8); ?></td>
          						<td>
          							<a target="_blank" href="<?= base_url('Assignment/report/scriptFileReport/').$activity['Sno'];?>">
										<img src="<?php echo base_url('assets/images/'); ?>viewMore.jpg" />
									</a>
								</td>
      						</tr>
      					<?php } ?>
      				</tbody>
      			</table>
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
		 $("#example1,#example2").DataTable({
			  "responsive": false,
			  "autoWidth": false,
			  "bSort": false
			});
	});
</script>