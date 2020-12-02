<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STORY FILE ENTRY</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
              <li class="breadcrumb-item active">Story File Entry</li>
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
        <div class="card-header"></div>
        <div class="card-body">
			
			<form name="f1" method="POST" action="<?php echo base_url('Assignment/Story-File-Entry'); ?>" enctype="multipart/form-data">
            	<div class="form-group row">
                	<label for="staticEmail" class="col-sm-2 col-form-label">Select Reporter</label>
                	<div class="col-sm-10">
                  		<select name="reporter" id="reporter" class="form-control">
                  			<option value="">Select reporter</option>
                  			<?php foreach($repoters as $repoter){ ?>
                  				<option data-uid="<?php echo $repoter['UID']; ?>" data-folder="<?php echo $repoter['Folder_Name']; ?>" data-place="<?php echo $repoter['PLACE']; ?>" data-city="<?php echo $repoter['CITYCODE']; ?>" value="<?php echo $repoter['UID']; ?>"><?php echo $repoter['NAME']; ?></option>
                  			<?php } ?>
                  		</select>
                  		<?php echo form_error('reporter'); ?>
                	</div>
              	</div>
              	<div class="form-group row">
                	<label for="staticEmail" class="col-sm-2 col-form-label">Location</label>
                	<div class="col-sm-10">
                  		<span id="location"></span>
                	</div>
              	</div>
              	<div class="form-group row">
                	<label for="inputPassword" class="col-sm-2 col-form-label">Slug</label>
                	<div class="col-sm-10">
                  		<input type="text" class="form-control" name="slug" id="slug" placeholder="News slug" maxlength="20" minlength="3" value="<?php echo set_value('slug');?>">
						<small class="form-text text-muted">Maximum 20 character's allowed including space<span id="charcount"> [ 20 Characters left ]<span></small>
						<span id="slug_error"></span>
						<?php echo form_error('slug'); ?>
                	</div>
              	</div>
              	<div class="form-group row">
                	<label for="inputPassword" class="col-sm-2 col-form-label">Source Of Feed</label>
                	<div class="col-sm-10">
                  		<input type="radio" name="source" value="backpack" class="ml-2" <?php if(set_value('source') == '')?> checked> BACKPACK
                  		<input type="radio" name="source" class="ml-2"> OB
                  		<input type="radio" name="source" class="ml-2"> OFC
                  		<input type="radio" name="source" class="ml-2"> WHATSAPP
                  		<input type="radio" name="source" class="ml-2"> OTHER
                	</div>
                	<?php echo form_error('source'); ?>
              	</div>
              	<div class="form-group row">
                	<label for="inputPassword" class="col-sm-2 col-form-label">Attach Clip</label>
                	<div class="btn btn-default btn-file">
                    	<i class="fas fa-paperclip"></i> Browse Your Video Files
                    	<input type="file" id="file" name="file[]" multiple>
                  	</div>
              	</div>
              	
              	<div class="form-group row">
                	<div class="offset-2 col-sm-10">
                    	<input type="submit" class="btn btn-success" value="Send Now!"/>
                  	</div>
              	</div>
            </form>
			
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
		var isValidSlug = true;
		 
		$(document).on('change','#reporter',function(){
			console.log($(this).val());
			$('#location').html($(this).find(':selected').data('place').toUpperCase());

			$('#slug').trigger('keyup');
		});


		$(document).on('keyup','#slug',function(){
			this.value = this.value.toUpperCase();
			var slug = $(this).val();
			var cityCode = $('#reporter').find(':selected').data('city');
			var Folder = $('#reporter').find(':selected').data('folder');
			console.log("slug :"+slug);
			console.log("cityCode :"+cityCode);
			console.log("Folder :"+Folder);
			
			$('#charcount').html('['+ parseInt(20-slug.length) +' Characters left ]');
			
			//var cityCode = $('#reporter').find(':selected').data('place');
			if(slug.length > 0 && reporter != ''){
				$.ajax({
					url : baseUrl + 'Assignment_ctrl/checkSlug',
					data: {
						'slug' : slug,
						'citycode' : cityCode,
						'folder' : Folder
					},
					type: 'POST',
					dataType: 'json',
					success: function(response){
						if(response.status == 200){
							$('#slug_error').html('<span class="text-success"><b>'+response.slug+'<b></span>');
							isValidSlug = true;
						} else {
							$('#slug_error').html('<span class="text-danger"><b>Slug already exist.<b></span>');
							isValidSlug = false;
						}
					}
				});
			}
		});
	});

	
	
</script>