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
  <div class="panel-heading"><h4><b>Kognishare / Affectation des utilisateurs</b></h4></div>
  <div class="panel-body">
  	<form action="" id="formulaire" method="post">

     {{ csrf_field() }}
  	<div class="row">
  		<div class="col-md-6">
  			 <table id="listeUser" class="table table-striped">
                                  <thead>
                                   <tr>
                                  <th>Liste des utilisateurs</th>
                                   <th>Role</th>
                                  </tr>
                                    </thead>
             <tbody>

              
                 @foreach ($users as $value)
            <tr>
              <td><input type="checkbox" name="users[]"  value="{{$value->id}}" style="width : 1em ; 
	 height : 1em ; "  >
                                                      {{$value->name}} {{$value->prenom}}</td>
            <td align="right">
              <input type="radio" name="chef"  value="{{$value->id}}" style="width : 1em ; 
   height : 1em ; " >Responsable

    <input type="checkbox" name="ajoutfichier[]"  value="{{$value->id}}" style="width : 1em ; 
   height : 1em ; " >Ajout 
     <input type="checkbox" name="visualisation[]"  value="{{$value->id}}" style="width : 1em ; 
   height : 1em ; " >Visualisation 
                             
            </td>
            </tr>
            @endforeach
         

           </tbody>
        </table>
  		</div>
  
  		<div class="col-md-6">
        <div class="card">
            <h5><b>Veillez choisie la structure *</b> </h5>
  			<div id="treeview"></div>
  				</div>

  		</div>

  		<div class="col-md-4"></div>
  		<div class="col-md-6">
  			<button type="submit" class="btn btn-primary has-spinner1">Enregistrer</button>
  		</div>
  		<div class="col-md-2"></div>








  	</div>
</form>
  </div>
</div>

</div>
 @section('listeUser')
<script>
  $(function () {
   
      $('#listeUser').DataTable();
      $('#listeStructre').DataTable();
  })

</script>

<script >
   $(document).ready(function(){ 
  //console.log('Guei111111');
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
     template: "<input type='checkbox' name='structure[]' value='#= item.id #' />"
  },
  dataSource:result
});

  }

})

    });

</script>

 <script>
$(document).ready(function () {
    
    $('.has-spinner1').click(function (e) {
        var btn = $(this);
        $(btn).buttonLoader('start');
        e.preventDefault();
        var formData = new FormData($(this).parents('form')[0]);
        
        $.ajax({
            url: "{{url('AddAffectationEmploye')}}",
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
              $('#message-info').html(' <div class="alert alert-success alert-dismissable">Affectation effectuer<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

                swal({
           title: "Affectation effectuer",
           text: "",
            icon: "success",
            button: "ok",
              });
               $("#formulaire").trigger("reset");
              // $('#formulaire').reset();
       
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

@endsection()
@endsection