
@extends('admin.templates.main')

@section('content')

 <div class="container">
 <div class="row">
    <div class="col-md-12">
    <div class="jumbotron">
        <h3 style="text-align:center;">Modifier les accès de {{ strtoupper($user->userName(100))}}</h3>

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
      <th scope="col">GROUPES</th>
     
    </tr>
  </thead>
  <tbody>
  @if($userRole)
  @foreach($userRole as $key => $uRole)
    <tr>
      <th scope="row">#</th>
      <td>{{$uRole}}</td>
      
    </tr>
    @endforeach
    @endif
    
  </tbody>
</table> 
           </div>
           </div>

            <div class="col-md-3">
                <div class="col-md-12">
              <table class="table">
  <thead class="black white-text">
    <tr>
      <th scope="col">#</th>
      <th scope="col">PERMISSIONS</th>
     
    </tr>
  </thead>
  <tbody>
  @if($userPermissionAll)
  @foreach($userPermissionAll as $key => $upermi)
    <tr>
      <th scope="row">#</th>
      <td>{{$upermi->name}}</td>
     
    </tr>
    @endforeach
    @endif
    
  </tbody>
</table> 
           </div>
           </div>






          
    
    <div class="col-md-6">
{!! Form::model($user, ['method' => 'PATCH','route' => ['modif.acces', $user->id]]) !!}



   
   
    
   
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>GROUPES:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
           
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="checkbox">
            <strong>Permissions:</strong>
            <br/>
            <div class="row">
            <input type="checkbox" onClick="toggle(this)" style="width:15px;"/> Tout sélectionner<hr>
            <div class="col-md-12">

            @foreach($permission as $value)
            <div class="col-md-6">
                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $userPermission) ? true : false, array('class' => 'name', 'style' => 'width:15px')) }}
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


@section('script')
<script type="text/javascript">
  function toggle(source) {
  checkboxes = document.getElementsByName('permission[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
@endsection