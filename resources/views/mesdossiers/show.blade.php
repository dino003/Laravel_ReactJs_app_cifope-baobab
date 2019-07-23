@extends('admin.templates.main')


@section('content')

<div class="nav-tabs-custom container">

<div class="panel panel-default">
<div class="panel-heading">
    <div class="row">
      <div class="col-md-7"><h4><b><a href="#" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
               Mes dossiers
              </a></b></h4></div>
       <!--<div class="col-md-4" align="right" id="capacite">
          
        </div>-->
    </div>
      
    </div>

  <div class="panel-body">

  	<div class="row">
 <div class="row">
   <div class="col-md-3">
  
     <div class="" id="treeview"></div>
   </div>
   <div class="col-md-9">

<div class="panel panel-default">
<div class="panel-heading">
  <div class="row">
      <div class="col-md-1">
           <?php if ($dossier->mesdossier_id==''): ?>
            <a href="{{url('Mesdossiers')}}"><img src="{{asset('assets/icone/fleche.png')}}"  width='20' height='20' ></a>
           <?php else: 
     $param0=Crypt::encrypt($dossier->mesdossier_id);
            ?>
             <a href="{{url('DetailMonDossier')}}/{{$param0}}"><img src="{{asset('assets/icone/fleche.png')}}"  width='20' height='20' ></a>
           <?php endif ?>
        </div>
    <div class="col-md-8"> <a href="#" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
             {{$dossier->nom_dossier}}
              </a></div>
    <div class="col-md-3">
         <b><a href="#">
<em class="" onclick="$('#cree_dossier').modal('show');"><i class="  fa fa-pencil-square-o" title="" ></i> Créé des dossiers  
</em>
</a></b>
    </div>
  </div>
 
</div>
<div class="panel-body">
  <div class="row" id="dossier01">
  <?php foreach ($sousdossier as  $value):
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

     <hr>

  <div class="row">
    <div class="col-md-10">
           <b><a href="#">
<em class="" onclick="$('#ajouter_document').modal('show');"><i class="  fa fa-pencil-square-o" title="" ></i>Ajouter fichier  
</em>
</a></b>
        <table id="document" class="table table-striped">
    <thead>
       <tr>
<th>Nom</th>
<th>type</th>
<th>Taille</th>
<th>Date d'envoi</th>
<th></th>

</tr>
    </thead>
    <tbody>
      <?php foreach ($document as $docvalue): 
$datecreate = strtotime($docvalue->created_at);

        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
    
     $premierchaine=$tableauchaine[0];
                      ?>

<tr>
  <td>   <a href="{{asset('uploads/documentpersonnel')}}/{{$docvalue->nom_document}}" target="_blank">
  <img  src="{{asset('assets/icone')}}/{{$docvalue->icone}}" alt="Card image cap" width='30' height='30'>
     <small class="text-muted" >{{str_limit($premierchaine, 15)}}</small>
  </td>
  <td>{{$docvalue->type_document}}</td>
<td>{{$docvalue->taille}}</td>
  <td><small class="text-muted"><i>{{$datecreate}}</i></small></td>
  <td><a href="{{url('Mesdocumentdelete')}}/{{$docvalue->id}}" onclick="if(! confirm('Voulez vous supprimer le document?'))return false;" title="Supprimer"><font color="#000"><i class="fa fa-trash"></i></font></a></td>
</tr>

                      <?php endforeach ?>
    </tbody>
 
</table>
    </div>
  </div>
</div>
</div>
 



   </div>
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
   <input type="hidden" name="mesdossier_id" value="{{$dossier->id}}">                 
  
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







<div class="modal fade" id="ajouter_document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter un document  </h4>
            <div id="response"></div>
 </div>                          
                     
                  <div class="modal-body">
                 <div class="" id="message-info"></div>
                      <!---Ajout de document-->



  <form method="post" action="" enctype="multipart/form-data" id="formulaire100">
          {{ csrf_field() }}

 <input type="hidden" class="form-control" name="mesdossier_id" value="{{$dossier->id}}">


<input type="file" accept=".jpeg,.jpg,.png,.gif,.doc,.dot,.docx,.dotx,.docm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xls,.xlt,.xml,.xlam,.xla,.xlw,.xlr,.pptx,.pptm,.ppsm,.ppt,.potx,.potm,.pot,.ppsx,.pps,.ppam,.ppa,.mde,.accde,.adp,.accdp,.accdr,.one,.onepkg,.vsd,.vst,.vsdm,.mpt,.mpp,.pub,.pdf,.rar,.zip" name="file[]" id="image8" multiple>
<div class="progress skill-bar ">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <span class="skill">Chargement en cours... <i class="val"></i></span>
                </div>
            </div>

<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary has-spinner1" name="modifier" id="ajoute8">Ajouter</button>
                    </div>
 </form>
<!--Fin Ajout--->

      
                  </div>
      </div>
 </div>


</div>


@section('document')
<script>
  $(function () {
   
      $('#document').DataTable()
  })
</script>
<script>
  $(function () {
   
      $('#dossier').DataTable()
  })
</script>
@endsection()

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
  setInterval(function(){
  
               
capacite();
            

            },1500);
    $("#ajoute8").prop('disabled', true);
  $( "#image8" ).change(function() {
   $("#ajoute8").prop('disabled', false);
});
    
    $('.has-spinner1').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{ url('AddMesdocument')}}",
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
              $('#message-info').html(' <div class="alert alert-success alert-dismissable">Fichier enregistré <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

                swal({
           title: "Fichier enregistré",
           text: "",
            icon: "success",
            button: "ok",
              });
                $("#formulaire100").trigger("reset");
                $("#ajoute8").prop('disabled', true);
              // $('#formulaire').reset();
               $('.imageuploadify-container').remove();
        setInterval(function(){
  
                $('#document').load(location.href + " #document","");
              $('#document').DataTable();

            

            },1500);
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        return false;





    });
});
</script>

 <script>
$(document).ready(function () {
    
    $('.has-spinner10').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{url('AddSousMondossier')}}",
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
         
  
                $('#dossier01').load(location.href + " #dossier01","");
             // $('#dossier').DataTable();
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
 console.log(data);
  $('#capacite').html(data);

  }

})
}
</script>
 @endsection
@endsection