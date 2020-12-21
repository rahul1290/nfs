
<script>
	let baseUrl = $('#baseUrl').val();
	$(document).on('click','#btn-search',function(){
		var str = $('#search').val();
		window.location.replace(baseUrl + 'search/'+ str);
	});
</script>

<!--<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2020-2021 <a href="http://adminlte.io"><?php //secho base_url(); ?></a>.</strong> All rights
    reserved.
  </footer>

  
  <aside class="control-sidebar control-sidebar-dark">
   
  </aside>-->
