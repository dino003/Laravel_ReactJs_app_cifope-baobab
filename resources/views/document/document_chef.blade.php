   <div class="row">
     <div class="col-md-2"></div>
      <div class="col-md-8">
        <table id="document_chef01" class="table table-striped">
    <thead>
       <tr>
<th>Nom</th>
<th>type</th>
<th>Taille</th>
<th>Auteur</th>
<th>Date d'envoi</th>


</tr>
    </thead>
    <tbody>
      <?php foreach ($document_chef as $docvalue): 
$datecreate = strtotime($docvalue->created_at);
$param1=Crypt::encrypt($docvalue->id);
        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
    
     $premierchaine=$tableauchaine[0];
 $param=Crypt::encrypt($docvalue->id);
 $param10=Crypt::encrypt($docvalue->structure_id);
                      ?>

<tr>
  <td>   <a href="{{url('telecharger')}}/{{$param}}/structure/{{$param10}}" target="_blank">
  <img  src="{{asset('assets/icone')}}/{{$docvalue->icone}}" alt="Card image cap" width='30' height='30'>
     <small class="text-muted" >{{str_limit($premierchaine, 15)}}</small></a>
  </td>
  <td><a href="{{url('telecharger')}}/{{$param}}/structure/{{$param10}}" target="_blank"><font color="black">  <small class="text-muted" >{{$docvalue->type_document}}</small></font></a></td>
<td>{{$docvalue->taille}}</td>
  <td><small class="text-muted"><i>{{$docvalue->user->name}} {{$docvalue->user->prenom}}</i></small></td>
  <td><small class="text-muted"><i>{{$docvalue->created_at}}</i></small></td>
  
</tr>

                      <?php endforeach ?>
    </tbody>
 
</table>



      </div>
        <div class="col-md-2"></div>
   </div>

    