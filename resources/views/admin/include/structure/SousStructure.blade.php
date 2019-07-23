 <div class="row">


<div class="col-md-2"></div>
<div class="col-md-8">
   <a href="#"><em class="" onclick="$('#ajouter').modal('show');"> <span>Nouveau</span></em></a>
   <table id="example2" class="table table-striped">
  <thead>
                              <?php
                                    $i=0;
                                    ?>
                                  <tr>
                                      <th>Sous structure</th>
                                     
                                      <th>Action</th>
                                    
                                    
                                     
                                  </tr>
                            </thead>
                            <tbody>
                              <?php if (count($SousStructure)!=0): ?>
                                <?php foreach ($SousStructure as  $value): 
                                   $param=Crypt::encrypt($value->id);
                                   ?>
                                  <tr>
                                  <td><a href="{{url('DetailStructure',$param)}}"><font color="#000">{{$value->nom_structure}}</font></a></td>
                                  
                                 <td>
                                    

                                           
                                                <a href="{{url('DetailStructure')}}/{{$param}}" class="btn btn-info" data-toggle="modal" data-target="">
                                                    <i class="  fa fa-folder-o" title="Voir détails"></i>
                                                </a>
                                <em class="btn btn-warning" onclick="$('#update{{$value->id}}').modal('show');"><i class="  fa fa-pencil-square-o" title="" ></i></em>    
 
                                                <a href="{{url('deleteStructure')}}/{{$value->id}}" class="btn btn-danger" onclick="if(! confirm('Voulez vous supprimer structure?'))return false;" title="Supprimer"><i class="fa fa-trash"></i></a>
                                           
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


                                <?php endforeach ?>
                                 
                              <?php else: ?>
                                                      <tr>
              <td align="center" colspan="10"> Pas de resultat</td>
            </tr>
                              <?php endif ?>
                            </tbody>
 </table>
 {!!$SousStructure->links()!!}
  

  
</div>
<div class="col-md-2"></div>  





 	<div class="modal fade" id="ajouter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Ajouter un structure </h4>
            <div id="response"></div>
 </div>                          
                     
                  <div class="modal-body">
                 
                      <!---Ajout de document-->
  <form method="POST" id="insert_form" action="{{url('AddSousStructure')}}">
                            {{ csrf_field() }}
<input type="text"  name="nom_structure[]" placeholder="Entre le nom de la structure" class="form-control item_name">
  <input type="hidden" name="structure_id[]" value="{{$structure->id}}">


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


 </div>

