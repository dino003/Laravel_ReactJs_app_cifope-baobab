 <table id="structureid" class="table table-striped">
  <thead>
    <tr>
      <th>nom </th>
       <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($structure as  $value): 
$param=Crypt::encrypt($value->id);
    ?>
  <tr>
    <td>
      <a href="{{url('DetailStructure',$param)}}"><font color="#000">{{$value->nom_structure}}</font></a>
    </td>
    
    <td>

      @can('Modifier-Structure')
 <a href="#">
  <em class="" onclick="$('#update{{$value->id}}').modal('show');">
  <span> <i class="  fa fa-pencil-square-o" title="" ></i></span></em></a>
@endcan
 @can('Supprimer-Structure')
<a href="{{url('deleteStructure')}}/{{$value->id}}" class="" onclick="if(! confirm('Voulez vous supprimer structure?'))return false;" title="Supprimer"><i class="fa fa-trash"></i>
                                                </a>
@endcan

    </td>
  </tr>
    
    <div class="modal fade" id="update{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
                                   
                      <div class="modal-header">
                                 <h4 class="modal-title" id="myModalLabel">Modification de structure </h4>
                       </div>
                  <div class="modal-body">
        <form method="post" action="{{url('UpdateStructure')}}" enctype="multipart/form-data">
   {{ csrf_field() }}                         
   <input type="hidden" name="id" value="{{$value->id}}">
        <div class="form-group">
                                                <label><h5>Nom de structure <font color="red">*</font></h5></label>
                                                  <input type="text" name="nom_structure"  value="{{$value->nom_structure}}" class="form-control">
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



   <div class="modal fade" id="add_sous{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
                                   
                      <div class="modal-header">
                                 <h4 class="modal-title" id="myModalLabel">Ajout de sous structure a  {{$value->nom_structure}}</h4>
                       </div>
                  <div class="modal-body">
        <form method="post" action="{{url('AddSousStructure')}}" enctype="multipart/form-data">
   {{ csrf_field() }}                         
   <input type="hidden" name="structure_id[]" value="{{$value->id}}">
        <div class="form-group">
                                                <label><h5>Nom sous structure <font color="red">*</font></h5></label>
                                                  <input type="text" name="nom_structure[]"  value="" class="form-control">
                                              </div>
                                              <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary" name="modifier">Enregistrer</button>
                                            </div>
       </form>
                  </div>
      </div>
 </div>


</div>

  <?php endforeach ?>
  </tbody>
</table>

 @section('structureid')
<script>
  $(function () {
   
      $('#structureid').DataTable()
  })
</script>
@endsection()