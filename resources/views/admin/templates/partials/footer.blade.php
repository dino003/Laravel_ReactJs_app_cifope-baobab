<script>
	window.Laravel = <?php echo json_encode([
			'csrfToten' => csrf_token(),
	]); ?>
</script>
<!--scrolling js-->

<script src="{{asset('js/app2.js')}}"></script>

<script src="{{asset('js/emplo.js')}}"></script>
<script src="{{asset('js/chat.js')}}"></script>
<script src="{{asset('js/article.js')}}"></script>
<script src="{{asset('js/profil.js')}}"></script>
<script src="{{asset('js/message.js')}}"></script>
<script src="{{asset('js/todo.js')}}"></script>
<script src="{{asset('js/trace.js')}}"></script>
<script src="{{asset('js/role.js')}}"></script>





<!--//jquery js-->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

  <!--fin jquery -->
<script src="{{asset('js/bootstrap-treeview.js')}}"></script>

<script src="https://kendo.cdn.telerik.com/2018.3.911/js/kendo.all.min.js"></script>

  <!--bootstrap -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
 integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
  crossorigin="anonymous">
  </script>
    <!--fin bootstrap -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.5/js/froala_editor.pkgd.min.js"></script>

	




<script type="text/javascript" src="{{asset('dist/imageuploadify.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="{{asset('dist/jquery.buttonLoader.js')}}"></script>
<script src="{{asset('css/dataTable/jquery.dataTables.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('css/dataTable/dataTables.bootstrap.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	 
	<script>
		 $('.progress').hide();
		@if(Session::has('success'))
			toastr.success("{{ Session::get('success')}}")
		
		@endif
		
		@if(Session::has('info'))
			toastr.info("{{ Session::get('info')}}")
		
		@endif
	
	</script>
