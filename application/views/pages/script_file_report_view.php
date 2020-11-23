<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SCRIPT FILE VIEW</h1>
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
    <!-- Main content -->
    <section class="">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"></h3>
		  </div>
        <div class="card-body">
			<?php if(isset($sigalresultview)){ ?>
				<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
						<td><b>State</b></td>
						<td><?= $sigalresultview[0]['StateCode']; ?></td>
						<td><b>Location</b></td>
						<td><?= $sigalresultview[0]['Location']; ?></td>
						<td><b>City Code</b></td>
						<td><?= $sigalresultview[0]['CityCode']; ?></td>
						<td><b>Name</b></td>
						<td><?= $sigalresultview[0]['Name']; ?></td>
					</tr>
					<tr>
						<td><b>Slug Name</b></td>
						<td colspan="7"><?= $sigalresultview[0]['SlugID']; ?></td>
					</tr>
					<tr>
						<td><b>Anchor</b></td>
						<td colspan="7" style="word-break: break-word;"><?= $sigalresultview[0]['Description']; ?></td>
					</tr>
					<tr>
						<td><b>VO</b></td>
						<td colspan="7" style="word-break: break-word;"><?= $sigalresultview[0]['VO']; ?></td>
					</tr>
					<tr>
						<td><b>Byte</b></td>
						<td colspan="7" style="word-break: break-word;"><?= $sigalresultview[0]['Byte']; ?></td>
					</tr>
					<tr>
						<td><b>Logsheet</b></td>
						<td colspan="7" style="word-break: break-word;"><?= $sigalresultview[0]['Logsheet']; ?></td>
					</tr>
					<tr>
						<td><b>Clip</b></td>
						<?php if(strlen($sigalresultview[0]['files'])){ ?>
						<td colspan="7">
							<?php  
							$thumbs = explode(',',$sigalresultview[0]['thubm']);
							$files = explode(',',$sigalresultview[0]['files']);
							if(count($thumbs)>0){
								foreach($thumbs as $key=>$t){ ?>
									<div class="col-xs-12 col-sm-2 col-lg-2 col-md-2" style="float:left;padding-left: 20px;">
									<img class="img-fluid" src="https://thumb.ibc24.in/<?php echo $t;?>"/>
									<br/><span><?php echo $files[$key]; ?></span>
									</div>
						<?php } } } ?>
						</td>
					</tr>
					<tr>
						<td><b>Ingest Id</b></td>
						<td colspan="7" class="bg-warning"><b><?= $sigalresultview[0]['SlugID']; ?> R1</b></td>
					</tr>
					<tr>
						<td><b>Assignment Status</b></td>
						<td><img class="statusImg" src="<?php echo base_url('assets/images/').$sigalresultview[0]['Assign_Status']; ?>"><?= $sigalresultview[0]['ASSIGNMENT_TIME']; ?></td>
						<td><b>Assignment Remarks</b></td>
						<td colspan="5"><?= $sigalresultview[0]['Assign_Remarks']; ?></td>
					</tr>
					<tr>
						<td><b>Input Status</b></td>
						<td><img class="statusImg" src="<?php echo base_url('assets/images/').$sigalresultview[0]['Input_Status']; ?>"><?= $sigalresultview[0]['INPUT_TIME']; ?></td>
						<td><b>Input Remarks</b></td>
						<td colspan="5"><?= $sigalresultview[0]['Input_Remarks']; ?></td>
					</tr>
					<tr>
						<td><b>Editor Status</b></td>
						<td><img class="statusImg" src="<?php echo base_url('assets/images/').$sigalresultview[0]['Editor_Status']; ?>"><?= $sigalresultview[0]['EDITOR_TIME']; ?></td>
						<td><b>Editor Remarks</b></td>
						<td colspan="5"><?= $sigalresultview[0]['Editor_Remarks']; ?></td>
					</tr>
					<tr>
						<td><b>VSat Status</b></td>
						<td><img class="statusImg" src="<?php echo base_url('assets/images/').$sigalresultview[0]['Vsat_Status']; ?>"><?= $sigalresultview[0]['VSAT_TIME']; ?></td>
						<td><b>VSat Remarks</b></td>
						<td colspan="5"><?= $sigalresultview[0]['Vsat_Remarks']; ?></td>
					</tr>
					<tr>
						<td><b>Output Status</b></td>
						<td><img class="statusImg" src="<?php echo base_url('assets/images/').$sigalresultview[0]['Output_Status']; ?>"><?= $sigalresultview[0]['OUTPUT_TIME']; ?></td>
						<td><b>Output Remarks</b></td>
						<td><?= $sigalresultview[0]['Output_Remarks']; ?></td>
						<td><b>Expected Onair</b></td>
						<td colspan="3"><?= substr($sigalresultview[0]['Expected_OnAir'],0,8); ?></td>
					</tr>
					<tr>
						<td><b>Copy Story Format</b></td>
						<td><?= $sigalresultview[0]['Format']; ?></td>
						<td><b>Copy Remarks</b></td>
						<td colspan="6"><?= $sigalresultview[0]['Copy_Remarks']; ?></td>
					</tr>
					<tr>
						<td><b>VTEditor Publish</b></td>
						<td colspan="8"><?= $sigalresultview[0]['VTEditor_Publish']; ?></td>
					</tr>
					<tr>
						<td><b>VT Editor Remarks</b></td>
						<td colspan="8"><?= $sigalresultview[0]['VTEditor_Remarks']; ?></td>
					</tr>
					<tr>
						<td><b>Video Quality</b></td>
						<td><?= $sigalresultview[0]['VT_VideoQuality']; ?></td>
						<td><b>Audio Quality</b></td>
						<td colspan="5"><?= $sigalresultview[0]['VT_AudioQuality']; ?></td>
					</tr>
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
	});
</script>