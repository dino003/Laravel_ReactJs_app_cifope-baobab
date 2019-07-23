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




</tr>
	</thead>
	<tbody>
			<?php $j=[]; ?>
		@foreach ($personnel as  $value)
   <?php
 $j[]=$value->id.'P0';
             $vs=$value->id.'P0';
    ?>
			<tr>
				<td><a href="#"><img src="{{$value->user->photo}}" class="avatar" alt="Avatar" width="50px"> </a></td>
                        <td>{{$value->user->userName()}}</td>
                        <td>{{$value->user->email}}</td>

                     
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