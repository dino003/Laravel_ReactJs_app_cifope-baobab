<div class="row">
  <div class="col-md-2"></div>
    <div class="col-md-8">
      <a href="#"><em class="" onclick="$('#ajouterfichier').modal('show');">
<i class="  fa fa-pencil-square-o" title="" ></i> créé des dossiers</em></a>

    
      <table id="document" class="table table-striped">
      <thead>
                 <tr>
                    <th>Nom</th>
                    <th>Date de creation</th>
                      <th>Action</th>
                 </tr>
      </thead>
          <tbody>

 <?php foreach ($dossier as  $value): 
$par1=Crypt::encrypt($value->id);
$par2=Crypt::encrypt($structure->id);
  ?>
                <?php
$nbdocument = \App\Document::where('dossier_id', '=', $value->id)->count();
$nbsousdossier = \App\Dossier::where('dossier_id', '=', $value->id)->count();
$nbfichier=$nbsousdossier + $nbdocument;
                 ?>
                    <tr>
                      <td><?php if (isset($service)): ?>
                          <a href="{{url('SousDossierService')}}/{{$par1}}/structure/{{$par2}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
                {{$value->nom_dossier}}({{$nbfichier}})
              </a>
                      <?php else: ?>
                          <a href="{{url('SousDossier')}}/{{$par1}}/structure/{{$par2}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
                {{$value->nom_dossier}}({{$nbfichier}})
              </a>
                      <?php endif ?>
                 
                      </td>
                      <td>{{$value->created_at}}</td>
                      <td>
      <a href="" class="" data-toggle="modal" data-target="#update{{$value->id}}"><i class="  fa fa-pencil-square-o" title="" ></i></a>
        <a href="{{url('deleteDossier')}}/{{$value->id}}" class="" onclick="if(! confirm('Voulez vous supprimer le dossier?'))return false;" title="Supprimer"><i class="fa fa-trash"></i></a>

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

    </div>
      <div class="col-md-2"></div>
</div>



<div class="modal fade" id="ajouterfichier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter un document </h4>
 </div>                          
                     
                  <div class="modal-body">

                      <!---Ajout de document-->
 <fieldset>
                          <form method="POST" id="insert_form" action="{{url('AddDossier')}}">
                            {{ csrf_field() }}
      <div class="table-responsive">
        <table class="table table-striped" >
                    <thead>
          <tr><th>Crée des dossiers</th>
            <th ><button class="btn btn-success btn-sm add" type="button" name="add"><span class="glyphicon glyphicon-plus"></span></button></th>
          </tr>
        </thead>
           <tbody id="item_table">
                    
                </tbody>
        </table>
          
      </div>
      <input type="hidden" name="structure_id" value="{{$structure->id}}">
       <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary" name="modifier">Ajouter</button>
                                            </div>
    </form>
                              </fieldset>
   


      
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
@endsection()