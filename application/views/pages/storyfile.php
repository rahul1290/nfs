<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>STORY FILE PAGE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
			  <li class="breadcrumb-item"><a href="<?php ?>">Entry Form</a></li>
              <li class="breadcrumb-item active">Story File</li>
            </ol>
          </div>
        </div>
      </div>
    </section>-->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
		
		<!--div id="clock">
		  <p class="unit" id="hours"></p>
		  <p class="unit" id="minutes"></p>
		  <p class="unit" id="seconds"></p>
		  <p class="unit" id="ampm"></p>
		</div-->
		
        <div class="card-header">
          <h3 class="card-title"> Send Your Feed From Here </h3>

          <!--<div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>-->
        </div>
        <div class="card-body">
		
		
		
		<input type="hidden" id="refreshUrl" value="<?php echo base_url();?>Entryform/index/0" />
		<input type="hidden" id="userId" value="<?php echo $this->session->userdata('uid'); ?>" />
			
		<div class="container">	
				<div class="form-group">
					<label for="exampleInputEmail1">File upload control ( * in mandatory fields & Logsheet should be maintained properly)</label>
				</div>
				
				<div class="form-group row">
					<label for="slug" class="col-sm-2 col-form-label"><b>Slug(In English) <span class="text-danger">*</span></b></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="slug" aria-describedby="emailHelp" placeholder="News slug" maxlength="20" minlength="3" value="<?php if($this->session->userdata('formdata')['form_slug'] != ''){  echo $this->session->userdata('formdata')['form_slug']; }?>">
						<small class="form-text text-muted">Maximum 20 character's allowed including space<span id="charcount"> [ 20 Characters left ]<span></small>
						<span id="slug_error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="font" class="col-sm-2 col-form-label"><b>Select Font</b></label>
					<div class="col-sm-10">
						<input class="font" data-value="unicode" type="radio" name="font" value="UNICODE" checked> UNICODE
						<input class="font" data-value="krutidev" type="radio" name="font" value="KURTI DEV"> KURTI DEV
					</div>
				</div>
				<div class="form-group row">
					<label for="anchor" class="col-sm-2 col-form-label"><b>Anchor(In Unicode) <span class="text-danger">*</span></b></label>
					<div class="col-sm-10">
						<textarea class="form-control" name="anchor" id="anchor" placeholder="Anchor(In Unicode)"><?php if($this->session->userdata('formdata')['form_anchor'] != ''){  echo $this->session->userdata('formdata')['form_anchor']; }?></textarea>
						<span id="anchor_error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="vo" class="col-sm-2 col-form-label"><b>VO(In Unicode) <span class="text-danger">*</span></b></label>
					<div class="col-sm-10">
						<textarea class="form-control" name="vo" id="vo" placeholder="VO(In Unicode)"><?php if($this->session->userdata('formdata')['form_vo'] != ''){  echo $this->session->userdata('formdata')['form_vo']; }?></textarea>
						<span id="vo_error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="byte" class="col-sm-2 col-form-label"><b>Byte(In Unicode) <span class="text-danger">*</span></b></label>
					<div class="col-sm-10">
						<textarea class="form-control" name="bytes" id="bytes" placeholder="Byte(In Unicode)"><?php if($this->session->userdata('formdata')['form_bytes'] != ''){  echo $this->session->userdata('formdata')['form_bytes']; }?></textarea>
						<span id="bytes_error"></span>
					</div>
				</div>
				<div class="form-group row">
					<label for="logsheet" class="col-sm-2 col-form-label"><b>Logsheet <span class="text-danger">*</span></b></label>
					<div class="col-sm-10">
						<textarea class="form-control" name="logsheet" id="logsheet" placeholder="Logsheet"><?php if($this->session->userdata('formdata')['form_logsheet'] != ''){  echo $this->session->userdata('formdata')['form_logsheet']; }?></textarea>
						<span id="logsheet_error"></span>
					</div>
				</div>			
				<div class="form-group row">
					<label for="file" class="col-sm-2 col-form-label"><b>Attach Clip <span class="text-danger">*</span></b></label>
					<!--<div class="col-sm-10">
					   
						<input type="file" id="file" name="file[]"  multiple><br>
						
					</div>-->
					<div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Browse Your Video Files
                    <input type="file" id="file" name="file[]" multiple>
                  </div>
					
				</div>
					
					<div class="progress mb-4" style="display:none;">
						<div class="bar" style="background-color: forestgreen;"></div >
						<div class="percent text-center">0%</div>
					</div>
					
					<div class="form-group" style="float:left; width:100%;">
						<div id="imagePreview" class="mt-4 mb-4">
							<?php 
								if(isset($archives)){
									foreach($archives as $archive){ ?>
										<div class="img-wrapper">
											<?php /*<img width="150" height="100" src="http://newsflow.ibc24.in/VideoThumb/<?php echo $archive['Thumb_Name']; ?>"> */ ?>
											<img width="150" height="100" src="https://thumb.ibc24.in/<?php echo $archive['Thumb_Name']; ?>" />
											<div class="img-overlay">
												<button class="unlink btn btn-md btn-warning" style="border-radius:50%;opacity:0.7;" data-dbid="<?php echo $archive['Sno']; ?>" data-file="<?php echo $this->my_library->myfolder(); ?><?php echo $archive['File_Name']; ?>">X</button>
											</div>
											<p class="text-cneter" style="max-width: 150px;word-break: break-word;"><?php echo $archive['File_Name']; ?></p>
										</div>
									<?php }
								}
							?>
						</div>
					</div>
				
				<div class="form-group text-center mt-4">
					<!--<input type="button" class="btn btn-default" id="refresh" value="Refresh">
					<input type="button" class="btn btn-warning" id="draft" value="Check Draft">-->
					<input type="button" class="btn btn-success btn-lg btn-block" id="send" value="Send Now">
				</div>
			</div>
		<!--</form>-->
		
		
		
		
		<div style="height:100px"></div>
		
		
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
					<div class="form-group row">
						<label for="modalanchor" class="col-sm-2 col-form-label">Anchor</label>
						<div class="col-sm-10">
						  <textarea name="modalanchor" id="modalanchor" class="form-control"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="modalvo" class="col-sm-2 col-form-label">VO</label>
						<div class="col-sm-10">
						  <textarea name="modalvo" id="modalvo" class="form-control"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="modalbytes" class="col-sm-2 col-form-label">Bytes</label>
						<div class="col-sm-10">
						  <textarea name="modalbytes" id="modalbytes" class="form-control"></textarea>
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" id="convert" class="btn btn-primary" data-dismiss="modal">Convert</button>
			  </div>
			</div>
		  </div>
		</div>
		<!-- Modal -->
		
		
		

		
		<script>
			$(document).ready(function(){
			//$(function() {
				var baseUrl = $('#baseUrl').val();
				var bar = $('.bar');
				var percent = $('.percent');
				var isValidSlug = false;
				
				$(document).on('click','.font',function(){
					if($(this).val() == 'KURTI DEV'){
						$('#modalanchor').val($('#anchor').val());
						$('#modalvo').val($('#vo').val());
						$('#modalbytes').val($('#bytes').val());
						
						$('#exampleModal').modal({show:true,backdrop:'static'});
					}
				});
				
				$(document).on('change','#file',function(event){
					var formValue;
					var validfiles = 0;
					formValue = new FormData();
					for(var i=0; i< $('#file')[0].files.length; i++){
						
						if($('#file')[0].files[i]['type'] == 'image/jpeg'|| $('#file')[0].files[i]['type'] == 'image/jpg' || $('#file')[0].files[i]['type'] == 'video/mp4' || $('#file')[0].files[i]['type'] == 'video/avi' || $('#file')[0].files[i]['type'] == 'video/x-ms-wmv'){
							validfiles = validfiles + 1;
							formValue.append('file[]', $('#file')[0].files[i]);
						} else {
							alert($('#file')[0].files[i]['name'] + ' File not supported.');
						}
					}
					if(validfiles > 0){
						$.ajax({
							xhr: function() {
								var xhr = new window.XMLHttpRequest();
								xhr.upload.addEventListener("progress", function(evt) {
									if (evt.lengthComputable) {
										var percentComplete = parseInt((evt.loaded / evt.total) * 100);
										bar.width(percentComplete+'%');
										percent.html(percentComplete);
									}
							   }, false);
							   return xhr;
							},
							url: baseUrl + 'Entryform/upload',
							data: formValue,
							type: 'POST',
							dataType: 'json',
							beforeSend: function() {
								//status.empty();
								var percentVal = '0%';
								percent.html(percentVal);
								$('.progress').show();
								$('#file').prop('disabled', true);
								$('#send').prop('disabled', true);
								$('#draft').prop('disabled', true);
							},
							// uploadProgress: function(event, position, total, percentComplete) {
								// var percentVal = percentComplete + '%';
								// bar.width(percentVal);
								// percent.html(percentVal);
							// },
							success: function(response){
								var x = '';
								if(response.status == 200){
									$.each(response.data,function(key,value){
										x = x + '<div class="img-wrapper">'+
												'<img width="150" height="100" src="https://thumb.ibc24.in/'+ value.image +'">'+
												'<div class="img-overlay">'+
													'<button class="unlink btn btn-md btn-warning" style="border-radius:50%;opacity:0.7;" data-dbid="'+ value.dbId +'" data-file="'+ value.file_name +'">X</button>'+
												'</div>'+
												'<p class="text-cneter" style="max-width: 150px;word-break: break-word;">'+ value.client_name +'</p>'+
												'</div>';
									});
									$('#imagePreview').prepend(x);
								}
								
							},
							complete: function(xhr) {
								bar.width(0);
								$('#file').val('');
								$('.progress').hide();
								percent.html(0);
								$('#send').prop('disabled', false);
								$('#file').prop('disabled', false);
								$('#draft').prop('disabled', false);
								
								//status.html(xhr.responseText);
							},
							
							processData: false,
							contentType: false,
						});
					}
					});
				
					$(document).on('click','.unlink',function(){
						var file = $(this).data('file');
						var dbId = $(this).data('dbid');
						var that = $(this);
						$.ajax({
							url : baseUrl + 'Entryform/fileunlink',
							data: {
								'file' : file,
								'dbId' : dbId
							},
							type: 'POST',
							dataType: 'json',
							beforeSend:function(){
								//$('#loaderModal').modal('show');
							},
							success: function(response){
								if(response.status == 200){
									$(that).parent().parent().remove();
								}
							},
							complete:function(){
								// alert('function called');
								// $('#loaderModal').modal('toggle');
								// $('#loaderModal').modal('hide');
							}
						});
					});
					
					
					
					///////////////////////////////////////////////////////////
					$(document).on('keyup','#slug',function(){
						this.value = this.value.toUpperCase();
						var slug = $(this).val();
						$('#charcount').html('['+ parseInt(20-slug.length) +' Characters left ]');
					});
					
					$(document).on('blur','#slug',function(){
						var slug = $(this).val();
						if(slug.length > 0){
							$.ajax({
								url : baseUrl + 'Entryform/checkSlug',
								data: {
									'slug' : slug
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
					
			
					
					
					
					$(document).on('click','#send',function(){
							var anchor = $('#anchor').val().length;
							var vo = $('#vo').val().length;
							var bytes = $('#bytes').val().length;
							var logsheet = $('#logsheet').val().length;
							var formvalid = true;
							if(!isValidSlug){
								$('#slug_error').html('<span class="text-danger"><b>Invalid slug name<b></span>');
								formvalid = false;
							} else {
								var slug = $('#slug').val();
								if(slug.length > 0){
									$.ajax({
										url : baseUrl + 'Entryform/checkSlug',
										data: {
											'slug' : slug
										},
										type: 'POST',
										dataType: 'json',
										success: function(response){
											if(response.status == 200){
												
											} else {
												formvalid = false;
											}
										}
									});
								}
							}
							
							if(!anchor > 0){
								$('#anchor_error').html('<span class="text-danger"><b>Invalid anchor<b></span>');
								formvalid = false;
							} else {
								$('#anchor_error').html('');
							}
							
							if(!vo > 0){
								$('#vo_error').html('<span class="text-danger"><b>Invalid vo<b></span>');
								formvalid = false;
							} else {
								$('#vo_error').html('');
							} 
							
							if(!bytes > 0){
								$('#bytes_error').html('<span class="text-danger"><b>Invalid bytes<b></span>');
								formvalid = false;
							} else {
								$('#bytes_error').html('');
							} 
							
							if(!bytes > 0){
								$('#logsheet_error').html('<span class="text-danger"><b>Invalid logsheet<b></span>');
								formvalid = false;
							} else {
								$('#logsheet_error').html('');
							} 
							
							
							if(formvalid){
								formSubmit();
							}
					});
					
					
					
					function formSubmit(){
						$.ajax({
							url : baseUrl + 'Entryform/feedsubmit',
							data: {
								'slug' : $('#slug').val(),
								'anchor': $('#anchor').val(),
								'vo' : $('#vo').val(),
								'bytes' : $('#bytes').val(),
								'logsheet' : $('#logsheet').val()
							},
							type: 'POST',
							dataType: 'json',
							beforeSend: function() {
								$('#send').prop('disabled', true);
								$('#draft').prop('disabled', true);
								
							},
							success: function(response){
								if(response.status == 200){
									
									$('#successModal').modal({
										backdrop: 'static',
										keyboard: false
									});
									//location.reload();
								} else {
									alert(response.msg);	
								}
							}
						});
					}
					
					
					
					$(document).on('click','#draft',function(){
						var slug = $('#slug').val();
						var anchor = $('#anchor').val();
						var vo = $('#vo').val();
						var bytes = $('#bytes').val();
						var logsheet = $('#logsheet').val();
						
						$.ajax({
								url : baseUrl + 'Entryform/checkdraft/',
								data: {
									'slug' : slug,
									'anchor' : anchor,
									'vo'	: vo,
									'bytes' : bytes,
									'logsheet' : logsheet
								},
								type: 'POST',
								dataType: 'json',
								success: function(response){
									window.location.replace($('#refreshUrl').val());
								}
							});
					});
					
					$(document).on('click','#refresh',function(){
						window.location.replace(baseUrl+'Entryform/index/1');
					});
					
					
					$(document).on('click','#convert',function(){
						convert_to_unicode();
						convert_to_unicode1();
						convert_to_unicode2();
					});
					
					function convert_to_unicode() {
						var array_one = new Array(
						"ñ", "Q+Z", "sas", "aa", ")Z", "ZZ", "‘", "’", "“", "”",
						"å", "ƒ", "„", "…", "†", "‡", "ˆ", "‰", "Š", "‹",
						"¶+", "d+", "[+k", "[+", "x+", "T+", "t+", "M+", "<+", "Q+", ";+", "j+", "u+",
						"Ùk", "Ù", "ä", "–", "—", "é", "™", "=kk", "f=k",
						"à", "á", "â", "ã", "ºz", "º", "í", "{k", "{", "=", "«",
						"Nî", "Vî", "Bî", "Mî", "<î", "|", "K", "}",
						"J", "Vª", "Mª", "<ªª", "Nª", "Ø", "Ý", "nzZ", "æ", "ç", "Á", "xz", "#", ":",
						"v‚", "vks", "vkS", "vk", "v", "b±", "Ã", "bZ", "b", "m", "Å", ",s", ",", "_",
						"ô", "d", "Dk", "D", "[k", "[", "x", "Xk", "X", "Ä", "?k", "?", "³",
						"pkS", "p", "Pk", "P", "N", "t", "Tk", "T", ">", "÷", "¥",
						"ê", "ë", "V", "B", "ì", "ï", "M+", "<+", "M", "<", ".k", ".",
						"r", "Rk", "R", "Fk", "F", ")", "n", "/k", "èk", "/", "Ë", "è", "u", "Uk", "U",
						"i", "Ik", "I", "Q", "¶", "c", "Ck", "C", "Hk", "H", "e", "Ek", "E",
						";", "¸", "j", "y", "Yk", "Y", "G", "o", "Ok", "O",
						"'k", "'", "\"k", "\"", "l", "Lk", "L", "g",
						"È", "z",
						"Ì", "Í", "Î", "Ï", "Ñ", "Ò", "Ó", "Ô", "Ö", "Ø", "Ù", "Ük", "Ü",
						"‚", "ks", "kS", "k", "h", "q", "w", "`", "s", "S",
						"a", "¡", "%", "W", "•", "·", "∙", "·", "~j", "~", "\\", "+", " ः",
						"^", "*", "Þ", "ß", "(", "¼", "½", "¿", "À", "¾", "A", "-", "&", "&", "Œ", "]", "~ ", "@")

						var array_two = new Array(
						//"¼","½", 
						"॰", "QZ+", "sa", "a", "र्द्ध", "Z", "\"", "\"", "'", "'",
						"०", "१", "२", "३", "४", "५", "६", "७", "८", "९",
						"फ़्", "क़", "ख़", "ख़्", "ग़", "ज़्", "ज़", "ड़", "ढ़", "फ़", "य़", "ऱ", "ऩ",    // one-byte nukta varNas
						"त्त", "त्त्", "क्त", "दृ", "कृ", "न्न", "न्न्", "=k", "f=",
						"ह्न", "ह्य", "हृ", "ह्म", "ह्र", "ह्", "द्द", "क्ष", "क्ष्", "त्र", "त्र्",
						"छ्य", "ट्य", "ठ्य", "ड्य", "ढ्य", "द्य", "ज्ञ", "द्व",
						"श्र", "ट्र", "ड्र", "ढ्र", "छ्र", "क्र", "फ्र", "र्द्र", "द्र", "प्र", "प्र", "ग्र", "रु", "रू",
						"ऑ", "ओ", "औ", "आ", "अ", "ईं", "ई", "ई", "इ", "उ", "ऊ", "ऐ", "ए", "ऋ",
						"क्क", "क", "क", "क्", "ख", "ख्", "ग", "ग", "ग्", "घ", "घ", "घ्", "ङ",
						"चै", "च", "च", "च्", "छ", "ज", "ज", "ज्", "झ", "झ्", "ञ",
						"ट्ट", "ट्ठ", "ट", "ठ", "ड्ड", "ड्ढ", "ड़", "ढ़", "ड", "ढ", "ण", "ण्",
						"त", "त", "त्", "थ", "थ्", "द्ध", "द", "ध", "ध", "ध्", "ध्", "ध्", "न", "न", "न्",
						"प", "प", "प्", "फ", "फ्", "ब", "ब", "ब्", "भ", "भ्", "म", "म", "म्",
						"य", "य्", "र", "ल", "ल", "ल्", "ळ", "व", "व", "व्",
						"श", "श्", "ष", "ष्", "स", "स", "स्", "ह",
						"ीं", "्र",
						"द्द", "ट्ट", "ट्ठ", "ड्ड", "कृ", "भ", "्य", "ड्ढ", "झ्", "क्र", "त्त्", "श", "श्",
						"ॉ", "ो", "ौ", "ा", "ी", "ु", "ू", "ृ", "े", "ै",
						"ं", "ँ", "ः", "ॅ", "ऽ", "ऽ", "ऽ", "ऽ", "्र", "्", "?", "़", ":",
						"‘", "’", "“", "”", ";", "(", ")", "{", "}", "=", "।", ".", "-", "µ", "॰", ",", "् ", "/")

						var array_one_length = array_one.length;
						var modified_substring = document.getElementById("modalanchor").value;

						//****************************************************************************************
						//  Break the long text into small bunches of max. max_text_size  characters each.
						//****************************************************************************************
						var text_size = document.getElementById("modalanchor").value.length;

						var processed_text = '';  //blank

						var sthiti1 = 0; var sthiti2 = 0; var chale_chalo = 1;

						var max_text_size = 6000;

						while (chale_chalo == 1) {
							sthiti1 = sthiti2;

							if (sthiti2 < (text_size - max_text_size)) {
								sthiti2 += max_text_size;
								while (document.getElementById("modalanchor").value.charAt(sthiti2) != ' ') { sthiti2--; }
							}
							else { sthiti2 = text_size; chale_chalo = 0 }

							var modified_substring = document.getElementById("modalanchor").value.substring(sthiti1, sthiti2);

							Replace_Symbols();

							processed_text += modified_substring;

							//****************************************************************************************
							//  Breaking part code over
							//****************************************************************************************
							//  processed_text = processed_text.replace( /mangal/g , "Krutidev010" ) ;   

							document.getElementById('anchor').value = processed_text;
						}


						// --------------------------------------------------


						function Replace_Symbols() {
							//substitute array_two elements in place of corresponding array_one elements
							if (modified_substring != "")  // if stringto be converted is non-blank then no need of any processing.
							{
								for (input_symbol_idx = 0; input_symbol_idx < array_one_length; input_symbol_idx++) {
									idx = 0;  // index of the symbol being searched for replacement
									while (idx != -1) //whie-00
									{
										modified_substring = modified_substring.replace(array_one[input_symbol_idx], array_two[input_symbol_idx])
										idx = modified_substring.indexOf(array_one[input_symbol_idx])
									} // end of while-00 loop
								} // end of for loop

								//**********************************************************************************
								// Code for Replacing five Special glyphs
								//**********************************************************************************

								//**********************************************************************************
								// Code for Glyph1 : ± (reph+anusvAr)
								//**********************************************************************************
								modified_substring = modified_substring.replace(/±/g, "Zं"); // at some places  ì  is  used eg  in "कर्कंधु,पूर्णांक".
								//
								//**********************************************************************************
								// Glyp2: Æ
								// code for replacing "f" with "ि" and correcting its position too. (moving it one position forward)
								//**********************************************************************************

								modified_substring = modified_substring.replace(/Æ/g, "र्f");  // at some places  Æ  is  used eg  in "धार्मिक".

								var position_of_i = modified_substring.indexOf("f")

								while (position_of_i != -1)  //while-02
								{
									var charecter_next_to_i = modified_substring.charAt(position_of_i + 1)
									var charecter_to_be_replaced = "f" + charecter_next_to_i
									modified_substring = modified_substring.replace(charecter_to_be_replaced, charecter_next_to_i + "ि")
									position_of_i = modified_substring.search(/f/, position_of_i + 1) // search for i ahead of the current position.

								} // end of while-02 loop

								//**********************************************************************************
								// Glyph3 & Glyph4: Ç  É
								// code for replacing "fa" with "िं"  and correcting its position too.(moving it two positions forward)
								//**********************************************************************************

								modified_substring = modified_substring.replace(/Ç/g, "fa"); // at some places  Ç  is  used eg  in "किंकर".
								modified_substring = modified_substring.replace(/É/g, "र्fa"); // at some places  É  is  used eg  in "शर्मिंदा"

								var position_of_i = modified_substring.indexOf("fa")

								while (position_of_i != -1)  //while-02
								{
									var charecter_next_to_ip2 = modified_substring.charAt(position_of_i + 2)
									var charecter_to_be_replaced = "fa" + charecter_next_to_ip2
									modified_substring = modified_substring.replace(charecter_to_be_replaced, charecter_next_to_ip2 + "िं")
									position_of_i = modified_substring.search(/fa/, position_of_i + 2) // search for i ahead of the current position.

								} // end of while-02 loop

								//**********************************************************************************
								// Glyph5: Ê
								// code for replacing "h" with "ी"  and correcting its position too.(moving it one positions forward)
								//**********************************************************************************

								modified_substring = modified_substring.replace(/Ê/g, "ीZ"); // at some places  Ê  is  used eg  in "किंकर".


								/*
								var position_of_i = modified_substring.indexOf( "h" )
									while ( position_of_i != -1 )  //while-02
														{
														var charecter_next_to_i = modified_substring.charAt( position_of_i + 1 )
														var charecter_to_be_replaced = "h" + charecter_next_to_i
														modified_substring = modified_substring.replace( charecter_to_be_replaced , charecter_next_to_i + "ी" ) 
														position_of_i = modified_substring.search( /h/ , position_of_i + 1 ) // search for i ahead of the current position.

									} // end of while-02 loop
								*/


								//**********************************************************************************
								// End of Code for Replacing four Special glyphs
								//**********************************************************************************

								// following loop to eliminate 'chhotee ee kee maatraa' on half-letters as a result of above transformation.

								var position_of_wrong_ee = modified_substring.indexOf("ि्")

								while (position_of_wrong_ee != -1)  //while-03
								{
									var consonent_next_to_wrong_ee = modified_substring.charAt(position_of_wrong_ee + 2)
									var charecter_to_be_replaced = "ि्" + consonent_next_to_wrong_ee
									modified_substring = modified_substring.replace(charecter_to_be_replaced, "्" + consonent_next_to_wrong_ee + "ि")
									position_of_wrong_ee = modified_substring.search(/ि्/, position_of_wrong_ee + 2) // search for 'wrong ee' ahead of the current position. 

								} // end of while-03 loop

								//**************************************
								// 
								//**************************************
								//   alert(modified_substring);
								//**************************************

								// Eliminating reph "Z" and putting 'half - r' at proper position for this.
								set_of_matras = "अ आ इ ई उ ऊ ए ऐ ओ औ ा ि ी ु ू ृ े ै ो ौ ं : ँ ॅ"
								var position_of_R = modified_substring.indexOf("Z")

								while (position_of_R > 0)  // while-04
								{
									probable_position_of_half_r = position_of_R - 1;
									var charecter_at_probable_position_of_half_r = modified_substring.charAt(probable_position_of_half_r)


									// trying to find non-maatra position left to current O (ie, half -r).

									while (set_of_matras.match(charecter_at_probable_position_of_half_r) != null)  // while-05
									{
										probable_position_of_half_r = probable_position_of_half_r - 1;
										charecter_at_probable_position_of_half_r = modified_substring.charAt(probable_position_of_half_r);

									} // end of while-05


									charecter_to_be_replaced = modified_substring.substr(probable_position_of_half_r, (position_of_R - probable_position_of_half_r));
									new_replacement_string = "र्" + charecter_to_be_replaced;
									charecter_to_be_replaced = charecter_to_be_replaced + "Z";
									modified_substring = modified_substring.replace(charecter_to_be_replaced, new_replacement_string);
									position_of_R = modified_substring.indexOf("Z");

								} // end of while-04
							} // end of IF  statement  meant to  supress processing of  blank  string.
							//**************************************
							//   alert(modified_substring);
							//**************************************
						} // end of the function  Replace_Symbols
					}
					
					
					
					function convert_to_unicode1() {
						var array_one = new Array(
						"ñ", "Q+Z", "sas", "aa", ")Z", "ZZ", "‘", "’", "“", "”",
						"å", "ƒ", "„", "…", "†", "‡", "ˆ", "‰", "Š", "‹",
						"¶+", "d+", "[+k", "[+", "x+", "T+", "t+", "M+", "<+", "Q+", ";+", "j+", "u+",
						"Ùk", "Ù", "ä", "–", "—", "é", "™", "=kk", "f=k",
						"à", "á", "â", "ã", "ºz", "º", "í", "{k", "{", "=", "«",
						"Nî", "Vî", "Bî", "Mî", "<î", "|", "K", "}",
						"J", "Vª", "Mª", "<ªª", "Nª", "Ø", "Ý", "nzZ", "æ", "ç", "Á", "xz", "#", ":",
						"v‚", "vks", "vkS", "vk", "v", "b±", "Ã", "bZ", "b", "m", "Å", ",s", ",", "_",
						"ô", "d", "Dk", "D", "[k", "[", "x", "Xk", "X", "Ä", "?k", "?", "³",
						"pkS", "p", "Pk", "P", "N", "t", "Tk", "T", ">", "÷", "¥",
						"ê", "ë", "V", "B", "ì", "ï", "M+", "<+", "M", "<", ".k", ".",
						"r", "Rk", "R", "Fk", "F", ")", "n", "/k", "èk", "/", "Ë", "è", "u", "Uk", "U",
						"i", "Ik", "I", "Q", "¶", "c", "Ck", "C", "Hk", "H", "e", "Ek", "E",
						";", "¸", "j", "y", "Yk", "Y", "G", "o", "Ok", "O",
						"'k", "'", "\"k", "\"", "l", "Lk", "L", "g",
						"È", "z",
						"Ì", "Í", "Î", "Ï", "Ñ", "Ò", "Ó", "Ô", "Ö", "Ø", "Ù", "Ük", "Ü",
						"‚", "ks", "kS", "k", "h", "q", "w", "`", "s", "S",
						"a", "¡", "%", "W", "•", "·", "∙", "·", "~j", "~", "\\", "+", " ः",
						"^", "*", "Þ", "ß", "(", "¼", "½", "¿", "À", "¾", "A", "-", "&", "&", "Œ", "]", "~ ", "@")

						var array_two = new Array(
						"॰", "QZ+", "sa", "a", "र्द्ध", "Z", "\"", "\"", "'", "'",
						"०", "१", "२", "३", "४", "५", "६", "७", "८", "९",
						"फ़्", "क़", "ख़", "ख़्", "ग़", "ज़्", "ज़", "ड़", "ढ़", "फ़", "य़", "ऱ", "ऩ",    // one-byte nukta varNas
						"त्त", "त्त्", "क्त", "दृ", "कृ", "न्न", "न्न्", "=k", "f=",
						"ह्न", "ह्य", "हृ", "ह्म", "ह्र", "ह्", "द्द", "क्ष", "क्ष्", "त्र", "त्र्",
						"छ्य", "ट्य", "ठ्य", "ड्य", "ढ्य", "द्य", "ज्ञ", "द्व",
						"श्र", "ट्र", "ड्र", "ढ्र", "छ्र", "क्र", "फ्र", "र्द्र", "द्र", "प्र", "प्र", "ग्र", "रु", "रू",
						"ऑ", "ओ", "औ", "आ", "अ", "ईं", "ई", "ई", "इ", "उ", "ऊ", "ऐ", "ए", "ऋ",
						"क्क", "क", "क", "क्", "ख", "ख्", "ग", "ग", "ग्", "घ", "घ", "घ्", "ङ",
						"चै", "च", "च", "च्", "छ", "ज", "ज", "ज्", "झ", "झ्", "ञ",
						"ट्ट", "ट्ठ", "ट", "ठ", "ड्ड", "ड्ढ", "ड़", "ढ़", "ड", "ढ", "ण", "ण्",
						"त", "त", "त्", "थ", "थ्", "द्ध", "द", "ध", "ध", "ध्", "ध्", "ध्", "न", "न", "न्",
						"प", "प", "प्", "फ", "फ्", "ब", "ब", "ब्", "भ", "भ्", "म", "म", "म्",
						"य", "य्", "र", "ल", "ल", "ल्", "ळ", "व", "व", "व्",
						"श", "श्", "ष", "ष्", "स", "स", "स्", "ह",
						"ीं", "्र",
						"द्द", "ट्ट", "ट्ठ", "ड्ड", "कृ", "भ", "्य", "ड्ढ", "झ्", "क्र", "त्त्", "श", "श्",
						"ॉ", "ो", "ौ", "ा", "ी", "ु", "ू", "ृ", "े", "ै",
						"ं", "ँ", "ः", "ॅ", "ऽ", "ऽ", "ऽ", "ऽ", "्र", "्", "?", "़", ":",
						"‘", "’", "“", "”", ";", "(", ")", "{", "}", "=", "।", ".", "-", "µ", "॰", ",", "् ", "/")
						var array_one_length = array_one.length;
						var modified_substring = document.getElementById("modalvo").value;
						//****************************************************************************************
						//  Break the long text into small bunches of max. max_text_size  characters each.
						//****************************************************************************************
						var text_size = document.getElementById("modalvo").value.length;
						var processed_text = '';  //blank
						var sthiti1 = 0; var sthiti2 = 0; var chale_chalo = 1;
						var max_text_size = 6000;
						while (chale_chalo == 1) {
							sthiti1 = sthiti2;
							if (sthiti2 < (text_size - max_text_size)) {
								sthiti2 += max_text_size;
								while (document.getElementById("modalvo").value.charAt(sthiti2) != ' ') { sthiti2--; }
							}
							else { sthiti2 = text_size; chale_chalo = 0 }
							var modified_substring = document.getElementById("modalvo").value.substring(sthiti1, sthiti2);
							Replace_Symbols();
							processed_text += modified_substring;
							//****************************************************************************************
							//  Breaking part code over
							//****************************************************************************************
							//  processed_text = processed_text.replace( /mangal/g , "Krutidev010" ) ;   
							document.getElementById('vo').value = processed_text;
						}
						// --------------------------------------------------
							function Replace_Symbols() {
								//substitute array_two elements in place of corresponding array_one elements
								if (modified_substring != "")  // if stringto be converted is non-blank then no need of any processing.
								{
									for (input_symbol_idx = 0; input_symbol_idx < array_one_length; input_symbol_idx++) {
										idx = 0;  // index of the symbol being searched for replacement
										while (idx != -1) //whie-00
										{
											modified_substring = modified_substring.replace(array_one[input_symbol_idx], array_two[input_symbol_idx])
											idx = modified_substring.indexOf(array_one[input_symbol_idx])
										} // end of while-00 loop
									} // end of for loop
									//**********************************************************************************
									// Code for Replacing five Special glyphs
									//**********************************************************************************
									//**********************************************************************************
									// Code for Glyph1 : ± (reph+anusvAr)
									//**********************************************************************************
									modified_substring = modified_substring.replace(/±/g, "Zं"); // at some places  ì  is  used eg  in "कर्कंधु,पूर्णांक".
									//
									//**********************************************************************************
									// Glyp2: Æ
									// code for replacing "f" with "ि" and correcting its position too. (moving it one position forward)
									//**********************************************************************************
									modified_substring = modified_substring.replace(/Æ/g, "र्f");  // at some places  Æ  is  used eg  in "धार्मिक".
									var position_of_i = modified_substring.indexOf("f")
									while (position_of_i != -1)  //while-02
									{
										var charecter_next_to_i = modified_substring.charAt(position_of_i + 1)
										var charecter_to_be_replaced = "f" + charecter_next_to_i
										modified_substring = modified_substring.replace(charecter_to_be_replaced, charecter_next_to_i + "ि")
										position_of_i = modified_substring.search(/f/, position_of_i + 1) // search for i ahead of the current position.

									} // end of while-02 loop
									//**********************************************************************************
									// Glyph3 & Glyph4: Ç  É
									// code for replacing "fa" with "िं"  and correcting its position too.(moving it two positions forward)
									//**********************************************************************************
									modified_substring = modified_substring.replace(/Ç/g, "fa"); // at some places  Ç  is  used eg  in "किंकर".
									modified_substring = modified_substring.replace(/É/g, "र्fa"); // at some places  É  is  used eg  in "शर्मिंदा"
									var position_of_i = modified_substring.indexOf("fa")
									while (position_of_i != -1)  //while-02
									{
										var charecter_next_to_ip2 = modified_substring.charAt(position_of_i + 2)
										var charecter_to_be_replaced = "fa" + charecter_next_to_ip2
										modified_substring = modified_substring.replace(charecter_to_be_replaced, charecter_next_to_ip2 + "िं")
										position_of_i = modified_substring.search(/fa/, position_of_i + 2) // search for i ahead of the current position.

									} // end of while-02 loop

									//**********************************************************************************
									// Glyph5: Ê
									// code for replacing "h" with "ी"  and correcting its position too.(moving it one positions forward)
									//**********************************************************************************

									modified_substring = modified_substring.replace(/Ê/g, "ीZ"); // at some places  Ê  is  used eg  in "किंकर".


									/*
									var position_of_i = modified_substring.indexOf( "h" )

									while ( position_of_i != -1 )  //while-02
									{
									var charecter_next_to_i = modified_substring.charAt( position_of_i + 1 )
									var charecter_to_be_replaced = "h" + charecter_next_to_i
									modified_substring = modified_substring.replace( charecter_to_be_replaced , charecter_next_to_i + "ी" ) 
									position_of_i = modified_substring.search( /h/ , position_of_i + 1 ) // search for i ahead of the current position.

									} // end of while-02 loop
									*/


									//**********************************************************************************
									// End of Code for Replacing four Special glyphs
									//**********************************************************************************

									// following loop to eliminate 'chhotee ee kee maatraa' on half-letters as a result of above transformation.

									var position_of_wrong_ee = modified_substring.indexOf("ि्")

									while (position_of_wrong_ee != -1)  //while-03
									{
										var consonent_next_to_wrong_ee = modified_substring.charAt(position_of_wrong_ee + 2)
										var charecter_to_be_replaced = "ि्" + consonent_next_to_wrong_ee
										modified_substring = modified_substring.replace(charecter_to_be_replaced, "्" + consonent_next_to_wrong_ee + "ि")
										position_of_wrong_ee = modified_substring.search(/ि्/, position_of_wrong_ee + 2) // search for 'wrong ee' ahead of the current position. 

									} // end of while-03 loop

									//**************************************
									// 
									//**************************************
									//   alert(modified_substring);
									//**************************************

									// Eliminating reph "Z" and putting 'half - r' at proper position for this.
									set_of_matras = "अ आ इ ई उ ऊ ए ऐ ओ औ ा ि ी ु ू ृ े ै ो ौ ं : ँ ॅ"
									var position_of_R = modified_substring.indexOf("Z")

									while (position_of_R > 0)  // while-04
									{
										probable_position_of_half_r = position_of_R - 1;
										var charecter_at_probable_position_of_half_r = modified_substring.charAt(probable_position_of_half_r)


										// trying to find non-maatra position left to current O (ie, half -r).

										while (set_of_matras.match(charecter_at_probable_position_of_half_r) != null)  // while-05
										{
											probable_position_of_half_r = probable_position_of_half_r - 1;
											charecter_at_probable_position_of_half_r = modified_substring.charAt(probable_position_of_half_r);

										} // end of while-05


										charecter_to_be_replaced = modified_substring.substr(probable_position_of_half_r, (position_of_R - probable_position_of_half_r));
										new_replacement_string = "र्" + charecter_to_be_replaced;
										charecter_to_be_replaced = charecter_to_be_replaced + "Z";
										modified_substring = modified_substring.replace(charecter_to_be_replaced, new_replacement_string);
										position_of_R = modified_substring.indexOf("Z");

									} // end of while-04

								} // end of IF  statement  meant to  supress processing of  blank  string.

								//**************************************
								//   alert(modified_substring);
								//**************************************


							} // end of the function  Replace_Symbols
						}
						
						
						
						function convert_to_unicode2() {
							var array_one = new Array(
							"ñ", "Q+Z", "sas", "aa", ")Z", "ZZ", "‘", "’", "“", "”",
							"å", "ƒ", "„", "…", "†", "‡", "ˆ", "‰", "Š", "‹",
							"¶+", "d+", "[+k", "[+", "x+", "T+", "t+", "M+", "<+", "Q+", ";+", "j+", "u+",
							"Ùk", "Ù", "ä", "–", "—", "é", "™", "=kk", "f=k",
							"à", "á", "â", "ã", "ºz", "º", "í", "{k", "{", "=", "«",
							"Nî", "Vî", "Bî", "Mî", "<î", "|", "K", "}",
							"J", "Vª", "Mª", "<ªª", "Nª", "Ø", "Ý", "nzZ", "æ", "ç", "Á", "xz", "#", ":",
							"v‚", "vks", "vkS", "vk", "v", "b±", "Ã", "bZ", "b", "m", "Å", ",s", ",", "_",
							"ô", "d", "Dk", "D", "[k", "[", "x", "Xk", "X", "Ä", "?k", "?", "³",
							"pkS", "p", "Pk", "P", "N", "t", "Tk", "T", ">", "÷", "¥",
							"ê", "ë", "V", "B", "ì", "ï", "M+", "<+", "M", "<", ".k", ".",
							"r", "Rk", "R", "Fk", "F", ")", "n", "/k", "èk", "/", "Ë", "è", "u", "Uk", "U",
							"i", "Ik", "I", "Q", "¶", "c", "Ck", "C", "Hk", "H", "e", "Ek", "E",
							";", "¸", "j", "y", "Yk", "Y", "G", "o", "Ok", "O",
							"'k", "'", "\"k", "\"", "l", "Lk", "L", "g",
							"È", "z",
							"Ì", "Í", "Î", "Ï", "Ñ", "Ò", "Ó", "Ô", "Ö", "Ø", "Ù", "Ük", "Ü",
							"‚", "ks", "kS", "k", "h", "q", "w", "`", "s", "S",
							"a", "¡", "%", "W", "•", "·", "∙", "·", "~j", "~", "\\", "+", " ः",
							"^", "*", "Þ", "ß", "(", "¼", "½", "¿", "À", "¾", "A", "-", "&", "&", "Œ", "]", "~ ", "@")
							
							var array_two = new Array(
							"॰", "QZ+", "sa", "a", "र्द्ध", "Z", "\"", "\"", "'", "'",
							"०", "१", "२", "३", "४", "५", "६", "७", "८", "९",
							"फ़्", "क़", "ख़", "ख़्", "ग़", "ज़्", "ज़", "ड़", "ढ़", "फ़", "य़", "ऱ", "ऩ",    // one-byte nukta varNas
							"त्त", "त्त्", "क्त", "दृ", "कृ", "न्न", "न्न्", "=k", "f=",
							"ह्न", "ह्य", "हृ", "ह्म", "ह्र", "ह्", "द्द", "क्ष", "क्ष्", "त्र", "त्र्",
							"छ्य", "ट्य", "ठ्य", "ड्य", "ढ्य", "द्य", "ज्ञ", "द्व",
							"श्र", "ट्र", "ड्र", "ढ्र", "छ्र", "क्र", "फ्र", "र्द्र", "द्र", "प्र", "प्र", "ग्र", "रु", "रू",
							"ऑ", "ओ", "औ", "आ", "अ", "ईं", "ई", "ई", "इ", "उ", "ऊ", "ऐ", "ए", "ऋ",
							"क्क", "क", "क", "क्", "ख", "ख्", "ग", "ग", "ग्", "घ", "घ", "घ्", "ङ",
							"चै", "च", "च", "च्", "छ", "ज", "ज", "ज्", "झ", "झ्", "ञ",
							"ट्ट", "ट्ठ", "ट", "ठ", "ड्ड", "ड्ढ", "ड़", "ढ़", "ड", "ढ", "ण", "ण्",
							"त", "त", "त्", "थ", "थ्", "द्ध", "द", "ध", "ध", "ध्", "ध्", "ध्", "न", "न", "न्",
							"प", "प", "प्", "फ", "फ्", "ब", "ब", "ब्", "भ", "भ्", "म", "म", "म्",
							"य", "य्", "र", "ल", "ल", "ल्", "ळ", "व", "व", "व्",
							"श", "श्", "ष", "ष्", "स", "स", "स्", "ह",
							"ीं", "्र",
							"द्द", "ट्ट", "ट्ठ", "ड्ड", "कृ", "भ", "्य", "ड्ढ", "झ्", "क्र", "त्त्", "श", "श्",
							"ॉ", "ो", "ौ", "ा", "ी", "ु", "ू", "ृ", "े", "ै",
							"ं", "ँ", "ः", "ॅ", "ऽ", "ऽ", "ऽ", "ऽ", "्र", "्", "?", "़", ":",
							"‘", "’", "“", "”", ";", "(", ")", "{", "}", "=", "।", ".", "-", "µ", "॰", ",", "् ", "/")
							var array_one_length = array_one.length;

							var modified_substring = document.getElementById("modalbytes").value;

							//****************************************************************************************
							//  Break the long text into small bunches of max. max_text_size  characters each.
							//****************************************************************************************
							var text_size = document.getElementById("modalbytes").value.length;

							var processed_text = '';  //blank

							var sthiti1 = 0; var sthiti2 = 0; var chale_chalo = 1;

							var max_text_size = 6000;

							while (chale_chalo == 1) {
								sthiti1 = sthiti2;

								if (sthiti2 < (text_size - max_text_size)) {
									sthiti2 += max_text_size;
									while (document.getElementById("modalbytes").value.charAt(sthiti2) != ' ') { sthiti2--; }
								}
								else { sthiti2 = text_size; chale_chalo = 0 }

								var modified_substring = document.getElementById("modalbytes").value.substring(sthiti1, sthiti2);

								Replace_Symbols();

								processed_text += modified_substring;

								//****************************************************************************************
								//  Breaking part code over
								//****************************************************************************************
								//  processed_text = processed_text.replace( /mangal/g , "Krutidev010" ) ;   

								document.getElementById('bytes').value = processed_text;
							}


							// --------------------------------------------------


							function Replace_Symbols() {

								//substitute array_two elements in place of corresponding array_one elements

								if (modified_substring != "")  // if stringto be converted is non-blank then no need of any processing.
								{
									for (input_symbol_idx = 0; input_symbol_idx < array_one_length; input_symbol_idx++) {

										idx = 0;  // index of the symbol being searched for replacement

										while (idx != -1) //whie-00
										{

											modified_substring = modified_substring.replace(array_one[input_symbol_idx], array_two[input_symbol_idx])
											idx = modified_substring.indexOf(array_one[input_symbol_idx])

										} // end of while-00 loop
									} // end of for loop

									//**********************************************************************************
									// Code for Replacing five Special glyphs
									//**********************************************************************************

									//**********************************************************************************
									// Code for Glyph1 : ± (reph+anusvAr)
									//**********************************************************************************
									modified_substring = modified_substring.replace(/±/g, "Zं"); // at some places  ì  is  used eg  in "कर्कंधु,पूर्णांक".
									//
									//**********************************************************************************
									// Glyp2: Æ
									// code for replacing "f" with "ि" and correcting its position too. (moving it one position forward)
									//**********************************************************************************

									modified_substring = modified_substring.replace(/Æ/g, "र्f");  // at some places  Æ  is  used eg  in "धार्मिक".

									var position_of_i = modified_substring.indexOf("f")

									while (position_of_i != -1)  //while-02
									{
										var charecter_next_to_i = modified_substring.charAt(position_of_i + 1)
										var charecter_to_be_replaced = "f" + charecter_next_to_i
										modified_substring = modified_substring.replace(charecter_to_be_replaced, charecter_next_to_i + "ि")
										position_of_i = modified_substring.search(/f/, position_of_i + 1) // search for i ahead of the current position.

									} // end of while-02 loop

									//**********************************************************************************
									// Glyph3 & Glyph4: Ç  É
									// code for replacing "fa" with "िं"  and correcting its position too.(moving it two positions forward)
									//**********************************************************************************

									modified_substring = modified_substring.replace(/Ç/g, "fa"); // at some places  Ç  is  used eg  in "किंकर".
									modified_substring = modified_substring.replace(/É/g, "र्fa"); // at some places  É  is  used eg  in "शर्मिंदा"

									var position_of_i = modified_substring.indexOf("fa")

									while (position_of_i != -1)  //while-02
									{
										var charecter_next_to_ip2 = modified_substring.charAt(position_of_i + 2)
										var charecter_to_be_replaced = "fa" + charecter_next_to_ip2
										modified_substring = modified_substring.replace(charecter_to_be_replaced, charecter_next_to_ip2 + "िं")
										position_of_i = modified_substring.search(/fa/, position_of_i + 2) // search for i ahead of the current position.

									} // end of while-02 loop

									//**********************************************************************************
									// Glyph5: Ê
									// code for replacing "h" with "ी"  and correcting its position too.(moving it one positions forward)
									//**********************************************************************************

									modified_substring = modified_substring.replace(/Ê/g, "ीZ"); // at some places  Ê  is  used eg  in "किंकर".


									/*
									var position_of_i = modified_substring.indexOf( "h" )

				while ( position_of_i != -1 )  //while-02
									{
									var charecter_next_to_i = modified_substring.charAt( position_of_i + 1 )
									var charecter_to_be_replaced = "h" + charecter_next_to_i
									modified_substring = modified_substring.replace( charecter_to_be_replaced , charecter_next_to_i + "ी" ) 
									position_of_i = modified_substring.search( /h/ , position_of_i + 1 ) // search for i ahead of the current position.

				} // end of while-02 loop
									*/


									//**********************************************************************************
									// End of Code for Replacing four Special glyphs
									//**********************************************************************************

									// following loop to eliminate 'chhotee ee kee maatraa' on half-letters as a result of above transformation.

									var position_of_wrong_ee = modified_substring.indexOf("ि्")

									while (position_of_wrong_ee != -1)  //while-03
									{
										var consonent_next_to_wrong_ee = modified_substring.charAt(position_of_wrong_ee + 2)
										var charecter_to_be_replaced = "ि्" + consonent_next_to_wrong_ee
										modified_substring = modified_substring.replace(charecter_to_be_replaced, "्" + consonent_next_to_wrong_ee + "ि")
										position_of_wrong_ee = modified_substring.search(/ि्/, position_of_wrong_ee + 2) // search for 'wrong ee' ahead of the current position. 

									} // end of while-03 loop

									//**************************************
									// 
									//**************************************
									//   alert(modified_substring);
									//**************************************

									// Eliminating reph "Z" and putting 'half - r' at proper position for this.
									set_of_matras = "अ आ इ ई उ ऊ ए ऐ ओ औ ा ि ी ु ू ृ े ै ो ौ ं : ँ ॅ"
									var position_of_R = modified_substring.indexOf("Z")

									while (position_of_R > 0)  // while-04
									{
										probable_position_of_half_r = position_of_R - 1;
										var charecter_at_probable_position_of_half_r = modified_substring.charAt(probable_position_of_half_r)


										// trying to find non-maatra position left to current O (ie, half -r).

										while (set_of_matras.match(charecter_at_probable_position_of_half_r) != null)  // while-05
										{
											probable_position_of_half_r = probable_position_of_half_r - 1;
											charecter_at_probable_position_of_half_r = modified_substring.charAt(probable_position_of_half_r);

										} // end of while-05


										charecter_to_be_replaced = modified_substring.substr(probable_position_of_half_r, (position_of_R - probable_position_of_half_r));
										new_replacement_string = "र्" + charecter_to_be_replaced;
										charecter_to_be_replaced = charecter_to_be_replaced + "Z";
										modified_substring = modified_substring.replace(charecter_to_be_replaced, new_replacement_string);
										position_of_R = modified_substring.indexOf("Z");

									} // end of while-04

								} // end of IF  statement  meant to  supress processing of  blank  string.

								//**************************************
								//   alert(modified_substring);
								//**************************************


							} // end of the function  Replace_Symbols
						}
						
				
				var $dOut = $('#date'),
					$hOut = $('#hours'),
					$mOut = $('#minutes'),
					$sOut = $('#seconds'),
					$ampmOut = $('#ampm');
				var months = [
				  'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
				];

				var days = [
				  'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
				];

				
				function update(){  
				  date = new Date(<?php echo date("Y");?>,<?php echo date("m");?>,<?php echo date("d");?>,<?php echo date("H");?>,<?php echo date("i");?>,<?php echo date("s");?>);
				  //var date = new Date();
				  var ampm = date.getHours() < 12
							 ? 'AM'
							 : 'PM';
				  
				  var hours = date.getHours() == 0
							  ? 12
							  : date.getHours() > 12
								? date.getHours() - 12
								: date.getHours();
				  
				  var minutes = date.getMinutes() < 10 
								? '0' + date.getMinutes() 
								: date.getMinutes();
				  
				  var seconds = date.getSeconds() < 10 
								? '0' + date.getSeconds() 
								: date.getSeconds();
				  
				  var dayOfWeek = days[date.getDay()];
				  var month = months[date.getMonth()];
				  var day = date.getDate();
				  var year = date.getFullYear();
				  
				  var dateString = dayOfWeek + ', ' + month + ' ' + day + ', ' + year;
				  
				  $dOut.text(dateString);
				  $hOut.text(hours);
				  $mOut.text(minutes);
				  $sOut.text(seconds);
				  $ampmOut.text(ampm);
				} 

				update();
				window.setInterval(update, 1000);
				
				
				
				
						
			}); 
		</script>
			
			
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
         Â© 2020 IBC24 (S.B Multimedia Pvt. Ltd.) All Rights Reserved.
        </div>

        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>