<?php if ($role->ajout==1): ?>
  <a href="#">
<em class="" onclick="$('#sous_dossier').modal('show');"><i class="  fa fa-pencil-square-o" title="" ></i>Ajouter un dossier   
</em>
</a>
<?php endif ?>


<?php if ($role->visualise==1): ?>
<table id="dossier" class="table table-striped">
      <thead>
          <tr>
            <th>
            Nom dossier
          </th>
          <th>
            Date de creation
          </th>
        <th>
            Action
          </th>
        </tr>      
      </thead>
          <tbody>
            <?php foreach ($sousdossier as  $value): 
$param1=Crypt::encrypt($value->id);
$param2=Crypt::encrypt($structure->id);

$nbdocument = \App\Documentservice::where('dossier_id', '=', $value->id)->count();
$nbsousdossier = \App\Dossier::where('dossier_id', '=', $value->id)->count();
$nbfichier=$nbsousdossier + $nbdocument;
              ?>
              <tr>
                  <td>
                    <?php if (isset($service)): ?>
                      <a href="{{url('SousDossierService')}}/{{$param1}}/structure/{{$param2}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
                {{$value->nom_dossier}}({{$nbfichier}})
              </a>
                    <?php else: ?>
                      <a href="{{url('SousDossier')}}/{{$param1}}/structure/{{$param2}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
                {{$value->nom_dossier}}({{$nbfichier}})
              </a>
                    <?php endif ?>
                   
                      </td>
                      <td><h6><small>{{$value->created_at}}</small></h6></td>
                <td>
                     <a href="" class="" data-toggle="modal" data-target="#update{{$value->id}}">
        <font color="#000"><i class="  fa fa-pencil-square-o" title="" ></i></font></a>
        <a href="{{url('deleteDossier')}}/{{$value->id}}" class="" onclick="if(! confirm('Voulez vous supprimer le dossier?'))return false;" title="Supprimer"><font color="#000"><i class="fa fa-trash"></i></font></a>
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
<?php endif ?>

		  @section('dossier')
<script>
  $(function () {
   
      $('#dossier').DataTable()
  })
</script>
     @endsection

