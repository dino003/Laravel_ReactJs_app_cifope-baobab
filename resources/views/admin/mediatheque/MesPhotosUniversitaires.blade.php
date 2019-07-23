@extends('templates.templateProfil')

@section('style')

    <link href="{{asset('lightbox/pure-js-lightbox.min.css')}}" rel="stylesheet">
@endsection




@section('content')
<style type="text/css">
      body{
        width: 100%;
        height: 100%;
        background-color: lightgray;
      }
      #gallery img{
        width: 200px;
        height: auto;
        vertical-align: middle;
      }
      #gallery{
        width: 1000000px;
      }
      .gal li {
        list-style: none;
        display: inline-block;
      }
    </style>
@if(!Auth::user()->prof)
    @include('templates.partials.bloc_gauche_profil')
    @endif

      
      <div class="tab-content">
 <div class="box">
 	<?php $i=0; 

$nbr_photo=count($mesphotosunive);

?>
   <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                        	<div class="row">
                        		<div class="col-xs-12">
                        			<?php if ($nbr_photo!=0): ?>
                        				<ul  id="gallery" class="pure-js-lightbox-container gal">
	<?php foreach ($mesphotosunive as $value): $i++;

 $datecreate1 = strtotime($value->created_at);
        setlocale(LC_TIME, "fr");
        $datecreate1 = strftime("%A %d %B %Y", $datecreate1);
	 ?>
		

      <li class=""><h6 class="text-center"><small>{{$value->titre}}</small></h6>
      	<a class="thumbnail" href="{{asset('uploads/mediatheque')}}/{{$value->nom_media}}">
	<img src="{{asset('uploads/mediatheque')}}/{{$value->nom_media}}" style="width: 200px; height: 200px;" /></a>

		<p class="card-text" align=""><small class="text-muted"><i>{{str_limit($value->mention->parcours,35)}}</i></small></p>
	 <p class="card-text text-center" align=""><small class="text-muted"><i>{{$datecreate1}}</i></small></p>
</li>
	
	<?php 
     if ($i==4) {
     	echo "<br>";
     	$i=0;
     }
	 ?>
	<?php endforeach ?>

	  </ul>
                        			<?php else: ?>
                        				
                        				<div class="text-center">
                        					<h1>Aucune photo pour l'instant</h1>
                        				</div>
                        			<?php endif ?>
                        			 

                        		</div>
                        	</div>

 </div>
      </div>
  </div>

    <script src="{{asset('lightbox/pure-js-lightbox.min.js')}}"></script>
    <script type="text/javascript">
      // Make sure include the lightbox library BEFORE you use it
      var test = new pureJSLightBox({
        navigation: true,
        overlay: true,
        swipe: false
      });

  </script>
@if(!Auth::user()->prof)

    @include('templates.partials.bloc_droit_profil')
    @endif
@endsection