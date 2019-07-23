@extends('admin.templates.main')


@section('content')
<div class="nav-tabs-custom container">
 <div class="panel panel-default">
  <div class="panel-heading">
<div class="row">
  <div class="col-md-6"> <h4><b>Structure de découpage de l'entreprise</b></h4></div>
  <div class="col-md-3" align="right">
     @can('Ajouter-Structure')
    <a href="#"><em class="" onclick="$('#ajouter').modal('show');"> <span>Ajouter structure parent</span></em></a>
    @endcan
  </div>
  <div class="col-md-3" align="center">
   @can('Ajouter-Structure')
    <a href="#"><em class="" onclick="$('#ajouter1').modal('show');"> <span>Ajouter structure enfant</span></em></a>
     @endcan
  </div>
</div>
   

  </div>
  <div class="panel-body">
<div class="row">
  <div class="col-md-6">
    <div id="treeview"></div>

  </div>
  <div class="col-md-5">
    @include('admin.structure.listestructure')
  </div>
  </div>
 </div>
</div>


<div class="modal fade" id="ajouter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter un structure </h4>
            <div id="response"></div>
 </div>                          
                     
                  <div class="modal-body">
                 
                      <!---Ajout de document-->
 <form method="POST" id="insert_form" action="{{url('AddStructure')}}">
                                {{ csrf_field() }}
<input type="text"  name="nom_structure[]" placeholder="Entre le nom de la structure" class="form-control item_name">
    


<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary" name="modifier">Ajouter</button>
                                            </div>
<!--Fin Ajout--->

      </form>
                  </div>
      </div>
 </div>


</div>

<div class="modal fade" id="ajouter1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter structure enfant</h4>
            <div id="response"></div>
 </div>                          
                     
                  <div class="modal-body">
                 
                      <!---Ajout de document-->
 <form method="POST" id="insert_form" action="{{url('AddSousStructure')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                        <input type="text"  name="nom_structure[]" placeholder="Entre le nom de la structure" class="form-control item_name">
                                </div>

    <div class="form-group">
       <select class="form-control" name="structure_id[]">
      <option value="">Selectioner la structure
      </option>@foreach($structure as $row) 
      <option value="{{$row->id}}">{{$row->nom_structure}}

      </option> @endforeach
    </select>
    </div>
   


<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary" name="modifier">Ajouter</button>
                                            </div>
<!--Fin Ajout--->

      </form>
                  </div>
      </div>
 </div>


</div>

@section('script')
<script type="text/javascript">
     $(document).ready(function(){
         $(document).on('click','.add',function(){
            var html =' ';
              var info=" ";
            html +='<tr><hr>';
            html +='<td><input type="text"  name="nom_structure[]" placeholder="Entre le nom de la structure" class="form-control item_name"></td>';
            html +='<td><button class="btn btn-danger btn-sm remove" type="button" name="add"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
            $('#item_table').append(html);
         });

         $(document).on('click','.remove',function(){
            $(this).closest('tr').remove();
         });



         $(document).on('click','.add1',function(){
            var html =' ';
              var info=" ";
            html +='<tr><hr>';
            html +='<td><input type="text"  name="nom_structure[]" placeholder="Sous structure" class="form-control item_name"></td>';
            html +='<td><select class="form-control" name="structure_id[]"><option value="">Selectioner la structure</option>@foreach($structure as $row) <option value="{{$row->id}}">{{$row->nom_structure}}</option> @endforeach</select></td>'
            html +='<td><button class="btn btn-danger btn-sm remove1" type="button" name="add1"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
            $('#item_table1').append(html);
         });

         $(document).on('click','.remove1',function(){
            $(this).closest('tr').remove();
         });

     




     });
</script>

<script >
   $(document).ready(function(){ 
  //console.log('Guei111111');
$.ajax({
  url:"{{url('TreeViewStructure')}}",
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

    });

</script>
    

@endsection

@endsection