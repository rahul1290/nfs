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
            <h1>ASSIGNMENT FEED DETAIL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php echo base_url('Assign-Daily-Feed-Status');?>">Daily Feed Status</a></li>
              <li class="breadcrumb-item active">Assignment feed detail</li>
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
    						<td><b>Slug Name</b>
    						</td>
    						<td colspan="7">
    							<?= $sigalresultview[0]['SlugID']; ?>-
    							<span id="slug_copy">
    								<input type="hidden" id="feedId" class="col-5 form-control-plaintext" value="<?= $sigalresultview[0]['Sno']; ?>" />
        							<input type="hidden" id="slug_name" class="col-5 form-control-plaintext" value="<?= $sigalresultview[0]['SlugID'].'-'; ?>" />
        							<span>
        								<a href="javascript:void(0);" id="slug_btn">
        									<img src="<?php echo base_url('assets/images/Left.jpg');?>"/>
        								</a>
        							</span>
        							<label>Final Slug Name <span class="text-danger">*</span></label>
        							<input type="text" id="final_slug_name" name="final_slug_name" />
        							<span id="final_slug_name_error" class="text-danger" style="display: none;"></span>
    							</span>
    						</td>
    					</tr>
    					<tr>
    						<td><b>Anchor</b></td>
    						<td colspan="7">
    							<textarea class="form-control" rows="5" cols="" id="anchor"><?= $sigalresultview[0]['Description']; ?></textarea>
    						</td>
    					</tr>
    					<tr>
    						<td><b>VO</b></td>
    						<td colspan="7" style="word-break: break-word;">
    							<textarea class="form-control" rows="5" cols="" id="vo"><?= $sigalresultview[0]['VO']; ?></textarea>
    						</td>
    					</tr>
    					<tr>
    						<td><b>Byte</b></td>
    						<td colspan="7" style="word-break: break-word;">
    							<textarea class="form-control" rows="5" cols="" id="byte"><?= $sigalresultview[0]['Byte']; ?></textarea>
    						</td>
    					</tr>
    					<tr>
    						<td><b>Logsheet</b></td>
    						<td colspan="7" style="word-break: break-word;">
    							<textarea class="form-control" rows="5" cols="" id="logsheet"><?= $sigalresultview[0]['Logsheet']; ?></textarea>
    						</td>
    					</tr>
    					<tr>
    						<td><b>Clip</b></td>
    						<?php if(strlen($sigalresultview[0]['files'])){ ?>
    						<td colspan="7">
    							<?php  
    							$thumbs = explode(',',$sigalresultview[0]['thubm']);
    							$files = explode(',',$sigalresultview[0]['files']);
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
                                                     <img width="200" height="200" class="img-fluid" src="http://nfs.ibc24.in/uploads/<?php echo $sigalresultview[0]['Folder_Name']; ?>/<?php echo $thumbs[$key]; ?>"/>
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
                                                					src: "http://nfs.ibc24.in/uploads/<?php echo $sigalresultview[0]['Folder_Name']; ?>/<?php echo $files[$key]; ?>",
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
    					<tr>
    						<td>Status</td>
    						<td colspan="7">
    							<input value="Approve.jpg" class="status" name="status" type="radio" checked/> <span class="bg-success p-1">Send to input Editor</span>
    							<input value="Reject.jpg" class="status" name="status" type="radio" /> <span class="bg-danger p-1">Reject</span>
    						</td>
    					</tr>
    					<tr>
    						<td>Remark</td>
    						<td colspan="7">
    							<textarea id="remark" rows="4" class="form-control"></textarea>
    						</td>
    					</tr>
    					<tr>
    						<td></td>
    						<td colspan="7">
    							<input type="button" value="submit" class="btn btn-success" id="submit">
    							<input type="reset" value="Cancel" class="btn btn-default">
    						</td>
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