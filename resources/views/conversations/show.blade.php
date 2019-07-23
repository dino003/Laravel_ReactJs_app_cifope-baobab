@extends('admin.templates.main')

@section('content')
<div class="container">
  
      <div class="row">
      @include('conversations.partials.users', ['users' => $users, 'unread' => $unread])

<div class="col-md-9">
    <div class="card">
        <div class="card-header">{{$user->name}}</div>
        <div class="card-body conver">
        @foreach(array_reverse($messages->items()) as $message)
            <div class="row">
                <div class="col-md-10 {{$message->from_id !== $user->id ? 
                'offset-md-2 text-right' : ''}}">
                    <p>
                        <strong>{{$message->user->name}}</strong><br>
                        {{$message->message}}
                    </p>
                </div>
            </div>
        @endforeach
        <form action="" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <textarea name="message" class="form-control">

                </textarea>
            </div>
            <button class="btn btn-primary" type="submit"> Envoyer</button>
        
        </form>

        </div>
    </div>
</div>
      </div>

</div>

@endsection