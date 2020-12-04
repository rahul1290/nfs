<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STRINGER SUMMARY</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="#">Report</a></li>
              <li class="breadcrumb-item active">All Stringer</li>
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
        		<table class="table">
        			<tr>
        				<td>Date Between:</td>
        				<td>
        					<div class="row">
            					<div class="col input-group date mb-2" id="reservationdate" data-target-input="nearest">
    								<input type="text" name="fromdate" id="fromdate" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?php if($this->uri->segment(4) != ''){ echo date('d/m/Y',strtotime($this->uri->segment(4))); } else { echo date('01/m/Y'); } ?>" />
    								<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
    									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
    								</div>
    							</div>
    							
    							<div class="col input-group mb-2">
        							<div class="input-group date" id="reservationdate1" data-target-input="nearest">
        								<input type="text" name="todate" id="todate" class="form-control datetimepicker-input" data-target="#reservationdate1" value="<?php if($this->uri->segment(6) != ''){ echo $this->uri->segment(6); } else { echo date('d/m/Y'); }?>" />
        								<div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
        									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
        								</div>
        							</div>
        				  		</div>
    				  		</div>
        				</td>
        			</tr>
        			<tr>
    					<td>State</td>
        				<td>
        					<select class="form-control" id="state">
        						<option value="CG" selected>CG</option>
        						<option value="MP">MP</option>
        					</select>
        				</td>
					</tr>    
					<tr>					
    					<td>Location</td>
        				<td>
        					<select class="form-control" id="location">
        						<option value="">Select location</option>
        						<?php foreach($locations as $location){ ?>
        							<option value="<?php echo $location['place']; ?>"><?php echo $location['place']; ?></option>
        						<?php } ?>
        					</select>
        				</td>
        			</tr>
        			<tr>
        				<td></td>
        				<td>
        					<input class="btn btn-success" type="button" id="view" name="submit" value="View" />
        					<input class="btn btn-default" type="button" name="submit" value="Reset" />
        				</td>
        			</tr>
        		</table>
        	</div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </section>
    
    
    <section>
    <div class="card">
        <div class="card-header bg-secondary" style="border-radius: 0px;">
          <h3 class="card-title"></h3>
		</div>
        <div class="card-body">
        	<div class="row">
        		<div class="col-3 table-responsive" id="stringer_feeds"></div>
        		<div class="col-9">
        			<div id="accordion"></div>
        		</div>
        	</div>
        </div>
  	</div>
    	
    </section>
	
    <!-- /.content -->
  </div>
