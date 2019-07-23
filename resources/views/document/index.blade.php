@extends('admin.templates.main')


@section('content')
<div class="nav-tabs-custom container">
<div class="panel panel-default" id="body">
   <div class="panel-heading">
   	Liste des documents
   </div>
   <div class="panel-body">
   	<ul class="nav nav-tabs">
  <li class="active">
  	<a href="#document_service" data-toggle="tab">Document du service 
                    
</a>
</li>
 <li class="">
  	<a href="#document_autre_service" data-toggle="tab">Document des autres service 
                    
</a>
</li>
 <li class="">
  	<a href="#document_colegue" data-toggle="tab">Document des colegues 
                    
</a>
</li>
   	</ul>

   	    <div class="tab-content">
   	    	 <div class="active tab-pane container" id="document_service">
   	    	 	<div class="row">
   	    	 		<div class="col-md-7">
   	    	 			@include('document.document_service') 
   	    	 		</div>
                     <div class="col-md-5"></div>
   	    	 	</div>
   	    	 </div>
   	    	 	 <div class=" tab-pane container" id="document_autre_service">
   	    	 	 	TEST
   	    	 </div>
   	    	 	 <div class=" tab-pane container" id="document_colegue">
   	    	 	 	ok
   	    	 </div>
   	    </div>
   </div>
</div>

</div>


@endsection