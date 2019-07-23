@extends('admin.templates.main')


@section('content')
   <div class="container" id="articles">
   <form action="{{url('les_articles')}}" method="POST" enctype="multipart/form-data">
   {{csrf_field()}}
        <div class="ui form container">
             
  <div class="field">
        <input type="text" name="titre" placeholder="Entrer le titre ici" autofocus required>
       

  </div>
  <div class="field">
             <textarea placeholder="Entrer le contenu ici"   name="contenu" required></textarea>
            
        </div>
         <div class="fields">
    <div class="field">
      <label>Lien pour une vidéo</label>
      <input type="text" placeholder="ex: http:// www.exemple.com" name="lien">
    </div>
     <div class="field">
      <label>Ajouter une image</label>
      <input type="file" name="image">
    </div>

    <div class="field">
      <label>Ajouter un fichier</label>
      <input type="file" name="fichier">
    </div>

   
    <div class="field">
      <label>Donnez un nom au fichier</label>
      <input type="text" name="nomFichier">
    </div>
        <input type="submit"  class="ui button"  tabindex="0" value="Enregistrer">

  </div>
</div>
</form>
   <vue-toastr ref="toastr"></vue-toastr>

       <articl></articl>
   </div>
@endsection