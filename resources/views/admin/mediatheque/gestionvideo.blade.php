@extends('admin.templates.main')

@section('content')


<div class="nav-tabs-custom container">
      <div class="panel panel-default">

  <div class="panel-heading"><h4><b>Gestion des videos</b></h4></div>
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
                                      <th>Titre</th>
                                       <th>Url</th>
                                      <th>Structure</th>
                                      
                                      <th>Date d'envoi</th>
                                       <th>Action</th>
                                     
                                  </tr>
                            </thead>

                            <tbody >

<?php if (count($video)!=0): ?>
      <?php 
$i=0;
                              foreach ($video as  $value): $i++; 
   $datecreate1 = strtotime($value->created_at);
        setlocale(LC_TIME, "fr");
        $datecreate1 = strftime("%A %d %B %Y", $datecreate1);

                                ?>
                                <tr>
                                 
                                  <td>{{$value->titre}}</td>
                                   <td class="text-center"><a href="{{$value->nom_media}}" class="" title="{{$value->nom_media}}" target="_blank"><font color="black">{{str_limit($value->nom_media, 30)}}</font></a></td>
                                  <td>{{$value->structure->nom_structure}}</td>
                                  <td width="350px">{{$datecreate1}}</td>
                                  
                                  <td>
                                    
                                              <a href="" class="btn btn-warning"  title="Modification" data-toggle="modal" data-target="#myModal{{$value->id}}"><i class="fa fa-pencil-square-o"></i></a>    
                                <a href="{{url('deletePhoto')}}/{{$value->id}}" class="btn btn-danger" onclick="if(! confirm('Voulez vous supprimer la?'))return false;" title="Supprimer"><i class="fa fa-times"></i></a>
                                            
                                  </td>
                                </tr>
<div class="modal fade" id="myModal{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                   
                                            <div class="modal-header">
                                               
                                                <h4 class="modal-title" id="myModalLabel">Modifier la video  </h4>
                                            </div>
                                            <div class="modal-body">
                                          <form method="post" action="{{url('UpdateMediatheque')}}" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                             <div class="form-group">
                        <label><h5>Structure <font color="red">*</font></h5></label>
                                                 <select name="structure_id" class="form-control " id="structure_id">
                                                    <option value="{{$value->structure_id}}">{{$value->structure->nom_structure}}</option>
                                                    <?php foreach ($depert as $row ): ?>
                                                  <option value="{{$row->id}}">{{$row->nom_structure}}</option>
                                                    <?php endforeach ?>
                                                  </select>
                                    </div>
                                               
                                              <div class="form-group has-feedback">
                                <input id="" type="text" class="form-control" name="titre" placeholder="titre" value="{{$value->titre}}">
                                
                            </div>
                          <div class="form-group">
                                <label>Entre le liens</label>
                                <input type="text" class="form-control" name="lien" placeholder="Https://www.exemple.com", value="{{$value->nom_media}}">
                            </div>
                        
                           <input type="hidden" name="type_fichier" value="video">
                           <input type="hidden" name="id" value="{{$value->id}}">
                         

                     <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary" name="modifier">Ajouter</button>
                                            </div>
                                         </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                              <?php endforeach ?>
<?php else: ?>
  <tr><td align="center" colspan="10"> Aucune vidéo </td>
            </tr>
<?php endif ?>


                          
                            </tbody>
                        </table>
    {{$video->links()}}
   	</div>
   </div>
</div>

</div>
</div>



  <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                   
                                            <div class="modal-header">
                                               
                                                <h4 class="modal-title" id="myModalLabel">Ajout de vidéo  </h4>
                                            </div>
                                            <div class="modal-body">
                                          <form method="post" action="{{url('AddMediatheque')}}" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                                          <div class="form-group">
                        <label><h5>Structure <font color="red">*</font></h5></label>
                                                 <select name="structure_id" class="form-control " id="structure_id">
                                                    <option >Selectionner structure</option>
                                                    <?php foreach ($depert as $row ): ?>
                                                  <option value="{{$row->id}}">{{$row->nom_structure}}</option>
                                                    <?php endforeach ?>
                                                  </select>
                                    </div>
                                              

                                              <div class="form-group has-feedback">
                                <input id="" type="text" class="form-control" name="titre" placeholder="titre">
                                
                            </div>
                          <div class="form-group">
                                <label>Entrez le lien</label>
                                <input type="text" class="form-control" name="lien" placeholder="Https://www.exemple.com">
                            </div>
                        
                           <input type="hidden" name="type_fichier" value="video">
                         

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