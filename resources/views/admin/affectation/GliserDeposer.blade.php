

      <?php foreach ($document as $docvalue): 
$datecreate = strtotime($docvalue->created_at);
$param1=Crypt::encrypt($docvalue->id);
        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
    
     $premierchaine=$tableauchaine[0];

                      ?>

<tr>
  <td>   <a href="{{asset('/uploads/docs')}}/{{$docvalue->nom_document}}" target="_blank">
  <img  src="{{asset('assets/icone')}}/{{$docvalue->icone}}" alt="Card image cap" width='30' height='30'>
     <small class="text-muted" >{{str_limit($premierchaine, 15)}}</small></a>
  </td>
  <td><a href="{{asset('/uploads/docs')}}/{{$docvalue->nom_document}}" target="_blank"><font color="black">  <small class="text-muted" >{{$docvalue->type_document}}</small></font></a></td>
<td>{{$docvalue->taille}}</td>
  <td><small class="text-muted"><i>{{$docvalue->user->name}} {{$docvalue->user->prenom}}</i></small></td>
  <td><small class="text-muted"><i>{{$docvalue->created_at}}</i></small></td>
  <td>
  <?php if (Auth::user()->id==$docvalue->user_id): ?>
    <a href="{{url('deleteDocumentServie')}}/{{$param1}}" onclick="if(! confirm('Voulez vous supprimer le document?'))return false;" title="Supprimer"><font color="#000"><i class="fa fa-trash"></i></font></a>
  <?php endif ?>
    

  </td>
</tr>

                      <?php endforeach ?>
  
 