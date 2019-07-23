@extends('admin.templates.main')


@section('content')
<?php
if (isset($sousdossier)) {
  $active1="";
    $active2="active";
} else {
  $active1="active";
    $active2="";
}

 ?>




 <div class="container">
<div class="panel panel-default">
   <div class="panel-heading">
    <?php $p=Crypt::encrypt($structure->id); ?>
          <a href="{{url('DetailService')}}/{{$p}}"><h4><b>{{$structure->nom_structure}}</b></h4></a>
   </div>


   <div class="panel-body">
      @if(Session::has('success'))
   <div class="alert alert-success alert-dismissable">
      {{Session::get('success')}}
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
   @endif
<div id="info">
  
</div>
  <ul class="nav nav-tabs">
 <li class="{{$active1}}"><a href="#listepersonnel" data-toggle="tab">Liste du personnel</a></li>
 <li class="{{$active2}}"><a href="#support_document" data-toggle="tab">Support document</a></li>
 <?php if ($role->chef==0): ?>
<li class=""><a href="#document_chef_service" data-toggle="tab">Document envoyé au chef de service</a></li>
<?php endif ?>

<?php if ($role->chef==1): ?>
  <li class=""><a href="#document_chef" data-toggle="tab">Document reçu</a></li>
<?php endif ?>
<li class=""><a href="#liens" data-toggle="tab">Liens</a></li>
  </ul>

  <div class="tab-content">


  <div class="{{$active1}} tab-pane container" id="listepersonnel">
  @include('interviens.ListePersonnel') 
  </div>
  <div class="{{$active2}} tab-pane container" id="support_document">
<?php if (isset($sousdossier)): ?>
    @include('document.documentDossier') 
  <?php else: ?>
    @include('document.document_service') 
  <?php endif ?>
  </div>
<?php if ($role->chef==0): ?>
<div class="tab-pane container" id="document_chef_service">
 @include('document.document_envoye_chef') 
</div>
<?php endif ?>
<?php if ($role->chef==1): ?>
<div class="tab-pane container" id="document_chef">
  @include('document.document_chef') 
</div>
<?php endif ?>
  <div class="tab-pane container" id="liens">
 @include('admin.include.structure.liens') 
  </div>
  </div>




   </div>


 </div>







 </div>








<?php
if (isset($Detaildossier)) {
  $id_dossier1=$Detaildossier->id;
} else {
 $id_dossier1='';
}

 ?>

@section('script')


<script type="text/javascript">
	 $(document).ready(function(){

    //liste des documents du dossier
ListeDocumentA();
  function ListeDocumentA(){
   var id_dossier="{{$id_dossier1}}";
$.ajax({
  url:"{{url('ListeDocumentAjax')}}",
  method:'GET',
  data:{query:id_dossier},
  dataType:'json',
  success:function(data){
    $('#listeDocument').html(data.table_data);
    
  }
})

  }


	 	 $(document).on('click','.add',function(){
         	var html =' ';
         	  var info=" ";
         	html +='<tr >';
         	html +='<td align="center"><input type="text"  name="nom_dossier[]" placeholder="Nom dossier" class="form-control item_name"></td>';
         	html +='<td ><button class="btn btn-danger btn-sm remove" type="button" name="add"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
         	$('#item_table').append(html);
         });

         $(document).on('click','.remove',function(){
         	$(this).closest('tr').remove();
         });

          $(document).on('click','.add1',function(){
         	var html =' ';
         	  var info=" ";
         	html +='<tr><hr>';
         	html +='<td><input type="text"  name="nom_structure[]" placeholder="Entre le nom de la structure" class="form-control item_name"></td>';
         	html +='<td><button class="btn btn-danger btn-sm remove1" type="button" name="add1"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
         	$('#item_table1').append(html);
         });

         $(document).on('click','.remove1',function(){
         	$(this).closest('tr').remove();
         });
	 });
</script>

<script>
  $(function () {
   
      $('#document_chef01').DataTable()
  })
</script>
   @endsection

@endsection