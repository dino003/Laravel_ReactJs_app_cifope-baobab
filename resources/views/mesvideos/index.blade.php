@extends('admin.templates.main')


@section('content')
<div class="nav-tabs-custom container">

<div class="panel panel-default">
  <div class="panel-heading">
  	<div class="row">
  		<div class="col-md-10"><h4><b><a href="#" style="color:black"><i class="fa fa-tv"></i>
               Mes videos
              </a></b></h4></div>
  		<div class="col-md-2">
<b><a href="#">
<em class="" onclick="$('#ajouter_video').modal('show');"><i class="  fa fa-pencil-square-o" title="" ></i>  Ajouter un lien
</em>
</a></b>
            </div>
  	</div>
  		

  	</div>


  <div class="panel-body">

  	 <table id="structureid" class="table table-striped">
 	 <thead>
          <tr>
          <th>Titre </th>
           <th>Url</th>
           <th>Date de création</th>
           <th>Action</th>
          </tr>
       </thead>
          <tbody>
          	<?php foreach ($video as $value): ?>
          		<tr>
          			<td>{{$value->titre_lien}}</td>
          			<td><a href="{{$value->url}}" class="" title="{{$value->url}}" target="_blank"><font color="black">{{str_limit($value->url, 30)}}</font></a></td>
          			<td>{{$value->created_at}}</td>
          			<td>
<a href="#" title="Modification">
<em class="" onclick="$('#myModal{{$value->id}}').modal('show');"> <font color="black"><i class="fa fa-pencil-square-o"></i></font>
</em>
</a>
<a href="{{url('Deletevideopersonnel')}}/{{$value->id}}" class="" onclick="if(! confirm('Voulez vous supprimer ce lien?'))return false;" title="Supprimer"> <font color="black"><i class="fa fa-times"></i></font></a></td>
          		</tr>









          		<!--Formulaire de modificatio-->
                        <div class="modal fade" id="myModal{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h4 class="modal-title" id="myModalLabel">Modification de lien video </h4>
                                    </div>
                                    <div class="modal-body">

                       <form action="{{url('UpdateMesVideos')}}" method="post">
                                            {{ csrf_field() }}
                             <input type="hidden" name="id" value="{{$value->id}}">
                          <div class="form-group has-feedback">
                              <input type="text" class="form-control" placeholder="Nom du lien" name="titre_lien" value="{{$value->titre_lien}}">
                                        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
                           </div>

                            <div class="form-group has-feedback">
                           <input type="url" class="form-control" placeholder="https://www.exemple.com" name="url" value="{{$value->url}}">
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
          	<?php endforeach ?>

           </tbody>
    </table>
  	</div>
  </div>
</div>






<div class="modal fade" id="ajouter_video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

 <div class="modal-dialog">
       <div class="modal-content">
                                   
                      <div class="modal-header">
                                 <h4 class="modal-title" id="myModalLabel">Ajouter lien video </h4>
                       </div>
                  <div class="modal-body">
        <form method="post" action="{{url('AddMesvideo')}}" enctype="multipart/form-data">
   {{ csrf_field() }}                         
  
        <div class="form-group">
           <label><h5>Titre  <font color="red">*</font></h5></label>
             <input type="text" name="titre_lien"  value="" class="form-control">
        </div>
        <div class="form-group">
           <label><h5>Url  <font color="red">*</font></h5></label>
             <input type="text" name="url"  value="" class="form-control" placeholder="http://www.url.com">
        </div>


                                              <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>     
                                                <button type="submit" class="btn btn-primary" name="modifier">Ajouter</button>
                                            </div>
       </form>
                  </div>
      </div>
 </div>


</div>

  @section('structureid')
<script>
  $(function () {
   
      $('#structureid').DataTable()
  })
</script>
@endsection()
@endsection