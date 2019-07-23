@extends('templates.templateProfil')




@section('content')
   
  <div class="tab-content">




       <div class="col-xs-12">
                        <div class="box">
<div class="row">
	<div class="col-xs-12">
	<?php $nbr=count($mesvideo); $i=0; ?>

          <?php if ($nbr!=0): ?>
            
<table id="example2" class="table table-bordered table-hover">
                            <thead>
                                  <tr>
                                    <th>Titre</th>
                                      <th>Lien</th>
                                      <th>Parcours</th>
                                 
                                      
                                     
                                     
                                  </tr>
                            </thead>

                            <tbody>
                              <?php foreach ($mesvideo as  $value): $i++; ?>
                                <tr>
                                  
                                  <td>{{$value->titre}}</td>
                                  <td class=""> <a href="{{$value->nom_media}}" style="color: black" class="" target="_blank">{{str_limit($value->nom_media,45)}}</a></td>
                                  <td>{{str_limit($value->mention->parcours,45)}}</td>
                                 
                                  
                              
                                </tr>
                              <?php endforeach ?>
                            </tbody>
                        </table>
    {{$mesvideo->links()}}
          <?php else: ?>
            <div class="text-center">
              <h5>Aucune vidéo pour l'instant</h5>
            </div>
            
          <?php endif ?>		


	</div>
</div>
                        	</div>
                      </div>
         </div>

@if(!Auth::user()->prof)

    @include('templates.partials.bloc_droit_profil')
    @endif
@endsection