<script>
	$(document).ready(function(){	
		var baseUrl = $('#baseUrl').val();

		 $("#example1").DataTable({
			  "responsive": false,
			  "autoWidth": false,
			  "bSort": false,
			  "searching": false,
			});

			
		$('#reservationdate').datetimepicker({
			format: 'DD/MM/YYYY'
		});
		$('#reservationdate1').datetimepicker({
			format: 'DD/MM/YYYY'	
		});


		$(document).on('change','#location',function(){
			var location = $(this).val();
			$.ajax({
				url : baseUrl+'Assignment_ctrl/reporter_location_wise',
				type : 'POST',
				dataType : 'json',
				data : {
					'location':location
				},
				success:function(response){
					if(response.status == 200){
						var x = '<option value="">--Select Reporter--</option>';
						$.each(response.data,function(key,value){
							x = x + '<option value="'+ value.UID +'">'+ value.NAME +'</option>';
						});

						$('#reporter').html(x);
					}
				}
			});
		});


		$(document).on('click','.feedsummary',function(){
			var uid = $(this).data('uid');
			$('#stringer_feeds tr').removeClass('bgColor');
			$(this).closest('tr').addClass('bgColor');
			feedList(uid);			
		});


		function feedList(uid){
			$.ajax({
				url : baseUrl + 'Assignment_ctrl/stringer_feed_list_dateWise',
				type : 'POST',
				dataType : 'json',
				data : {
					'uid' : uid,
					'fromdate' : $('#fromdate').val(),
					'todate' : $('#todate').val()
				},
				beforeSend:function(){
					
				},
				success:function(response){
					if(response.status == 200){
					var x = '<table class="table table-bordered table-striped" id="example2">'+
					'<thead>'+
						'<tr class="bg-dark text-center">'+
								'<th>STATE</th>'+
								'<th>SLUG NAME</th>'+
								'<th>ASSIGNMENT STATUS</th>'+
								'<th>VSAT STATUS</th>'+
								'<th>INPUT STATUS</th>'+
								'<th>EDITOR STATUS</th>'+
								'<th>OUTPUT STATUS</th>'+
								'<th>COPY STATUS</th>'+
								'<th>VT EDITOR STATUS</th>'+	
								'<th>PUBLISH CLIP NAME</th>'+
								'<th>EXPECTED ONAIR</th>'+
								'<th>DETAIL</th>'+
						'</tr>'+
					'</thead>'+
					'<tbody class="text-center">';
					$.each(response.data,function(key,value){
						x = x + '<tr>'+
								'<td><span class="text-danger text-bold">'+ value.StateCode +'</span><br/><span class="text-primary text-bold">'+ value.Location +'</span><br/><small>'+ value.Name +'</small></td>'+
								'<td><span class="text-primary text-bold">'+ value.SlugID +'</span><br/><span class="text-danger text-bold">'+ value.Time.substr(0,8) +'</span></td>'+
								'<td>';

								if(value.Assign_Date1 != null){
									y = value.Assign_Status;
								} else {
									y = '';
								}

								if(value.Assign_ID != null){
									y1 = value.Assign_ID;
								} else {
									y1 = '';
								}
								
		  						x = x + '<img class="statusImg" src="'+ baseUrl +'assets/images/' + value.Assign_Status +'"/>'+
		  							'<br/><span class="text-bold text-danger">'+ y +'</span>'+
		  							'<br/><small>'+ y1 +'</small>'+
		  						'</td>'+
		  						'<td>';

		  						if(value.Vsat_Date1 != null){
									y = value.Vsat_Date1;
								} else {
									y = '';
								}

		  						x = x + '<img class="statusImg" src="'+ baseUrl +'assets/images/' + value.Vsat_Status +'"/><br/>'+
		  							'<span class="text-bold text-danger">'+ y +'</span>'+
		  						'</td>'+
		  						'<td>';
		  						if(value.Input_Date1 != null){
									y = value.Input_Date1;
								} else {
									y = '';
								}

		  						x = x + '<img class="statusImg" src="'+ baseUrl +'assets/images/'+ value.Input_Status +'"/>'+
		  							'<br/><span class="text-bold text-danger">'+ y + '</span>'+
		  						'</td>'+
		  						'<td>';
		  						if(value.Editor_Date1 != null){
									y = value.Editor_Date1;
								} else {
									y = '';
								}
		  						x =x + '<img class="statusImg" src="'+ baseUrl +'assets/images/'+ value.Editor_Status +'" />'+
		  							'<br/><span class="text-bold text-danger">'+ y +'</span>'+
		  						'</td>'+
		  						'<td>';
	  							if(value.Output_Date1 != null){
									y = value.Output_Date1;
								} else {
									y = '';
								}
		  						x = x + '<img class="statusImg" src="'+baseUrl+'assets/images/'+ value.Output_Status +'"/>'+
		  							'<br/><span class="text-bold text-danger">'+ y +'</span>'+
		  						'</td>'+
		  						'<td>';
		  						if(value.Copy_Date1 != null){
		  							copyDate = value.Copy_Date1;
								} else {
									copyDate = '';
								}
								
		  						if(value.Copy_ID != null){
									copyId = value.Copy_ID;
								} else {
									copyId = '';
								}
		  						x = x + '<img class="statusImg" src="'+ baseUrl +'assets/images/'+ value.Copy_Status +'"/>'+
		  							'<br/><span class="text-bold text-danger">'+ copyDate +'</span>'+
		  							'<br/><small>'+ copyId +'</small>'+
		  						'</td>'+
		  						'<td>';
		  						if(value.VTEditor_Date1 != null){
		  							vtDate = value.VTEditor_Date1;
								} else {
									vtDate = '';
								}
								
		  						if(value.VTEditor_ID != null){
									vtId = value.VTEditor_ID;
								} else {
									vtId = '';
								}
		  						x = x + '<img class="statusImg" src="'+baseUrl+'assets/images/'+ value.VTEditor_Status +'"/>'+
		  							'<br/><span class="text-bold text-danger">'+ vtDate +'</span>'+
		  							'<br/><small>'+ vtId +'</small>'+
								'</td>'+
								'<td>';
		  						if(value.VTEditor_Publish != null){
		  							vtPublish = value.VTEditor_Publish;
								} else {
									vtPublish = '';
								}
								x = x + vtPublish +'</td>'+
		  						'<td class="text-success text-bold">';
								if(value.Expected_OnAir != null){
		  							onAir = value.Expected_OnAir.substr(0, 8);
								} else {
									onAir = '';
								}
		  						
		  						x = x + onAir+'</td>'+
		  						'<td>'+
		  							'<a target="_blank" href="'+ baseUrl +'Assignment/report/stringer-summary/'+ value.Sno +'">'+
										'<img src="'+ baseUrl +'assets/images/viewMore.jpg"/>'+
									'</a>'+
								'</td>'+
							'</tr>';
					});
					x = x + '</tbody>'+
						'</table>';
            		$('#accordion').html(x);
    				} else {
    					$('#accordion').html('No record found.');
    				}
				},
				error:function(){
					$('#accordion').html('oops something went wrong try again.');
				}
			
			});
		}
		
	
		$(document).on('change','#state',function(){
			var state = $(this).val();
			$.ajax({
				url : baseUrl + 'Assignment_ctrl/all_location/'+state,
				type : 'GET',
				dataType : 'json',
				beforeSend : function(){
					$('#location').html('<option value="">Select location</option>');
				},
				success:function(response){
					if(response.status == 200){
						var x = '<option value="">Select location</option>';
						$.each(response.data,function(key,value){
							x = x + '<option value="'+ value.place +'">'+ value.place +'</option>';
						});
						$('#location').html(x);
					}
				}
			});
		});


		$(document).on('click','#view',function(){
			var state = $('#state').val();
			var location = $('#location').val();
			
			$.ajax({
				url : baseUrl + 'Assignment_ctrl/stringer_report',
				type : 'POST',
				dataType : 'json',
				data : {
					'fromdate' : $('#fromdate').val(),
					'todate' : $('#todate').val(),
					'state' : $('#state').val(),
					'location' : $('#location').val()
				},
				beforeSend:function(){
				$('#stringer_feeds').html('');
				$('#accordion').html('');	
				},
				success:function(response){
					if(response.status == 200){
						var x = '<table class="table text-center table-bordered">'+
									'<thead class="bg-dark">'+
										'<tr>'+
											'<th>SNO.</th>'+
											'<th>Name</th>'+
											'<th>Location</th>'+
											'<th>Total Feed</th>'+
										'</tr>'+
									'</thead><tbody>';
						$.each(response.data,function(key,value){
							x = x + '<tr>'+	
										'<td>'+ parseInt(key+1) +'.</td>'+
										'<td><a class="feedsummary" data-uid="'+ value.UID +'" href="javascript:void(0);">'+ value.Name +'</a></td>'+
										'<td><a class="feedsummary" data-uid="'+ value.UID +'" href="javascript:void(0);">'+ value.Location +'</a></td>'+
										'<td><a class="feedsummary" data-uid="'+ value.UID +'" href="javascript:void(0);">'+ value.Total +'</a></td>'+
									'</tr>';
						});
						x = x + '</tbody></table>';
						$('#stringer_feeds').html(x);
					}
				}	
			});
		});


		$('#view').trigger('click');
	});
	
</script>
