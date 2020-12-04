
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
        
        	
        
        	<div class="row">
        		<section class="col-lg-3">
        			<form class="col-12" name="f1" method="POST" action="<?php echo base_url('Report/scriptFileReport')?>">
        				<div class="form-row align-items-center">
        					<div class="col-4">
        				  		From Date:
        							<div class="input-group date" id="reservationdate" data-target-input="nearest">
        								<input type="text" name="fromdate" id="fromdate" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?php if($this->uri->segment(4) != ''){ echo date('d/m/Y',strtotime($this->uri->segment(4))); } else { echo date('d/m/Y',strtotime('-1 day')); } ?>" />
        								<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
        									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
        								</div>
        							</div>
        					</div>
        					<div class="col-4 mt-2">
        				  		To Date:
        				  		<div class="input-group mb-2">
        							<div class="input-group date" id="reservationdate1" data-target-input="nearest">
        								<input type="text" name="todate" id="todate" class="form-control datetimepicker-input" data-target="#reservationdate1" value="<?php if($this->uri->segment(6) != ''){ echo $this->uri->segment(6); } else { echo date('d/m/Y'); }?>" />
        								<div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
        									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
        								</div>
        							</div>
        				  		</div>
        					</div>
        					<div class="col-auto mt-4">
        				  		<button type="button" id="submit" class="btn btn-success mb-2 mt-2">View</button>
        					</div>
        					
        					<table class="table table-bordered table-striped text-center" id="example1">
            				<thead>
            					<tr class="bg-info">
                					<th>Date</th>
                					<th>Total</th>
            					</tr>
            				</thead>
            				<tbody>
            					<?php foreach($feed as $f){ ?>
            					<tr>
            						<td><?php echo $f['Date']; ?></td>
            						<td><a class="newslist" data-date="<?php echo $f['Date']; ?>" href="javascript:void(0);"><?php echo $f['Total']; ?></a></td>
            					</tr>
            					<?php }?>
            				</tbody>
            			</table>
        					
        			  	</div>
        			</form>
        		</section>
        		<section class="col-lg-3" id="newsList"></section>
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
		var baseUrl = $('#baseUrl').val();

		newsListRender($('#fromdate').val());
		
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


		
		function escapeRegExp(string){
		    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
		}

		function replaceAll(str, term, replacement) {
		    return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
		}

		$(document).on('click','#submit',function(){
			var date1 = replaceAll($('#fromdate').val(), '/', '-');
			var date2 = replaceAll($('#todate').val(), '/', '-');

			window.location.replace(baseUrl + 'Vsat/report/all-report/'+date1+'/'+date2);
		});


		function newsListRender(date){
			console.log(date);
			$.ajax({
	        	type: 'POST',
	        	url: baseUrl+'Vsat/report/all-report-list',
	        	data: {
	            	'date' : date
	            },
	        	dataType: 'json',
	        	beforeSend: function() {
		        	$('#newsList').html('Loading');
		        },
	        	success: function(response){
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
            		  							'<a target="_blank" href="'+ baseUrl +'vsat/report/all-report/'+ value.Sno +'">'+
            										'<img src="'+ baseUrl +'assets/images/viewMore.jpg"/>'+
            									'</a>'+
            								'</td>'+
            							'</tr>';
								});
								x = x + '</tbody>'+
									'</table>';
			            $('#newsList').html(x);	
			            $("#example2").DataTable({
			  			  "responsive": false,
			  			  "autoWidth": false,
			  			  "bSort": false,
			  			  "searching": false,
			  			});
	            	}
	        	}
			});
		}

		$(document).on('click','.newslist',function(){
			var date = $(this).data('date');
			newsListRender(date);
		});
		
	});
</script>