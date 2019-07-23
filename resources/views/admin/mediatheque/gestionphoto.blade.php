@extends('admin.templates.main')


@section('content')


<div class="nav-tabs-custom container">
      

<div class="panel panel-default">

  <div class="panel-heading"><h4><b>Gestion des photos</b></h4></div>
  <div class="panel-body">
      <div class="tab-content">
      
<div class="box">
	<div class="row">
		<div class="col-xs-8"></div>
		<div class="col-xs-4" align="right">
                      	 			 <a href=""  data-toggle="modal" data-target="#create">Ajouter</a><br>
          </div>
	</div>

          

	<div class="row">

   	<div class="col-xs-12">

<table id="photo" class="table table-bordered table-hover">
                            <thead>
                                  <tr>
                                    <th>Photo</th>
                                      <th>Titre</th>
                                      <th>structure</th>
                                      
                                      <th>Date d'envoi</th>
                                       <th>Action</th>
                                     
                                  </tr>
                            </thead>

                            <tbody >

<?php if (count($photos)!=0): ?>
      <?php 
$i=0;
                              foreach ($photos as  $value): $i++; 
   $datecreate1 = strtotime($value->created_at);
        setlocale(LC_TIME, "fr");
        $datecreate1 = strftime("%A %d %B %Y", $datecreate1);

                                ?>
                                <tr>
                                  <td class="text-center"><img src="{{asset('uploads/mediatheque')}}/{{$value->nom_media}}" style="width: 50px; height: 50px;" /></td>
                                  <td>{{$value->titre}}</td>
                                  <td>{{$value->structure->nom_structure}}</td>
                                  <td width="350px">{{$datecreate1}}</td>
                                  
                                  <td>
                                    
           <a href="{{url('deletePhoto')}}/{{$value->id}}" class="btn btn-danger" onclick="if(! confirm('Voulez vous supprimer la?'))return false;" title="Supprimer"><i class="fa fa-times"></i></a>
                                          

                                  </td>
                                </tr>
                              <?php endforeach ?>
<?php else: ?>
  <tr><td align="center" colspan="10"> Aucune photo </td>
            </tr>
<?php endif ?>


                          
                            </tbody>
                        </table>
    {{$photos->links()}}
   	</div>
   </div>
</div>

</div>
</div>



  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                   
                                            <div class="modal-header">
                                               
                                                <h4 class="modal-title" id="myModalLabel">Ajout de photo </h4>
                                            </div>
                                            <div class="modal-body">
                                          <form method="post" action="{{url('AddMediatheque')}}" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                             <div class="form-group">
                        <label><h5>Struture <font color="red">*</font></h5></label>
                                                  <select name="structure_id" class="form-control " id="structure_id">
                                                    <option>Selectionner un structure</option>
                                                     <?php foreach ($depert as $row ): ?>
                                                  <option value="{{$row->id}}">{{$row->nom_structure}}</option>
                                                    <?php endforeach ?>
                                                  </select>
                                    </div>
                                               

                                              <div class="form-group has-feedback">
                                <input id="" type="text" class="form-control" name="titre" placeholder="titre">
                                
                            </div>
                            <div class="form-group has-feedback">
                                <input id="file" type="file" class="" name="fichier" placeholder="Selectionnne la photo">
                               
                            </div>
                           <input type="hidden" name="type_fichier" value="photo">
                         

                     <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary" name="modifier">Ajouter</button>
                                            </div>
                                         </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

@endsection