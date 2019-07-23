@extends('admin.templates.main')
@section('content')

<div id="frame" class="container">
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="{{Auth::user()->photo}}" class="online" alt="" />
                <p>{{Auth::user()->userName(40)}}</p>
                
               
            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" id="quest" name="quest" placeholder="Chercher un contact..." />
        </div>
        <div id="contacts">
            <ul id="premiers-contacts" style="list-style:none;">
              @foreach($employes as $employe)
                <li class="contact ">
                    <div class="wrap">
                      @if($employe->isOnline())
                          <span class="contact-status online"></span>

                           @else
                            <span class="contact-status busy"></span>

                          @endif
                                <img src="{{$employe->photo}}" alt="" />
                        <div class="meta">
                           <a href="{{url('/chat_conversation', $employe->id)}}" style="text-decoration: none; color: #fff;">
                            <p class="name">
                              <?php 
                                  $nouveauxMessage = Auth::user()->messageNouLu($employe->id);

                                         ?>
                                        {{$employe->userName(40)}}
                                        @if($nouveauxMessage > 0)
                                        <strong id="gt" class="badge badge-error pull-right">{{$nouveauxMessage}}
                                    </strong>
                                    @endif                              
                            </p>
                            <p class="preview">{{Auth::user()->dernierMessage($employe->id)}}</p>
                                </a>

                        </div>
                    </div>
                </li>
                @endforeach
                
            </ul>
        </div>
          <div id="conto"></div>

        <div id="bottom-bar">
            <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Ajouter contact</span></button>
            <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Paramètres</span></button>
        </div>
    </div>

    <div class="content">
        <div class="contact-profile">
            <img src="{{$ami->photo}}" alt="" />
            <p>{{$ami->userName(50)}}</p>
            <div class="social-media">
                
            </div>
        </div>
        <div class="messages" id="messeges">
        @if(count($messages))
            <ul>
              @foreach($messages as $message)
            <li class="{{$message->user->id !== $ami->id ? 'sent' : 'replies'}}">
                    <img src="{{$message->user->photo}}" alt="" />
                    <p>{!! nl2br($message->message) !!}</p>
                </li>
                
                @endforeach
               
            </ul>
             @else
      <p style="text-align:center;">Vous n'avez pas encore de message avec @ <a href="#">{{$ami->userName(50)}}</a></p> 
        @endif
        </div>
       
        <div class="message-input">
            <div class="wrap">
                {{csrf_field()}}
            <input type="text" name="message" id="text-box" placeholder="Envoyer un message à {{$ami->userName(50)}} puis taper entrer" autofocus/>
             
                <input type="file" id="imgupload" style="display:none"/>
                <input type="hidden" id="receveur" value="{{$ami->id}}" name="receveur_id">
           <!-- <i class="fa fa-paperclip attachment" aria-hidden="true" id="file-push"></i>
            <button class="submit"><i class="fa fa-paper-plane"></i></button>
            -->
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('script')       
<script type="text/javascript">
        $(document).ready(function(){
            chercher();
            function chercher(query){

                $.ajax({
                    url:"{{route('cherch')}}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data){
                        $('#conto').html(data.table_data);
                    }
                })

            }

            $(document).on('keyup','#quest',function(){

                if($(this).val() != "")
                {
                    var query=$(this).val();
                    $('#contacts').hide();

                    $('#conto').show();

                    chercher(query);
                }
                else
                {
                    $('#conto').hide();
                    $('#contacts').show();
                }
            });

        });
    </script>

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



                        }
                    });
                }
            });

            setInterval(function(){

                $('#messeges').load(location.href + " #messeges>*","");
                $('.messages').scrollTop($('.messages')[0].scrollHeight);


            },1500);

});
              
        </script>
        @endsection
