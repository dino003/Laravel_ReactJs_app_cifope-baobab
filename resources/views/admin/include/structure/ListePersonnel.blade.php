 <div class="row">

 	<div class="col-md-2"></div>
<div class="col-md-8" id="tets">
		<div id="information2"></div>
	<table id="listePeronnel" class="table table-striped">
	<thead>
	<tr>
<th>Photo</th>
<th>Nom</th>
<th>Email</th>
<th>Responsable</th>
<th>Ajouter</th>
<th>Visualiser</th>
<?php if (Auth::user()->super_admin==1): ?>
  <th>Retire du service</th>
<?php endif ?>


</tr>
	</thead>
	<tbody>
			<?php $j=[]; ?>
		@foreach ($personnel as  $value)
   <?php
 $j[]=$value->id.'P0';
             $vs=$value->id.'P0';

               $param1=Crypt::encrypt($value->id);
              $param0=Crypt::encrypt(0);
              $param2=Crypt::encrypt(1);
              //$val=$value->chef;
              $responsable[]=$value->chef;
    ?>
			<tr>
				<td><a href="#"><img src="{{$value->user->photo}}" class="avatar" alt="Avatar" width="50px"> </a></td>
                        <td>{{$value->user->userName()}}</td>
                        <td>{{$value->user->email}}</td>
                         <td>
                          
                           
                    <?php if ($value->chef==1): ?>
              <a class="btn btn-success" href="{{url('responsable')}}/{{$param0}}/us/{{$param1}}" onclick="if(! confirm('Voulez vous activé?'))return false;">Activé</a>
                             
                           <?php endif ?>

                           <?php if ($value->chef==0): ?>
                    <a class="btn btn-danger" href="{{url('responsable')}}/{{$param2}}/us/{{$param1}}" onclick="if(! confirm('Voulez vous activé?'))return false;">Desactivé</a>
                           <?php endif ?>


                         </td>
                          <td>
                            <?php if ($value->ajout==1): ?>
            <a class="btn btn-success" href="{{url('ajout')}}/{{$param0}}/us/{{$param1}}" onclick="if(! confirm('Voulez vous le  désactive?'))return false;">Activé</a>
                            <?php else: ?>
          <a class="btn btn-danger" href="{{url('ajout')}}/{{$param2}}/us/{{$param1}}" onclick="if(! confirm('Voulez vous activé?'))return false;">Desactivé</a>
                            <?php endif ?>
                          </td>
                           <td>
                              <?php if ($value->visualise==1): ?>
                              
                           <a class="btn btn-success" href="{{url('visualise')}}/{{$param0}}/us/{{$param1}}" onclick="if(! confirm('Voulez vous le  désactive la visualisation?'))return false;">Activé</a>
                            <?php else: ?>
                              <a class="btn btn-danger" href="{{url('visualise')}}/{{$param2}}/us/{{$param1}}" onclick="if(! confirm('Voulez vous activé la visualisationu?'))return false;">Desactivé</a>
                              
                            <?php endif ?>
                           </td>
                        <?php if (Auth::user()->super_admin==1): ?>
                          <td><!--<a href="" class="btn btn-primary"> <span class="glyphicon glyphicon-book"></span> Envoyé un document</a>-->
                          	<form id="form_affeter{{$vs}}" method="POST" class="format">
                          		{{ csrf_field() }}
                          <input type="hidden" name="inetrviens" value="{{$value->id}}">
                          	<button class="btn btn-danger" type="submit" name="submit" ><span class="glyphicon glyphicon-remove-sign"></span> Retirer</button> 	
                                 
                          	
                          	</form>
                          </td>
                          <?php endif ?>
			</tr>

	@endforeach 
	</tbody>
</table>
</div>
<div class="col-md-2"></div>
 </div>
 @section('retirer')


	<?php foreach ($j as  $val0): ?>
		<script type="text/javascript">
	$(document).ready(function(){

		$("#form_affeter{{$val0}}").submit(function(e){ 
			$('.loading').show();
    e.preventDefault(); 

    var donnees = $(this).serialize(); 
    
    $.ajax({
        url:"{{url('RetireEmployeAjax')}}",
       method:"POST",
        data : donnees,
      success:function(data){
  
  $('.loading').hide();
  $('#information2').html('<div class="alert alert-success alert-dismissable">Employe retiré <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

document.location.reload(true);

	event.preventDefault();


               
  }


    });

});
	});
	



</script>
	<?php endforeach ?>

@endsection



@section('listePeronnel')
<script>
  $(function () {
   
      $('#listePeronnel').DataTable()
  })
</script>
@endsection()