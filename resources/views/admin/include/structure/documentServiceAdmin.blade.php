<div class="row">
  
  <div class="col-md-7">
   
   @can('Ajouter-Document')
<a href="#"><em class="" onclick="$('#ajouterfichier1').modal('show');">
    Ajouter un document pour le service</em></a>
    
@endcan

@can('Voir-Tous-Les-Documents')
   <table id="document14" class="table table-striped">
    <thead>
       <tr>
<th>Nom</th>
<th>type</th>
<th>Taille</th>
<th>Auteur</th>
<th>Date d'envoi</th>
<th></th>

</tr>
    </thead>
    <tbody>
      <?php 
$byte=0;
      foreach ($document as $docvalue): 
$datecreate = strtotime($docvalue->created_at);
$param1=Crypt::encrypt($docvalue->id);
        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
    
     $premierchaine=$tableauchaine[0];
 $byte=$byte + $docvalue->doc_size;
 $param=Crypt::encrypt($docvalue->id);
 $param10=Crypt::encrypt($docvalue->structure_id);
                     
                      ?>

<tr>
  <td>   <a href="{{url('telecharger')}}/{{$param}}/structure/{{$param10}}" target="_blank">
  <img  src="{{asset('assets/icone')}}/{{$docvalue->icone}}" alt="Card image cap" width='30' height='30'>
     <small class="text-muted" >{{str_limit($premierchaine, 15)}}</small></a>
  </td>
  <td><a href="{{url('telecharger')}}/{{$param}}/structure/{{$param10}}" target="_blank"><font color="black">  <small class="text-muted" >{{$docvalue->type_document}}</small></font></a></td>
<td>{{$docvalue->taille}}</td>
  <td><small class="text-muted"><i>{{$docvalue->user->name}} {{$docvalue->user->prenom}}</i></small></td>
  <td><small class="text-muted"><i>{{$docvalue->created_at}}</i></small></td>
  <td>
  <?php if (Auth::user()->id==$docvalue->user_id): ?>
    <a href="{{url('deleteDocumentServie')}}/{{$param1}}" onclick="if(! confirm('Voulez vous supprimer le document?'))return false;" title="Supprimer"><font color="#000"><i class="fa fa-trash"></i></font></a>
  <?php endif ?>
    

  </td>
</tr>

                      <?php endforeach ?>
    </tbody>
 
</table>
 @endcan

  </div>
  <div class="col-md-4">
   @can('Ajouter-Document')
         <a href="#"> <em class="" onclick="$('#ajouterfichier').modal('show');">
<i class="  fa fa-pencil-square-o" title="" ></i>créé des dossiers</em></a>
   @endcan   

@can('Voir-Tous-Les-Documents')
      
          <table id="dossier01" class="table table-striped">
      <thead>
                 <tr>
                    <th>Nom</th>
                    <th>Date de creation</th>
                      <th>Action</th>
                 </tr>
      </thead>
          <tbody>

 <?php foreach ($dossier as  $value): 
$param1=Crypt::encrypt($value->id);
$param2=Crypt::encrypt($structure->id);

  ?>
                <?php
$nbdocument = \App\Document::where('dossier_id', '=', $value->id)->count();
$nbsousdossier = \App\Dossier::where('dossier_id', '=', $value->id)->count();
$nbfichier=$nbsousdossier + $nbdocument;
                 ?>
                    <tr>
                      <td><?php if (isset($service)): ?>
                          <a href="{{url('SousDossierService')}}/{{$param1}}/structure/{{$param2}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
                {{$value->nom_dossier}}({{$nbfichier}})
              </a>
                      <?php else: ?>
                          <a href="{{url('SousDossier')}}/{{$param1}}/structure/{{$param2}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
                {{$value->nom_dossier}}({{$nbfichier}})
              </a>
                      <?php endif ?>
                 
                      </td>
                      <td>{{$value->created_at}}</td>
                      <td>
                        <?php if (Auth::user()->id==$value->user_id): ?>
                         <a href="#"><em class="" onclick="$('#update{{$value->id}}').modal('show');"><i class="  fa fa-pencil-square-o" title="" ></i>    
                            </em></a>   

        <a href="{{url('deleteDossier')}}/{{$value->id}}" class="" onclick="if(! confirm('Voulez vous supprimer le dossier?'))return false;" title="Supprimer"><i class="fa fa-trash"></i></a>
                        <?php endif ?>
     

                      </td>
                    </tr>

                    <div class="modal fade" id="update{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
                                   
                      <div class="modal-header">
                                 <h4 class="modal-title" id="myModalLabel">Modification de dossier </h4>
                       </div>
                  <div class="modal-body">
        <form method="post" action="{{url('UpdateDossier')}}" enctype="multipart/form-data">
   {{ csrf_field() }}                         
   <input type="hidden" name="id" value="{{$value->id}}">
        <div class="form-group">
                                                <label><h5>Nom de dossier <font color="red">*</font></h5></label>
                                                  <input type="text" name="nom_dossier"  value="{{$value->nom_dossier}}" class="form-control">
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
          </tbody>
        </table>
      @endcan 
  </div>

