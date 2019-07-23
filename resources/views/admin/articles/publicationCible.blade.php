
@extends('admin.templates.main')

@section('content')

 <div class="container" id="cont">
 <div class="row">
    <div class="col-md-12">
    <div class="jumbotron">
        <h3 style="text-align:center;">{{ strtoupper($article->titre)}}</h3>

        </div>
    </div>
 </div>
 <div class="row">
    
 {!! Form::model($article, ['method' => 'PATCH','route' => ['publication', $article->id]]) !!}

           <div class="col-md-6">
                <div class="col-md-12">
                

              <table class="table table-dark" style="height: 100px; overflow-y: scroll;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">STRUCTURES</th>
     
    </tr>
  </thead>
  <tbody>

  @if($structures)
  @foreach($structures as $key => $structure)
    <tr>
      <th scope="row">#</th>
      <td> 
      {{ Form::checkbox('structures[]', $structure->id, in_array($structure->id, $articlesStructures) ? true : false, array('class' => 'name', 'style' => 'width:15px')) }}

                {{$structure->nom_structure}}
      </td>
      
    </tr>
    @endforeach
    @endif

    
    
  </tbody>
</table> 

           </div>
           </div>

            <div class="col-md-6" style="position: fixed;">
    <button class="btn btn-primary pull-right" type="submit">Enregistrer</button>
    </div>
    {!! Form::close() !!}

      



          
    
   
</div>

</div>  



@endsection



