@extends('admin.templates.main')


@section('content')

<div class="container">
  <div class="row">
<div class="panel panel-default">
  <div class="panel-heading">Gestion des racourcies</div>
  <div class="panel-body">
  	<div class="row">
  		<div class="col-md-6">
  			<h3>Liste des racourcies de ordinateur</h3>
  			<div class="panel panel-default">
  			<div class="panel-body">
  			 <div class="row">
  			 	<?php foreach ($listeracourcie as  $value): ?>
  			 		<div class="col-md-2">
  			 			<a href="{{url('Lancer')}}/{{$value->id}}" >
  	<img  src="{{asset('/uploads/iconeracourcie/icone/')}}/{{$value->icone}}" alt="Card image cap" width='40' height='40'>
  	  <small class="text-muted" >{{str_limit($value->nom_racourcie, 15)}}</small>
  </a>
  			 		</div>
  			 	<?php endforeach ?>
  			 </div>
  			</div>
  		   </div>
  		</div>


  		<div class="col-md-6">
  			<h3>Ajouter un raccourcie</h3>
  		   <div class="panel panel-default">
  			<div class="panel-body">
  				
  				<form enctype="multipart/form-data" method="post" action="{{url('AddRacourcie')}}">
  					 {{ csrf_field() }}
  					 <div class="form-group col-md-6">
      <label for="inputEmail4">Nom raccourcie</label>
      <input type="" class="form-control" name="racourcie" placeholder='Ex: C:\MyApp\LoadAutoRun.exe ou www.exemple.com'>
    </div>

    			 <div class="form-group col-md-6">
      <label for="inputEmail4">Entre le chemin du fichier</label>
      <input type="" class="form-control" name="nom_racourcie" placeholder=''>
    </div>
    <div class="form-group col-md-12">
      <label for="inputPassword4">Icone de l'application</label>
      <input type="file" accept=".jpeg,.jpg,.png,.gif" name="file[]" id="image8" multiple>
   
    </div>
     <div class="form-group col-md-12">
    <button type="submit" class="btn btn-primary has-spinner1" name="modifier" id="ajoute8">Ajouter</button>
    </div>
  				</form>
  			</div>
  		   </div>
  		</div>


  	</div>

  </div>
</div>
</div>
</div>

@section('document_chef_envoye')
 <script>
/*$(document).ready(function () {
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
            url: "{{ url('AddRacourcie')}}",
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
  
                $('#racourcie').load(location.href + " #racourcie>*","");
              $('#racourcie').DataTable();

            

            },1500);
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        





    });
});*/
</script>
<script>
  $(function () {
   
      $('#racourcie').DataTable()
  })
</script>


@endsection

@endsection