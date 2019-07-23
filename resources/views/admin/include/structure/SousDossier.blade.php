
   <div class="row">
    <div class="col-md-1">
           <?php
$par1=Crypt::encrypt($Detaildossier->dossier_id);

$par2=Crypt::encrypt($structure->id);
            if ($Detaildossier->dossier_id==''): ?>
   <?php if (isset($service)): ?>
     
            <a href="{{url('DetailService')}}/{{$par2}}">Retour</a>
   <?php else: ?>
     
            <a href="{{url('DetailStructure')}}/{{$par2}}">Retour</a>
   <?php endif ?>




           <?php else: ?>


<?php if (isset($service)): ?>
  <a href="{{url('SousDossierService')}}/{{$par1}}/structure/{{$par2}}">Retour</a>
<?php else: ?>
  <a href="{{url('SousDossier')}}/{{$par1}}/structure/{{$par2}}">Retour</a>
<?php endif ?>

    


           <?php endif ?>
        </div>
   	<div class="col-md-2">
   		<h5>  <a href="" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
               {{$Detaildossier->nom_dossier}}
              </a> </h5>
   	</div>
   	
   	<div class="col-md-4">

      @can('Ajouter-Document')
   	 <a href="#"><em class="" onclick="$('#ajouterfichier').modal('show');"> <span>Ajouter un document</span></em></a>	
   	@endcan
   	</div>
   
   </div>


<!--Liste des document et sous dossier--->
<div class="row">
<!---	<div class="col-md-8 " id='listeDocument'>
		
  

	</div>-->

  <div class="col-md-7 box " id=''>
   @can('Voir-Tous-Les-Documents')
  <table id="document" class="table table-striped">
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
      <?php foreach ($document as $docvalue): 
$datecreate = strtotime($docvalue->created_at);

        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
     $premierchaine=$tableauchaine[0];
     $param1=Crypt::encrypt($docvalue->id);
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
  <td><small class="text-muted"><i>{{$datecreate}}</i></small></td>
  <td><a href="{{url('deleteDocumentServie')}}/{{$param1}}" onclick="if(! confirm('Voulez vous supprimer le document?'))return false;" title="Supprimer"><font color="#000"><i class="fa fa-trash"></i></font></a></td>
</tr>

                      <?php endforeach ?>
    </tbody>
 
</table>
  
 @endcan 





  </div>


	<div class="col-md-4">
		
		@include('admin.include.structure.ListeSousDossier')
	</div>


</div>
  
<!--Liste des document et sous dossier--->


<!--Creation de sous dossier--->
                    <div class="modal fade" id="sous_dossier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
                                   
                      <div class="modal-header">
                                 <h4 class="modal-title" id="myModalLabel">Creation de dossier</h4>
                       </div>
                  <div class="modal-body">
        <form method="post" action="" enctype="multipart/form-data" id="formulaire01">
   {{ csrf_field() }}                         
   <input type="hidden" name="dossier_id" value="{{$Detaildossier->id}}">
      

<input name="nom_dossier[]" placeholder="Nom dossier" class="form-control item_name" type="text">
			<input type="hidden" name="structure_id" value="{{$structure->id}}">




                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                               <button type="submit" class="btn btn-info has-spinner101" id="ajouter">Ajouter</button>
                                            </div>
       </form>
                  </div>
      </div>
 </div>


</div>




<div class="modal fade" id="ajouterfichier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter un document </h4>
            <div id="response"></div>
 </div>                          
                     
                  <div class="modal-body">
                 <div class="" id="message-info"></div>
<form method="post"  enctype="multipart/form-data" id="formulaire" >
          {{ csrf_field() }}

<input type="hidden" class="form-control" name="id"  value="{{$Detaildossier->id}}">
<input type="hidden" class="form-control" name="structure_id"  value="{{$structure->id}}">
 <input type="hidden" name="genre_document" value="tous_le_service">
<input type="file" accept=".jpeg,.jpg,.png,.gif,.doc,.dot,.docx,.dotx,.docm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xls,.xlt,.xml,.xlam,.xla,.xlw,.xlr,.pptx,.pptm,.ppsm,.ppt,.potx,.potm,.pot,.ppsx,.pps,.ppam,.ppa,.mde,.accde,.adp,.accdp,.accdr,.one,.onepkg,.vsd,.vst,.vsdm,.mpt,.mpp,.pub,.pdf,.rar,.zip" name="file[]" id="image2" multiple>

 <div class="progress skill-bar ">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <span class="skill">Chargement en cours... <i class="val"></i></span>
                </div>
            </div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary has-spinner2" name="modifier" id="ajoute2">Ajouter</button>
                    </div>
 </form>

      
                  </div>
      </div>
 </div>


</div>
@section('document')
<script>
$(document).ready(function () {
  $("#ajoute2").prop('disabled', true);
  $( "#image2" ).change(function() {
   $("#ajoute2").prop('disabled', false);
});
    $('.has-spinner2').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{ url('AddDocument')}}",
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
                $("#ajoute2").prop('disabled', true);
              $('.imageuploadify-container').remove();
        setInterval(function(){
  
                $('#document').load(location.href + " #document>*","");
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
    
    $('.has-spinner101').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{url('AddSousDossier')}}",
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
                $("#formulaire01").trigger("reset");
              // $('#formulaire').reset();
         
  
                $('#dossier').load(location.href + " #dossier","");
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
   
      $('#document').DataTable()
  })
</script>

@endsection()
<!--Fin--->