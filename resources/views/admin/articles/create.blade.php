@extends('admin.templates.main')

@section('content')
    <div class="container">

        <form method="POST" action="{{url('/ajouter_un_article')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-row">
                <div class="form-group">
                    <label for="inputEmail4">Titre</label>
                    <input type="text" class="form-control" name="titre" id="inputEmail4">

                </div>
                <input type="hidden" class="form-control" name="admin_id" value="{{ Auth::guard('admin')->user()->id}}">


            </div>

            <div class="form-group">
                <label for="inputAddress2">Contenu de l'article</label>
                <textarea  class="form-control" id="inputCity" name="contenu"></textarea>
            </div>



            <div class="form-row">
                <div class=" col-md-4 form-group">

                    <label for="inputState">Ajouter un document</label>

                    <i class="fa fa-paperclip"></i>
                    <input type="file" name="document" class="btn btn-default btn-file">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Lien à consulter</label>
                    <input type="text" class="form-control" name="lien">

                </div>
                <div class=" col-md-4 form-group">
                    <label for="inputState">Ajouter une image</label>

                    <i class="fa fa-paperclip"></i>
                    <input type="file" name="image" class="btn btn-default btn-file">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

    </div>
@endsection