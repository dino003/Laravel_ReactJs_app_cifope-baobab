<div class="contact-profile">
    <span class="contact-status busy"></span>

    <img src="{{$ami->photo}}" alt="" />
    <p>{{$ami->userName(50)}}</p>
    
</div>
<div class="messages" id="messeges">
    <ul>
        @if(count($messages))
            <ul>
              @foreach($messages as $value => $message)
            <li class="{{$message->user->id !== $ami->id ? 'sent' : 'replies'}}">
                    <img src="{{$message->user->photo}}" alt="" />
                    <p>{!! nl2br($message->message) !!}</p>
                </li>
                
                @endforeach
               
            </ul>
             @else
      <p style="text-align:center;">Vous n'avez pas encore de message avec @ <a href="#">{{$ami->userName(50)}}</a></p> 
        @endif

    </ul>
</div>
    <div class="message-input">
            <div class="wrap">
                {{csrf_field()}}
            <input type="text" name="message" id="text-box" placeholder="Envoyer un message à puis taper entrer" autofocus/>
             
            <input type="hidden" id="receveur" value="{{$ami->id}}" name="receveur_id">
           <!-- <i class="fa fa-paperclip attachment" aria-hidden="true" id="file-push"></i>
            <button class="submit"><i class="fa fa-paper-plane"></i></button>
            -->
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

        <!-- Bootstrap JavaScript -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

        <script>
      $(function(){
            $('#text-box').on("keypress", function(e){
                if (e.which === 13 && $(this).val() !== '') {
                  
                    var message = $(this).val();
                    var receveur_id = $("#receveur").val();

                    $.ajax({
                        type: 'POST',
                        url:"{{route('insertText')}}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'message': message,
                            'receveur_id': receveur_id
                        },
                        success:function(){
                            $("#text-box").val("");
                $('#messeges').load(location.href + " #messeges>*","");
                $('#messeges').scrollTop($('#messeges')[0].scrollHeight);


                        }
                    });
                }
            });

            setInterval(function(){

               


            },1500);

           

});
              
        </script>
