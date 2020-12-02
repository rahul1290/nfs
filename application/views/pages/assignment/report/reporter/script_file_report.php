<link href="<?php echo base_url('assets/css/');?>/video-js.css" rel="stylesheet">
<link href="http://vjs.zencdn.net/7.0/video-js.min.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/7.0/video.min.js"></script>

<script src="<?php echo base_url('assets/js/');?>/video.js"></script>
<script src="<?php echo base_url('assets/js/');?>/videojs-playlist.js"></script> 
<script>
var videoList = [];
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">  
            <h1>FEED DETAIL REPORT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Report</a></li>
              	<li class="breadcrumb-item"><a href="<?php echo base_url('Assignment/report/all-report');?>">All Report</a></li>
              <li class="breadcrumb-item active">Feed deatil report</li>
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
        	
        	<div id="video"></div>
        
			<?php if(isset($singleresultview)){ ?>
				<div class="table-responsive">
    				<table class="table table-bordered table-striped">
    					<tr>
    						<td><b>Name</b></td>
							<td><?= $singleresultview[0]['Name']; ?></td>
						</tr>
						<tr>
    						<td><b>Location</b></td>
    						<td><?= $singleresultview[0]['Location']; ?></td>
    					</tr>
    					<tr>
    						<td><b>City Code</b></td>
    						<td><?= $singleresultview[0]['CityCode']; ?></td>
    					</tr>
						<tr>
    						<td><b>State</b></td>
    						<td><?= $singleresultview[0]['StateCode']; ?></td>
    					</tr>
    					<tr>
    						<td><b>Slug&nbsp;Name</b>
    						</td>
    						<td colspan="9">
    							<?= $singleresultview[0]['SlugID']; ?>
    						</td>
    					</tr>
    					<tr>
    						<td><b>Script</b></td>
    						<td colspan="9">
    							<?= $singleresultview[0]['Description']; ?>
    						</td>
    					</tr>
    					<tr>
    						<td><b>Logsheet</b></td>
    						<td colspan="9" style="word-break: break-word;">
    							<?= $singleresultview[0]['Logsheet']; ?>
    						</td>
    					</tr>
    					<tr>
    						<td><b>Clip</b></td>
    						<?php if(strlen($singleresultview[0]['files'])){ ?>
    						<td colspan="9">
    							<?php  
    							$thumbs = explode(',',$singleresultview[0]['thubm']);
    							$files = explode(',',$singleresultview[0]['files']);
    							if(count($files)>0){ ?>
    							    	<span>Select All : <input type="checkbox" id="checkall" value="" checked></span>
    							    	<div class="row text-center">
    							    		<div class="offset-2 col-6 mb-4"><video class="video-js vjs-default-skin" controls width="640px" height="360px"></video>
        							     		<button class="previous">Previous</button>
        							     		<button class="next">Next</button>
        							    	</div>
        							    	<div class="col-2" style="max-height: 380px;overflow: scroll;overflow-x: hidden;">
        										<?php foreach($files as $key=>$t){
            								    $x = explode('.', $t);
            								    if(end($x) == 'mp4'){ ?>
            										<figure>
                                                      <img width="200" height="140" class="" src="https://thumb.ibc24.in/<?php echo $thumbs[$key];?>"/>
                                                      <figcaption>
                                                      	<?php echo $thumbs[$key]; ?>
                                                      </figcaption>
                                                    </figure>    
            								    <?php } }?>    		
											</div>
										</div>
										
										
										
    							    	<div class="">
            							  <?php foreach($files as $key=>$t){   
            								    $x = explode('.', $t);
            								    if(end($x) == 'jpg'){ ?>
            								        <figure class="col-2 float-left">
                                                     <img width="200" height="200" class="img-fluid" src="http://nfs.ibc24.in/uploads/<?php echo $singleresultview[0]['Folder_Name']; ?>/<?php echo $thumbs[$key]; ?>"/>
                                                      <figcaption>
                                                      	<input type="checkbox" class="thumCheckbox" value="" checked>
                                                      	<?php echo $thumbs[$key]; ?>
                                                      </figcaption>
                                                    </figure>
            								    <?php } else if(end($x) == 'mp4'){ ?>
            								        <script>
            								        	videoList.push(
                                                    		{
                                                				sources: [{
                                                					src: "http://nfs.ibc24.in/uploads/<?php echo $singleresultview[0]['Folder_Name']; ?>/<?php echo $files[$key]; ?>",
                                                   					type: 'video/mp4'
                                                 				}]
                                            				}
                                                	    );
                                                	</script>
            								    <?php } else { ?>
            										<figure class="col-2 float-left">
                                                      <img class="img-fluid" src="https://thumb.ibc24.in/<?php echo $thumbs[$key];?>"/>
                                                      <figcaption>
                                                      	<input type="checkbox" class="thumCheckbox" value="" checked>
                                                      	<?php echo $thumbs[$key]; ?>
                                                      </figcaption>
                                                    </figure>  
            									<?php } ?>
            								<?php  } ?>
    									</div> 
    									<?php } } ?>
    						</td>
    					</tr>
    					</table>
    					
    					<table class="offset-2 table table-bordered table-striped col-8">
    					<tr>
    						<td><b>Assignment Status</b></td>
    						<td>
    							<img class="statusImg" src="<?php echo base_url('assets/images/').$singleresultview[0]['Assign_Status']; ?>" />
    							<span><?= $singleresultview[0]['ASSIGNMENT_TIME']; ?></span>
    						</td>
    						<td><b>Assignment Remarks</b></td>
    						<td><?php echo $singleresultview[0]['Assign_Remarks']; ?></td>
    					</tr>
    					<tr>
    						<td><b>Input Status</b></td>
    						<td>
    							<img class="statusImg" src="<?php echo base_url('assets/images/').$singleresultview[0]['Input_Status']; ?>" />
    							<span><?php echo $singleresultview[0]['INPUT_TIME']; ?></span>
    						</td>
    						<td><b>Input Remarks</b></td>
    						<td><?php echo $singleresultview[0]['Input_Remarks']; ?></td>
    					</tr>
    					<tr>
    						<td><b>Editor Status</b></td>
    						<td>
    							<img class="statusImg" src="<?php echo base_url('assets/images/').$singleresultview[0]['Editor_Status']; ?>" />
    							<span><?php echo $singleresultview[0]['EDITOR_TIME']; ?></span>
    						</td>
    						<td><b>Editor Remarks</b></td>
    						<td><?php echo $singleresultview[0]['Editor_Remarks']; ?></td>
    					</tr>
    					<tr>
    						<td><b>VSat Status</b></td>
    						<td>
    							<img class="statusImg" src="<?php echo base_url('assets/').$singleresultview[0]['Vsat_Status']; ?>" />
    							<span><?php echo $singleresultview[0]['VSAT_TIME']; ?></span>
    						</td>
    						<td><b>	VSat Remarks</b></td>
    						<td><?php echo $singleresultview[0]['Vsat_Remarks']; ?></td>
    					</tr>
    					<tr>
    						<td><b>Output Status</b></td>
    						<td>
    							<img class="statusImg" src="<?php echo base_url('assets/images/').$singleresultview[0]['Output_Status']; ?>" />
    							<span><?php echo $singleresultview[0]['OUTPUT_TIME']; ?></span>
    						</td>
    						<td><b>Output Remarks</b></td>
    						<td><?php echo $singleresultview[0]['Output_Remarks']; ?></td>
    					</tr>
    					<tr>
    						<td colspan="2"><b>Expected Onair</b></td>
    						<td colspan="2"><?php echo substr($singleresultview[0]['Expected_OnAir'],0,8); ?></td>
    					</tr>
    					<tr>
    						<td><b>Copy Story Format</b></td>
    						<td>
    							<img class="statusImg" src="<?php echo base_url('assets/').$singleresultview[0]['Copy_Status']; ?>" />
    							<span><?php echo substr($singleresultview[0]['Copy_Date'],11,5); ?></span>
    						</td>
    						<td><b>Copy Remarks</b></td>
    						<td><?php echo $singleresultview[0]['Copy_Remarks']; ?></td>
    					</tr>
    					<tr>
    						<td><b>VTEditor Statua</b></td>
    						<td>
    							<img class="statusImg" src="<?php echo base_url('assets/').$singleresultview[0]['VTEditor_Status']; ?>" />
    						</td>
    						<td><b>VT Editor Remarks</b></td>
    						<td><?php echo $singleresultview[0]['VTEditor_Remarks']; ?></td>
    					</tr>
    					<tr>
    						<td colspan="10" class="text-center">
    							<img class="img-fluid" src="<?php echo base_url('assets/images/indicator.jpg')?>" />
    						</td>
    					<tr>
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
		var baseUrl = $('#baseUrl').val();
		var fSlug = false;
		
		$(document).on('click','#slug_btn',function(){
			$('#final_slug_name').val($('#slug_name').val());
		});

		$(document).on('click','.status',function(){
			if($(this).val() != 'Approve.jpg'){
				$('#slug_copy').hide();
			} else {
				$('#slug_copy').show();
			}
		});
		
		$(document).on('click','#checkall',function(){
			if($(this).checked){
				alert('sds');
			} else {
				alert('asd');	
			}
		});

		$(document).on('click','#submit',function(){
			debugger;
			var formValid = true;
			var x = $("input[name='status']:checked").val();
			var fslug = '';
			if(x == 'Approve.jpg'){
				fslug = $('#final_slug_name').val();
				if(parseInt($('#final_slug_name').val().length) <= 0){
					$('#final_slug_name_error').html('Final slug name required').show();
					formValid = false;
					fSlug = false;			
				} else {
					$('#final_slug_name_error').html('').hide();
					formValid = true;
					fSlug = true;
				}
			} else {
				fslug = '';
			}

			if(formValid && fSlug){
				$.ajax({
					url : baseUrl + 'Assignment_ctrl/assign_feed_detail_submit',
					type : 'POST',
					dataType : 'json',
					data : {
						'feedId' : $('#feedId').val(),
						'fslug' : fslug,
						'status' : x,
						'anchor' : $('#anchor').val(),
						'vo' : $('#vo').val(),
						'byte' : $('#byte').val(),
						'logsheet' : $('#logsheet').val(),
						'remark' : $('#remark').val()  
					},
					success:function(response){
						if(response.status == 200){
							alert(response.msg);
							window.location.replace(baseUrl + 'Assignment/Daily-Feed-Status/CG/green/MP/green');
						}
					}
				});
			} else {
				alert('Check slug name.');
				$('#final_slug_name_error').html('Final slug already exist').show();
			}
		});

		
		$(document).on('keyup','#final_slug_name',function(){
			var slug  = $(this).val();
			$.ajax({
				url : baseUrl + 'Assignment_ctrl/check_slug',
				type : 'POST',
				dataType : 'json',
				data : {
					'slug' : slug
				},
				success :function(response){
					if(response.status == 200){
						$('#final_slug_name_error').html('Final slug already exist').show();
					} else {
						$('#final_slug_name_error').html('').hide();
						fSlug = true;
					}
				}
			});
		});


        var player = videojs(document.querySelector('video'), {
          inactivityTimeout: 0,
    	  autoplay:true,
    	  autoadvance: 0
        });
    
        try {
          // try on ios
          player.volume(0);
        } catch (e) {}
    
        player.on([
          'duringplaylistchange',
          'playlistchange',
          'beforeplaylistitem',
          'playlistitem',
          'playlistsorted'
        ], function(e) {
          videojs.log('player saw "' + e.type + '"');
        });
    
        player.playlist(videoList);
    	
        document.querySelector('.previous').addEventListener('click', function() {
          player.playlist.previous();
        });
    
        document.querySelector('.next').addEventListener('click', function() {
          player.playlist.next();
        });
    
        Array.prototype.forEach.call(document.querySelectorAll('[name=autoadvance]'), function(el) {
          el.addEventListener('click', function() {
            var value = document.querySelector('[name=autoadvance]:checked').value;
            player.playlist.autoadvance(Number(value));
          });
        });
    
        document.querySelector('[name="autoadvance"][value="null"]').click();
    
        var repeatCheckbox = document.querySelector('.repeat');
    
        repeatCheckbox.addEventListener('click', function() {
          player.playlist.repeat(this.checked);
        });
    
        repeatCheckbox.checked = false;
      
		
	});
</script>