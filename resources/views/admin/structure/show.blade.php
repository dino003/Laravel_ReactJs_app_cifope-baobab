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


 <div class="nav-tabs-custom container">
 
 <div class="panel panel-default" id="body">
   <div class="panel-heading">
    <div class="row">
      <div class="col-md-1">
           <?php
$param00=Crypt::encrypt($structure->structure_id);
            if ($structure->structure_id==''): ?>
            <a href="{{url('ListeStructure')}}">Retour</a>
           <?php else: 

            ?>
             <a href="{{url('DetailStructure')}}/{{$param00}}">Retour</a>
           <?php endif ?>
        </div>
        <div class="col-md-8">
          <a href="#"><h4><b>{{$structure->nom_structure}}</b></h4></a>
        </div>
    </div>
    </div>
  
<div class="panel-body">

<div id="info">
	
</div>
        <ul class="nav nav-tabs">
          
 <li class="{{$active1}}"><a href="#listepersonnel" data-toggle="tab">Personnel affecté  
                    
</a></li>
             <li class=""><a href="#sous_structure" data-toggle="tab">Sous Structure
                    
</a></li>
  <li class="{{$active2}}"><a href="#support_document" data-toggle="tab">Support document
                    
</a></li>
 <li class=""><a href="#liens" data-toggle="tab">Liens 
                    
</a></li>

        </ul>
    </div>

    <div class="tab-content">


  


 <div class="{{$active1}} tab-pane container" id="listepersonnel">
      <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

 <div class="box-body" >
  <div class="row">
  @include('admin.include.structure.ListePersonnel') 
  </div>
                               
                            </div>

                        </div>
                    </div>
                </div>
    </div>

  	<div class="tab-pane container" id="sous_structure">
  		<div class="row">
                    <div class="col-xs-12">
                        <div class="box">

 <div class="box-body" >
 	<div class="row">
 		
 		@include('admin.include.structure.SousStructure') 
 	</div>
                               
                            </div>

                        </div>
                    </div>
                </div>
  	</div>

  	<div class="{{$active2}} tab-pane container" id="support_document">
  		<div class="row">
                    <div class="col-xs-12">
                        <div class="box">

 <div class="box-body" >
 	
 	<?php if (isset($sousdossier)): ?>
 		@include('admin.include.structure.SousDossier') 
 	<?php else: ?>
  @include('admin.include.structure.documentServiceAdmin')  
 	<?php endif ?>
 		
 	
                               
                            </div>

                        </div>
                    </div>
                </div>
  	</div>


<div class="tab-pane container" id="liens">
      <div class="row">
                    <div class="col-xs-12">
                        <div class="box">

 <div class="box-body" >
  <div class="row">
  @include('admin.include.structure.liens') 
  </div>
                               
                            </div>

                        </div>
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

    //ajoute de document --

 $('#multiple_files').change(function(){
var error_document='';
    var form_data=new FormData();
    var files=$('#multiple_files')[0].files;
    


    if (files.length < 0) {
       error_document +="Vous ne devrez pas selectionne plus de 10 fichier";
    }else{
      for (var i =0; i<files.length;  i++) {
        var name=document.getElementById("multiple_files").files[i].name;
        var ext=name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext,['doc','dot','docx','dotx','docm','xlsx','xlsm','xlsb','xltx','xltm','xls','xlt','xls','xml','xlam','xla','xlw','xlr','pptx','pptm', 'ppsm', 'ppt','potx','potm','pot','ppsx','pps','ppam','ppa','mde','accde','adp','accdp','accdr','one','onepkg','vsd','vst','vsdx','vsdm','mpt','mpp','pub','pdf'])==-1) {
          error_document+="<label class='text-danger'>fichier de type ."+ext+" n'est pas autorisé </label>";
        }

        form_data.append('file[]',document.getElementById("multiple_files").files[i]);
       
      
      }
    }

if (error_document=='') {
  var parametre = [];
 console.log(form_data);
   var id_dossierDo="{{$id_dossier1}}";

   $.ajax({
    url:"{{url('AddDocumentAjax')}}/{{$id_dossier1}}",
    method:"POST",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    },
    data:form_data,
    contentType:false,
    cache:false,
    processData:false,
    beforeSend:function(){
      $('.loading').show();
     // $('#error_multiple_files').html('<br/><label class="text-success">En cours de chargement...</label>');

    },
    success:function(){
        $('.loading').hide();
      $('#error_multiple_files').html('</br><div class="alert alert-success alert-dismissable"> Document Ajouter<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
      ListeDocumentA();
    }
   })

}else{
  $('#multiple_files').val('');
  $('#error_multiple_files').html("<span class='text-danger'>"+error_document+"</span>");
  return false;
}


 });
    //ajoute de document--

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
   @endsection

@endsection