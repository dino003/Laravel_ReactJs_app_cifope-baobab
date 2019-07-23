<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="box">



            <div class="box-body">
               
                <form action="{{url('AddLien')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                
                                <input type="text" class="form-control" name="titre_lien" value="" placeholder="Titre du lien">
                            </div>
                        </div>
                        <div class="col-md-3"> <div class="form-group">
                                
                                <input type="text" class="form-control" name="url" placeholder="Https://www.exemple.com">
                            </div>
                        </div>
                       
                        <div class="col-md-3"><div class="form-group">
                                
                                <button type="submit" class="btn btn-primary" name="envoye">Enregistrer</button>
                            </div></div>
                        <div class="col-md-8"> <div class="form-group">

                                <input type="hidden" class="form-control" name="structure_id" value="{{$structure->id}}">

                            </div></div>

                    </div>

                </form>
      
                <?php $i=0; ?>
                <div class="row">


                    <table id="example2" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>lien</th>
                            <th>Auteur</th>
                             <th>Date d'envoi</th>
                            
                            <th>Action</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                       
                        
                        <?php if (count($lien)!=0): ?>
                             <?php foreach ($lien as $lienvalue): $i++; 

                       $datecreate1 = strtotime($lienvalue->created_at);
        setlocale(LC_TIME, "fr");
        $datecreate1 = strftime("%A %d %B %Y", $datecreate1);
                         ?>
                        <tr>
                            <td>{{$lienvalue->titre_lien}}</td>

                            <td> <a href="{{$lienvalue->url}}" class="" title="{{$lienvalue->url}}" target="_blank"><font color="black">{{str_limit($lienvalue->url, 30)}}</font></a> </td>
                            <td>
<p class="card-text"><small class="text-muted"><i>{{$lienvalue->user->name}} {{$lienvalue->user->prenom}}</i></small>
                            </td>
                            <td>
                            <p class="card-text"><small class="text-muted"><i>{{$datecreate1}}</i></small></p></td>
                           
                            <td>
                                   <div class="dropdown show">
                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action <span class="caret"></span>
                                            </a>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                 <a href="" class="btn btn-warning"  title="Modification" data-toggle="modal" data-target="#myModal<?= $i ?>"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="{{url('deleteLien')}}/{{$lienvalue->id}}" class="btn btn-danger" onclick="if(! confirm('Voulez vous supprimer ce lien?'))return false;" title="Supprimer"><i class="fa fa-times"></i></a>
                                              </div>
                                        </div>
                               </td>
                           
                        </tr>




                        <!--Formulaire de modificatio-->
                        <div class="modal fade" id="myModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h4 class="modal-title" id="myModalLabel">Modification de lien </h4>
                                    </div>
                                    <div class="modal-body">

                                        <form action="{{url('UpdateLien')}}" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{$lienvalue->id}}">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control" placeholder="Nom du lien" name="titre_lien" value="{{$lienvalue->titre_lien}}">
                                                <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
                                            </div>

                                            <div class="form-group has-feedback">
                                                <input type="url" class="form-control" placeholder="https://www.exemple.com" name="url" value="{{$lienvalue->url}}">
                                                <span class="glyphicon glyphicon-book form-control-feedback"></span>
                                            </div>



                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Ferme</button>
                                                <button type="submit" class="btn btn-primary" name="modifier">Modifier</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Fin-->

                        <?php endforeach ?>
                        <?php else: ?>
                            <tr><td align="center" colspan="10"> Aucun lien </td>
            </tr>
                        <?php endif ?>
                       
                        </tbody>
                    </table>

 {!!$lien->links()!!}
                </div>




            </div>
        </div>
    </div>
        <div class="col-md-2"></div>
</div>