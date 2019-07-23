@extends('admin.templates.main')


@section('content')
<div class="nav-tabs-custom container">

<div class="panel panel-default">
  <div class="panel-heading">
  	<div class="row">
  		<div class="col-md-7"><h4><b><a href="#" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
               Mes dossiers
              </a></b></h4></div>
  		<!-- <div class="col-md-4" align="right" id="capacite">
          
        </div>-->
  	</div>
  		

  	</div>
  <div class="panel-body">
 <div class="row">
   <div class="col-md-1">
    
     <!--<div class="" id="treeview"></div>-->
   </div>
   <div class="col-md-10">
     <b><a href="#">
<em class="" onclick="$('#cree_dossier').modal('show');"><i class="  fa fa-pencil-square-o" title="" ></i> Créé des dossiers  
</em>
</a></b>
     <div class="panel panel-default">
       <div class="panel-body">
<div class="row" id="dossier01">
  <?php foreach ($mesdossier as  $value): 
$nbdocument = \App\Mesdocument::where('mesdossier_id', '=', $value->id)->count();
$nbsousdossier = \App\Mesdossier::where('mesdossier_id', '=', $value->id)->count();
$nbfichier=$nbsousdossier + $nbdocument;
$param=Crypt::encrypt($value->id);
      ?>


<div class="col-md-2" align="center">
  <a href="{{url('DetailMonDossier')}}/{{$param}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='30' height='30' ><br>
               {{$value->nom_dossier}} ({{$nbfichier}})
              </a><br>
         <a href="" class="" data-toggle="modal" data-target="#update{{$value->id}}">
         <font color="#000"><i class="  fa fa-pencil-square-o" title="" ></i></font></a>
         <a href="{{url('deleteMydossier')}}/{{$value->id}}" class="" onclick="if(! confirm('Voulez vous supprimer le dossier?'))return false;" title="Supprimer">
         <font color="#000"><i class="fa fa-trash"></i></font></a>
</div>


 <div class="modal fade" id="update{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">

       <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Modification de dossier </h4>
 </div>
         <div class="modal-body">
        <form method="post" action="{{url('UpadeMondossier')}}" enctype="multipart/form-data">
   {{ csrf_field() }}                         

         <div class="form-group">
                   <input type="hidden" name="id" value="{{$value->id}}">
            <input type="text" name="nom_dossier" class="form-control" value="{{$value->nom_dossier}}">
         
         </div>
         
 <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary" name="modifier">Modification</button>
                                            </div>
        </form>
    </div>
       </div>
   </div>
</div>

<?php endforeach ?>
</div>
       </div>
     </div>
   </div>
   <div class="col-md-1"></div>
 </div>





  </div>
 </div>

</div>
</div>



   <div class="modal fade" id="cree_dossier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
               <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Crée un dossier  </h4>
            <div id="response"></div>
 </div>                       
                     
                  <div class="modal-body">
        <form method="post" action="" enctype="multipart/form-data" id="formulaire">
   {{ csrf_field() }}                         

<input type="text"  name="nom_dossier[]" placeholder="Nom dossier" class="form-control item_name">


                                              <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary has-spinner10" name="modifier">Ajouter</button>
                                            </div>
       </form>
                  </div>
      </div>
 </div>


</div>



 @section('script')
 <script >
   $(document).ready(function(){ 
    treeViewMesDossier();

    });

 function treeViewMesDossier() {
$.ajax({
  url:"{{url('treeViewMesDossier')}}",
  method:"GET",
  dataType:"json",
  success:function(data){
 // $('#treeview').treeview({data:});
  console.log(data);
  var tableau ={data};
  var result = Array.from(Object.keys(data), k=>data[k]);
  console.log(result);
  $('#treeview').treeview({data:result,enableLinks: true});

  }

})
}
</script>
 <script>
$(document).ready(function () {
    capacite();
    $('.has-spinner10').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{url('Addmesdossier')}}",
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
             error: function(xhr, status, error) {
  $(btn).buttonLoader('stop');
        swal({
           title: "une erreur s'est produite au cours de l'enregistrement",
           text: "",
            icon: "error",
            button: "ok",
              });
             },
            success: function (data) {
          
                $(btn).buttonLoader('stop');
               // alert("Data Uploaded: "+data);
              $('#message-info').html(' <div class="alert alert-success alert-dismissable">Dossier crée <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

                swal({
           title: "Dossier créé",
           text: "",
            icon: "success",
            button: "ok",
              });
                $("#formulaire").trigger("reset");
              // $('#formulaire').reset();
         
  
                $('#dossier').load(location.href + " #dossier","");
             // $('#dossier').DataTable();
                $('#dossier01').load(location.href + " #dossier01","");

                 treeViewMesDossier();

        
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;





    });
});

 function capacite() {

$.ajax({
  url:"{{url('capaciteStokageUtilisateur')}}",
  method:"GET",
  dataType:"json",
  success:function(data){
 //console.log(data);
  $('#capacite').html(data);

  }

})
}
</script>





 @endsection
 @section('document')
<script>
  $(function () {
   
      $('#dossier').DataTable()
  })
</script>
@endsection()



@endsection