
<table id="document" class="table table-striped">
	<tr>
<th>Nom</th>
<th>Auteur</th>
<th>Date d'envoi</th>
<th>Action</th>
</tr>

  <tbody >
   <?php if (count($document)!=0): ?>
      <?php foreach ($document as $docvalue): 
$datecreate = strtotime($docvalue->created_at);

        setlocale(LC_TIME, "fr");
        $datecreate = strftime("%A %d %B %Y", $datecreate);
 $tableauchaine = explode('_!', $docvalue->nom_document);
    
     $premierchaine=$tableauchaine[0];
                      ?>

<tr>
  <td>   <a href="{{asset('uploads/docs')}}/{{$docvalue->nom_document}}" target="_blank">
  <img  src="{{asset('assets/icone')}}/{{$docvalue->icone}}" alt="Card image cap" width='30' height='30'>
     <small class="text-muted" >{{str_limit($premierchaine, 15)}}</small>
  </td>
  <td><small class="text-muted"><i>{{$docvalue->user->name}} {{$docvalue->user->prenom}}</i></small></td>
  <td><small class="text-muted"><i>{{$datecreate}}</i></small></td>
  <td><a href="{{url('deleteDocument')}}/{{$docvalue->id}}" onclick="if(! confirm('Voulez vous supprimer le document?'))return false;" title="Supprimer"><font color="#000"><i class="fa fa-trash"></i></font></a></td>
</tr>

                      <?php endforeach ?>



    <?php else: ?>
              <tr>
              <td align="center" colspan="10"> Pas de resultat</td>
            </tr>
    <?php endif ?>
    </tbody>
</table>