 <div class="row">
 	<div class="col-md-1"></div>
<div class="col-md-9">
	<div id="information">
		
	</div>
	<table id="pernonnel_non_affecter" class="table table-striped">
	<thead>
	<tr>
<th>Photo</th>
<th>Nom</th>
<th>Email</th>
<th>Structure</th>
<th>Action</th>
</tr>
	</thead>
	<tbody>
		<?php $i=[]; ?>
		@foreach ($pernonnel_non_affecter as  $value)
		  <?php $i[]=$value->structure_id.'P'.$value->user_id;
             $v=$value->structure_id.'P'.$value->user_id;

                 $nbrinter = \App\Interviens::where('structure_id',$structure->id)->where('user_id',$value->user_id)->count();
		   ?>
		   <?php if ($nbrinter==0): ?>
			<tr>
				<td><a href="#"><img src="{{$value->photo}}" class="avatar"  width="50px"> </a></td>
                        <td>{{$value->name}} {{$value->prenom}} </td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->nom_structure}}</td>
                          <td>

                          	<!--<a href="" class="btn btn-primary"> <span class="glyphicon glyphicon-book"></span> Envoyé un document</a>-->
                          	<form id="form_affeter{{$v}}" method="POST">
                          		{{ csrf_field() }}
                          		<input type="hidden" name="employe" value="{{$value->user_id}}">
                          		<input type="hidden" name="Structure" value="{{$structure->id}}">
                                
                                 	<button class="btn btn-danger" type="submit" name="submit" ><span class="glyphicon glyphicon-saved"></span> Affecter</button> 	
                                 
                          	
                          	</form>

                          </td>
			</tr>
			<?php endif ?>

			

			
	@endforeach 
	</tbody>
</table>
</div>
<div class="col-md-2"></div>
 </div>

@section('affecter')
<?php foreach ($i as $val): ?>
	<script type="text/javascript">
	$(document).ready(function(){

		$("#form_affeter{{$val}}").submit(function(e){ 
			$('.loading').show();
    e.preventDefault(); 

    var donnees = $(this).serialize(); 
      var val = "{{url('ListePhoto')}}";
    $.ajax({
        url:"{{url('AffeterEmployeAjax')}}",
       method:"POST",
        data : donnees,
      success:function(data){
  
  $('.loading').hide();
  $('#information').html('<div class="alert alert-success alert-dismissable">Employe affecter <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');

//window.location.replace(val);
document.location.reload(true);



//window.location.replace(http://www.monsite.com/); //Redirection similaire à une redirection HTTP
//window.location.href = http://www.monsite.com/; //Redirection similaire à un clic sur un lien
               
  }


    });

});
	});
	



</script>
<?php endforeach ?>
@endsection

@section('pernonnel_non_affecter')
<script>
  $(function () {
   
      $('#pernonnel_non_affecter').DataTable()
  })
</script>


@endsection()