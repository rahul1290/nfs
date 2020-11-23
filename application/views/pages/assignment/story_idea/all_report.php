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
			  <li class="breadcrumb-item"><a href="#">Story Idea</a></li>
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
			<form class="offset-2 col-8" name="f1" method="POST" action="<?php echo base_url('Report/scriptFileReport')?>">
				<div class="form-row align-items-center">
					<div class="col-auto">
				  		From Date:
							<div class="input-group date" id="reservationdate" data-target-input="nearest">
								<input type="text" name="fromdate" id="fromdate" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?php if($this->uri->segment(4) != ''){ echo $this->uri->segment(4); } else { echo date('d/m/Y',strtotime('-1 day')); } ?>" />
								<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
					</div>
					<div class="col-auto mt-2">
				  		To Date:
				  		<div class="input-group mb-2">
							<div class="input-group date" id="reservationdate1" data-target-input="nearest">
								<input type="text" name="todate" id="todate" class="form-control datetimepicker-input" data-target="#reservationdate1" value="<?php if($this->uri->segment(5) != ''){ echo $this->uri->segment(5); } else { echo date('d/m/Y'); }?>" />
								<div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
								</div>
							</div>
				  		</div>
					</div>
					<div class="col-auto mt-4">
				  		<button type="button" id="submit" class="btn btn-success mb-2 mt-2">View</button>
					</div>
			  	</div>
			</form>
			<hr/>
			<div class="offset-2 col-8">
    			<table class="table table-bordered table-striped text-center">
    				<thead>
    					<tr class="bg-info">
        					<th>Date</th>
        					<th>Approved</th>
        					<th>Rejected</th>
        					<th>NotSeen</th>
        					<th>Total</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php foreach($feed as $f){ ?>
    					<tr>
    						<td><?php echo $f['Date']; ?></td>
    						<td><?php echo $f['Approved']; ?></td>
    						<td><?php echo $f['Rejected']; ?></td>
    						<td><?php echo $f['NotSeen']; ?></td>
    						<td><?php echo $f['Total']; ?></td>
    					</tr>
    					<?php }?>
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
		var baseUrl = $('#baseUrl').val();
		
		 $("#example1").DataTable({
			  "responsive": false,
			  "autoWidth": false,
			  "bSort": false
			});
			
		$('#reservationdate').datetimepicker({
			format: 'DD/MM/YYYY',
			maxDate: new Date()
		});
		$('#reservationdate1').datetimepicker({
			format: 'DD/MM/YYYY',
			maxDate: new Date()	
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

			window.location.replace(baseUrl + 'Assignment/story-idea/all-report/'+date1+'/'+date2);
		});
		
	});
</script>