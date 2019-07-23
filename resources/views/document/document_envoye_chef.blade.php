


     <div class="row">

     	<div class="col-md-2">
     	</div>
     		<div class="col-md-8">
     			<a href="#">
      <em class="" onclick="$('#ajouterfichier000').modal('show');"><span>Ajouter un document pour le chef</span></em>
     </a> 
<table id="document_chef_envoye" class="table table-striped">
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
      <?php foreach ($documentenvoye as $docvalue): 
$datecreate = strtotime($docvalue->created_at);
$param1=Crypt::encrypt($docvalue->id);
        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
    
     $premierchaine=$tableauchaine[0];
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



     	</div>
     		<div class="col-md-2">
     	</div>

     </div>




     <div class="modal fade" id="ajouterfichier000" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter des documents pour le chef </h4>
            <div id="response"></div>
 </div>                          
                     
                  <div class="modal-body">
                 <div class="" id="message-info"></div>
<form method="post"  id="formulaire1000" enctype="multipart/form-data" >
          {{ csrf_field() }}

 <input type="hidden" class="form-control" name="id[]" value="{{$structure->id}}">
 <input type="hidden" name="genre_document" value="au_cherf">

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

@section('document_chef_envoye')
 <script>
$(document).ready(function () {
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
                   $("#formulaire1000").trigger("reset");
              // $('#formulaire').reset();
              $('.imageuploadify-container').remove();
              // $('#formulaire').reset();
              $("#ajoute8").prop('disabled', true);
        setInterval(function(){
  
                $('#document_chef_envoye').load(location.href + " #document_chef_envoye>*","");
              $('#document_chef_envoye').DataTable();

            

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
  $(function () {
   
      $('#document_chef_envoye').DataTable()
  })
</script>


@endsection