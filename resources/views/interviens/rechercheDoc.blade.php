      <br>

         <?php if (count($document)>0): ?>
           <table  class="table ">
    <thead>
       <tr>
       
<th></th>
<th>Nom</th>
<th>type</th>
<th>Taille</th>
<th>Auteur</th>
<th>Date d'envoi</th>


</tr>
    </thead>
    <tbody>
      <?php foreach ($document as $docvalue): 
$datecreate = strtotime($docvalue->created_at);
$param1=Crypt::encrypt($docvalue->id);
        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
    
     $premierchaine=$tableauchaine[0];
$structure = \App\Structure::find($docvalue->structure_id);
$param=Crypt::encrypt($structure->id);
                      ?>

<tr>
  
  <td>

   <?php if ($docvalue->dossier_id):
$dossier = \App\Dossier::find($docvalue->dossier_id);
$param1=Crypt::encrypt($dossier->id);
$param2=Crypt::encrypt($structure->id);
   ?>
       <a href="{{url('SousDossierService')}}/{{$param1}}/structure/{{$param2}}" style="color:black"><img src="{{asset('assets/icone/icone-dossier.png')}}"  width='20' height='20' >
                {{$dossier->nom_dossier}}
              </a>
    <?php else: ?>
      <a href="{{url('DetailService')}}/{{$param}}"><font color="black">
    {{$structure->nom_structure}} 
  </font>
   </a>
    <?php endif ?>
    
 
  </td>  
  
   
  
  <td>   <a href="{{asset('/uploads/docs')}}/{{$docvalue->nom_document}}" target="_blank">
  <img  src="{{asset('assets/icone')}}/{{$docvalue->icone}}" alt="Card image cap" width='30' height='30'>
     <small class="text-muted" >{{str_limit($premierchaine, 15)}}</small></a>
  </td>
  <td><a href="{{asset('/uploads/docs')}}/{{$docvalue->nom_document}}" target="_blank"><font color="black">  <small class="text-muted" >{{$docvalue->type_document}}</small></font></a></td>
<td>{{$docvalue->taille}}</td>
  <td><small class="text-muted"><i>{{$docvalue->user->name}} {{$docvalue->user->prenom}}</i></small></td>
  <td><small class="text-muted"><i>{{$docvalue->date_ajout}}</i></small></td>
  
</tr>

                      <?php endforeach ?>
    </tbody>
 
</table>
      <?php else: ?>
        <div class="text-center">aucun document ne correspond aux termes de recherche spécifiés "{{$query}}"</div>
      <?php endif ?>
   
     