@extends('admin.templates.main')

@section('content')
    <?php
        $parama = DB::table('confs')->latest()->first();
    ?>
    <div class="container">



<form method="POST" action="{{url('/parametres')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Nom du Système</label>
            <input type="text" class="form-control" name="nom_app" id="inputEmail4"
                   <?php if(isset($parama->nom_app))
                   {

                   ?>
                   value="{{$parama->nom_app}}"
            <?php
                }
                ?>
            >
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Titre du système</label>
            <input type="text" name="titre_site" class="form-control" id="inputPassword4"
                   <?php if(isset($parama->titre_site))
                   {

                   ?>
                   value="{{$parama->titre_site}}"
            <?php
                }
                ?>
            >
        </div>
    </div>

    <div class="form-group">
        <label for="inputAddress2">Devise</label>
        <input type="text" class="form-control" id="inputAddress2" name="devise"
               <?php if(isset($parama->devise))
               {

               ?>
               value="{{$parama->devise}}"
        <?php
            }
            ?>
        >
    </div>

    <div class="form-group">
        <label for="inputAddress">Mots clés pour le réferencement SEO ( séparer les mots par des virgules)</label>
        <input type="text" class="form-control" name="referencement" placeholder="ex: confiance, courage, expérience..."
               <?php if(isset($parama->referencement))
               {

               ?>
               value="{{$parama->referencement}}"
        <?php
            }
            ?>
        >
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputCity">Presentation de l'établissement</label>
            <textarea  class="form-control" id="inputCity" name="presentation"
                       <?php if(isset($parama->nom_presentation))
                       {

                       ?>
                       value="{{$parama->presentation}}"
            <?php
                }
                ?>
            ></textarea>
        </div>
        <div class="form-group col-md-8">
            <label for="inputState">Message d'acceuil</label>
            <input type="text" class="form-control" name="bienvenu"
                   <?php if(isset($parama->bienvenu))
                   {

                   ?>
                   value="{{$parama->bienvenu}}"
            <?php
                }
                ?>
            >

        </div>

    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
        <div class="row well">
            Un aperçu direct des changements effectués sur la page juste en bas <span><i class="fa fa-hand-o-down"></i></span>
            <div class="loader" style="">

                <form class="pull-right" method="POST" action="{{url('/changeLogo')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="btn btn-default btn-file ">
                        <i class="fa fa-paperclip"></i> Ajouter votre logo
                        <input type="file" name="logo">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" class="btn btn-sm btn-primary" value="Ajouter">
                </form>
            </div>

        </div>
        <div class="timeline-body" id="rech">
            <div class="embed-responsive embed-responsive-16by9" style="">
                <iframe class="embed-responsive-item" src="http://kogni"
                        frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

    </div>
@endsection