

@extends('admin.templates.main')

@section('content')

 <div class="container">
 <div class="row">
    <div class="col-md-12">
    <div class="jumbotron">
        <h3 style="text-align:center;">Modifier les accès du groupe</h3>

        </div>
    </div>
 </div>
 <div class="row">
    
       
           <div class="col-md-3">
                <div class="col-md-12">
              <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">PERMISSIONS ASSOCIEES</th>
     
    </tr>
  </thead>
  <tbody>
  @if($rolePermis)
  @foreach($rolePermis as $key => $uRole)
    <tr>
      <th scope="row">#</th>
      <td>{{$uRole->name}}</td>
      
    </tr>
    @endforeach
    @endif
    
  </tbody>
</table> 
           </div>
           </div>

        





          
    
    <div class="col-md-8">
{!! Form::model($role, ['method' => 'PATCH','route' => ['gestion_des_roles.update', $role->id]]) !!}



   
   
    
   
   <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nom du Groupe:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
   

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="checkbox">
            <strong>Permissions Associées:</strong>
            <br/>
            <div class="row">
            <input type="checkbox" onClick="toggle(this)" style="width:15px;"/> Tout sélectionner<hr>
            <div class="col-md-12">

            @foreach($permission as $value)
            <div class="col-md-6">
                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name', 'style' => 'width:15px')) }}
                {{ $value->name }}<hr>
                </div>
            @endforeach
            </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>

{!! Form::close() !!}
    </div>
</div>

</div>  



@endsection