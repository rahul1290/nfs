<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ALL REPORT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="#">Reports</a></li>
              <li class="breadcrumb-item active">All report</li>
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
        				<td>Location</td>
        				<td>
        					<select class="form-control" id="location">
        						<option value="">Select location</option>
        						<?php foreach($locations as $location){ ?>
        							<option value="<?php echo $location['Place']; ?>"><?php echo $location['Place']; ?></option>
        						<?php } ?>
        					</select>
        				</td>
        			</tr>
        			<tr>
        				<td>Reporter</td>
        				<td>
        					<select class="form-control" id="reporter">
        						<option value="">All</option>
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
        		<div class="col-3 table-responsive" id="reporter_feeds"></div>
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


		$(document).on('click','#view',function(){
			$.ajax({
				url : baseUrl + 'Assignment_ctrl/report/reporter_report',
				type : 'POST',
				dataType : 'json',
				data : {
					'fromdate' : $('#fromdate').val(),
					'todate' : $('#todate').val(),
					'location' : $('#location').val(),
					'reporter' : $('#reporter').val()
				},
				success:function(response){
					var x = '<table class="table table-bordered">';
					if(response.status == 200){
						$.each(response.data,function(key,value){
							x = x + '<tr>'+
										'<td><a href="javascript:void(0);" class="feedsummary" data-uid="'+ value.UID +'" data-uname="'+ value.Name +'">'+ value.Name +'</a></td>'+
										'<td><a href="javascript:void(0);" class="feedsummary" data-uid="'+ value.UID +'" data-uname="'+ value.Name +'">'+ value.Count +'</a></td>'+
									'</tr>';
						});
		    			x = x + '</table>';
		    			$('#reporter_feeds').html(x);
					}
				}
			});	
		});

		$(document).on('click','.feedsummary',function(){
			var that = $(this);
			var uid = $(this).data('uid');
			var uname = $(this).data('uname');
			$.ajax({
				url :baseUrl + 'Assignment_ctrl/report/reporter_report/bifurcation',
				type : 'POST',
				dataType : 'json',
				data : {
					'reporterId' : uid,
					'fromdate' : $('#fromdate').val(),
					'todate' : $('#todate').val(),
				},
				beforeSend:function(){
					$('#accordion').html('<div class="text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>');
				},
				success:function(response){
					if(response.status == 200){
						var x = '<p class="text-center bg-dark m-0">'+ uname +'</p>';
						$.each(response.data,function(key,value){
							var coll = '';
							var show = 'show';
							if(key != 0){
								coll = 'collapsed';
								show = '';
							}
							x = x + '<div class="card">'+
		                        		'<div class="card-header" id="headingOne">'+
	                          				'<h5 class="mb-0">'+
    	                            			'<button data-id="'+key+'" data-uid="'+ uid +'" data-date="'+ value.Date +'" class="feedbtn btn '+ coll +'" data-toggle="collapse" data-target="#collapse'+key+'" aria-expanded="true" aria-controls="collapse'+key+'">'+ value.Date +'#'+ value.Count +
    	                            			'</button>'+
	                          				'</h5>'+
	                        			'</div>'+
	                        			'<div id="collapse'+key+'" class="collapse '+show+'" aria-labelledby="headingOne" data-parent="#accordion">'+
	                          				'<div class="card-body" id="feed_list_'+key+'">'+
	                          				'</div>'+
	                        			'</div>'+
			                      '</div>';
						});
						$('#accordion').html(x);
						feedList(0,uid,response.data[0].Date);
					}
					else{
						$('#accordion').html('No record found.');
					}
				},
				error:function(){
					$('#accordion').html('oops something went wrong try again.');
				}
			});
		});


		function feedList(id,uid,date){
			$.ajax({
				url : baseUrl + 'Assignment_ctrl/reporter_feed_list_dateWise',
				type : 'POST',
				dataType : 'json',
				data : {
					'id' : id,
					'uid' : uid,
					'date' : date
				},
				beforeSend:function(){
					$('#feed_list_'+id).html('<div class="text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>');
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
		  							'<a target="_blank" href="'+ baseUrl +'Assignment/report/reporter-summary/'+ value.Sno +'">'+
										'<img src="'+ baseUrl +'assets/images/viewMore.jpg"/>'+
									'</a>'+
								'</td>'+
							'</tr>';
					});
					x = x + '</tbody>'+
						'</table>';
            		$('#feed_list_'+id).html(x);
    				} else {
    					$('#feed_list_'+id).html('No record found.');
    				}
				},
				error:function(){
					$('#feed_list_'+id).html('oops something went wrong try again.');
				}
			
			});
		}
		
		$(document).on('click','.feedbtn',function(){
			var id = $(this).data('id');
			var uid = $(this).data('uid');
			var date = $(this).data('date');
			feedList(id,uid,date);
			
		});
	});
</script>