</div>


<div class="modal fade" id="ajouterfichier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

<div class="modal-dialog">
 <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Crée dossier </h4>
 </div>  
 <div class="modal-body">
 <fieldset>
   <form method="POST" action="" id="formulaire58901">
                            {{ csrf_field() }}
       <input name="nom_dossier[]" placeholder="Nom dossier" class="form-control item_name" type="text">
        <input type="hidden" name="structure_id" value="{{$structure->id}}">
       <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
               <button type="submit" class="btn btn-primary has-spinner1000001" name="modifier">Ajouter</button>
         </div>
    </form>
</fieldset>

 </div>




 </div> 
</div>

</div>



<div class="modal fade" id="ajouterfichier1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

<div class="modal-dialog">
 <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter un document </h4>
 </div>  
 <div class="modal-body">
  <div class="" id="message-info"></div>
 <fieldset>
  <!--<form method="post" action="{{ url('AddDocumentService')}}" enctype="multipart/form-data"  class="dropzone" id="Uploade">
 

 <input type="hidden" class="form-control" name="id" value="{{$structure->id}}">
 <input type="hidden" name="genre_document" value="tous_le_service">


</form>-->
<form method="post"  enctype="multipart/form-data" id="formulaire">
          {{ csrf_field() }}

 <input type="hidden" class="form-control" name="id[]" value="{{$structure->id}}">
 <input type="hidden" name="genre_document" value="tous_le_service">

<input type="file" accept=".jpeg,.jpg,.png,.gif,.doc,.dot,.docx,.dotx,.docm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xls,.xlt,.xml,.xlam,.xla,.xlw,.xlr,.pptx,.pptm,.ppsm,.ppt,.potx,.potm,.pot,.ppsx,.pps,.ppam,.ppa,.mde,.accde,.adp,.accdp,.accdr,.one,.onepkg,.vsd,.vst,.vsdm,.mpt,.mpp,.pub,.pdf,.rar,.zip" name="file[]" id="image1"multiple>

 <div class="progress skill-bar ">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <span class="skill">Chargement en cours... <i class="val"></i></span>
                </div>
            </div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary has-spinner123" name="modifier" id="ajoute1">Ajouter</button>
                    </div>
 </form>
</fieldset>

 </div>




 </div> 
</div>

</div>







@section('document')

<script>
$(document).ready(function () {
     $("#ajoute1").prop('disabled', true);
  $( "#image1" ).change(function() {
   $("#ajoute1").prop('disabled', false);
});
    $('.has-spinner123').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{ url('AddDocumentServiceMultiple')}}",
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
                  $("#formulaire").trigger("reset");
              // $('#formulaire').reset();
              $('.imageuploadify-container').remove();
                 $("#ajoute1").prop('disabled', true);
        setInterval(function(){
  
                $('#document14').load(location.href + " #document14>*","");
              $('#document14').DataTable();

            

            },1500);
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        





    });
});
</script>
<script>
$(document).ready(function () {
    
    $('.has-spinner1000001').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{url('AddDossier')}}",
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
                $("#formulaire58901").trigger("reset");
              // $('#formulaire').reset();
         
  
                $('#dossier01').load(location.href + " #dossier01","");
             // $('#dossier').DataTable();

            

        
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
  $(function () {
   
      $('#document14').DataTable()
  })
</script>

<script>
  $(function () {
   
      $('#dossier01').DataTable()
  })
</script>


@endsection
<!--Fin--->