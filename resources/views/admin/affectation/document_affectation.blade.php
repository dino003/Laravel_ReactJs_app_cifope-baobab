@extends('admin.templates.main')


@section('content')

<style type="text/css">
  .k-in{
    font-size: 15px;
    font-Weight: Bold;
  }
</style>
<div class="nav-tabs-custom container">

<div class="panel panel-default">
  <div class="panel-heading"><h4><b>Kognishare / Affectation des documents</b></h4></div>
  <div class="panel-body">

<div class="row">

   <div class="col-md-12">
    <div class="row">
      <div class="col-md-12">
        <div class="" id="message-info"></div>
         @if(Session::has('success'))
   <div class="alert alert-success alert-dismissable">
      {{Session::get('success')}}
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    </div>
   @endif
          <div id="response"></div>

      <form method="post" enctype="multipart/form-data" id="formulaire">
          {{ csrf_field() }}
          <input type="hidden" name="genre_document" value="tous_le_service">
          <div class="row ">

           <div class="col-md-1"></div>
             <div class="col-md-4">
              <h5><b>Veillez choisie la structure *</b> </h5>
                <div id="treeview"></div>
                
            </div>
         
            <div class="col-md-5">
              <div class="form-group">
                <label>Veillez selectionner la destination *</label>
               <select name="genre_document" class="form-control">
                 <option></option>

                  <option value="tous_le_service">Tous le service</option>
                  @can('Envoyer-Document-Au-Chef')
                   <option value="au_cherf">Pour le responsable</option>
                   @endcan
               </select>
              </div>

<input type="file" accept=".jpeg,.jpg,.png,.gif,.doc,.dot,.docx,.dotx,.docm,.xlsx,.xlsm,.xlsb,.xltx,.xltm,.xls,.xlt,.xml,.xlam,.xla,.xlw,.xlr,.pptx,.pptm,.ppsm,.ppt,.potx,.potm,.pot,.ppsx,.pps,.ppam,.ppa,.mde,.accde,.adp,.accdp,.accdr,.one,.onepkg,.vsd,.vst,.vsdm,.mpt,.mpp,.pub,.pdf,.rar,.zip" name="file[]" id="image" multiple>

 <div class="progress skill-bar ">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <span class="skill">Chargement en cours... <i class="val"></i></span>
                </div>
            </div>
<div class="col-md-3"><button type="submit" class="btn btn-primary has-spinner" id="enregistrement">Enregistrer</button></div>
            </div>

          </div>
         

 
      <!--  <div id="gliser_deposeser"></div>-->
      </form>
      </div>
      <div class="col-md-7">
      
<!-- <table id="listeStructre" class="table table-striped">
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
<tbody id="doc">
</tbody>
</table>-->

      </div>
    </div>
   

   </div>
    </div>



  



  </div>
</div>
</div>

@section('affecter')


 

@endsection

@section('listeUser')
<script>
  $(function () {
   
      //$('#structure_decoupage').DataTable();
      
  })

</script>


<script >
   $(document).ready(function(){ 
  //console.log('Guei111111');
  $("#enregistrement").prop('disabled', true);
  $( "#image" ).change(function() {
   $("#enregistrement").prop('disabled', false);
});
$.ajax({
  url:"{{url('TreeViewStructureAffecter')}}",
  method:"GET",
  dataType:"json",
  success:function(data){
 // $('#treeview').treeview({data:});
  console.log(data);
  var tableau ={data};
  var result = Array.from(Object.keys(data), k=>data[k]);
  console.log(result);
  
 
 $("#treeview").kendoTreeView({
  checkboxes: {
    //checkChildren: true,
     template: "<input type='checkbox' name='id[]' value='#= item.id #' />"
  },
  dataSource:result
});

  }

})

    });

</script>

<script>
$(document).ready(function () {
    
    $('.has-spinner').click(function (e) {
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
          $("#enregistrement").prop('disabled', true);
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
       





    });
});
</script>



@endsection()

@endsection