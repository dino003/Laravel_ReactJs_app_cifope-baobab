@extends('admin.templates.main')

@section('content')
<div class="container">
<!--<h1 style="text-align: center;">Articles récents</h1> -->
   <div class="well" id="show">
      <div class="media">
      @if($article->image) 
  		<a class="pull-left" href="#">
    		<img class="media-object" src="{{$article->image}}">
          </a>
          @endif
  		<div class="media-body"  style="overflow-wrap: break-word;">
    		<h5 class="media-heading"> 
            {{$article->titre}}
            </h5>
          <p class="text-right" id="cont"></p>
          <p>{!! $article->contenu !!}</p>
          @if($article->fichier)
          <p > Documents Joints</p>
          <p> 
              <a href="{{$article->fichier}}" target="_blank"><span><i class="fa fa-file fa-2x"></i></span> {{$article->nomFichier}}</a>
            </p>
            @endif
       

            
           
       </div>
    </div>

              


  </div>


      <!-- les commentaires -->

        <div class="row well container">
                    <h2>Les commentaires</h2>
        

                    <div class="form-group">
                      {{csrf_field()}}
                        <input type="hidden" name="article_id" value="{{$article->id}}" id="article_id">
                         <textarea id="comment" class="form-control input-lg" autofocus="" placeholder="Ecrivez votre commentaire puis tapez entrer" name="commentaire"></textarea>
                      
                      
                    </div>


                     
                      

                    <div class="post" style="background:#fff;" id="messeges" 
                    style="height: 10px; overflow-y:scroll;">
                            @foreach($commentaires as $comm)

                            <div class="user-block" style="background:#fff;">
                                <img class="img-circle img-bordered-sm" src="{{Auth::user()->photo}}" alt="user image" style="width: 50px;">
                                <span class="username">
                                    <a href="#">{{$article->user->userName(70)}}</a>
                                    </span>
                                <span class="description pull-right">A laissé ce commentaire - {{$comm->created_at->diffForHumans()}}</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                {!! nl2br($comm->commentaire) !!}
                            </p> <hr><hr>


                             @endforeach

                        </div>
                        
                           

                      

            </div>



      <!-- / les commentaires -->

        



                      </div>


                    


@endsection

@section('script')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<!-- Bootstrap JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

<!-- toastr notifications -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- icheck checkboxes -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

  <script type="text/javascript">
    $(function(){

     // alert('kkkkk')  

       $('textarea').keypress(function(e){
                    if (e.keyCode == 13) {
                        var commentaire = $(this).val();
                        var article_id = $("#article_id").val();
                        // var text = 'qui?';
                       
                        $.ajax({
                            type: 'POST',
                            url:"{{route('insert')}}",
                            data: {
                                'commentaire': commentaire,
                                'article_id': article_id,
                                '_token': $('input[name=_token]').val(),

                            },
                            success:function(){
                                $('#messeges').load(location.href + " #messeges>*","");
                                toastr.success('Votre commentaire a été ajouté!', {timeOut: 5000});

                                $("#comment").val("");


                            }
                        });
                    }
                });
    })
   
  </script>

@endsection