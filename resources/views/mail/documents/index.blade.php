@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            KOGNISHARE
        @endcomponent
    @endslot
{{-- Body --}}

    <div class="panel panel-primary">
        <div class="panel-heading"><h2 style="text-align:center; color:red;"> NOUVEAU DOCUMENT</h2></div>

        <div class="panel-heading" style="background:gray;">
        <h4 style="text-align:center; color: white;">ACCUSE DE RECEPTION DE DOCUMENT</h4>
        </div>

        <div class="panel-body">
        <?php
                 $link = url( "telecharger/" . $document->id. "/structure". '/' . $structure->id);
            
            ?>
        <p> NOTIFIE LE : {{$document->created_at->format('d-m-Y')}}</p>
            <p>PROVENANCE : KOGNISHARE</p>
            <p>AJOUTE PAR : {{$document->user->prenom}} {{$document->user->name}}</p>
            <p>TYPE DE DOCUMENT : {{$document->type_document}}</p>
            <p>TAILLE DU DOCUMENT : {{$document->taille}}</p>
            <p>AJOUTE DANS LE SERVICE : {{$structure->nom_structure}}</p>
           
            <p>NOM DU DOCUMENT : <a href="{{$link}}"> <img style="width:100px;" src="{{asset('assets/icone')}}/{{$document->icone}}"> {{$document->nom_document}} </a></p>
        </div>
    </div>
{{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}
        @endcomponent
    @endslot
@endcomponent