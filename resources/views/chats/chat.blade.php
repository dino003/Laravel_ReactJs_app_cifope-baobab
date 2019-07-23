@extends('admin.templates.main')


@section('content')
  <style>
      #text-box
      {
        overflow: break-word;
        margin-bottom:10px;
        border: 2px solid black;
        border-radius: 20px;
      }
      .badge-error {
  background-color: #468847;
}

  </style>     
<div class="container">
<div id="frame" >
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="{{Auth::user()->photo}}" class="online" alt="" />
                <p>{{Auth::user()->userName(50)}}</p>


            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" placeholder="Search contacts..." />
        </div>
        <div id="contacts">
            <ul>
                @foreach($users as $employe)

                    <li class="contact">
                        <a href="{{route('conversation', $employe->id)}}" style="text-decoration: none; color: #fff;" id="lien9">

                            <div class="wrap">
                                @if($employe->isOnline())
                                    <span class="contact-status online"></span>

                                @else
                                    <span class="contact-status busy"></span>

                                @endif
                                <img src="{{$employe->photo}}" alt="" />
                                <div class="meta">
                                    <p class="name">
                                        <?php 
                                            $nouveauxMessage = Auth::user()->messageNouLu($employe->id);

                                         ?>
                                        {{$employe->userName()}}
                                        @if($nouveauxMessage > 0)
                                        <strong class="badge badge-error pull-right">{{$nouveauxMessage}}
                                    </strong>
                                    @endif
                                    </p>

                                    <p class="preview">{{$employe->dernierMessage($employe->id)}}</p>
                                    

                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
        <div id="bottom-bar">
            <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Ajouter un contact</span></button>
            <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Paramètres</span></button>
        </div>
    </div>
    <div class="content">
        <div class="contact-profile">
            <span class="contact-status busy"></span>

            <img src="{{$correspondant->photo}}" alt="" />
            <p>{{$correspondant->userName(50)}}</p>
            <div class="social-media">
                <!--
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>

            -->
            </div>
        </div>
        <div class="messages" id="messeges">
            <ul>
                @foreach($messages as $message)
                <li class="{{$message->user->id !== $correspondant->id ? 'sent' : 'replies'}}">
                    <img src="{{$message->user->photo}}" alt="" />
                    <p style="font-size:1em;">{{$message->message}} <br>
                   

                    </p>

                </li>

                @endforeach

            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="message-input">
            <div class="wrap">
                {{csrf_field()}}
                <!--<textarea placeholder="Ecrivez votre message..." cols="80" id="text-box" name="message" autofocus></textarea>-->
                <input type="text" id="text-box" name="message" placeholder="Envoyez un message a # {{$correspondant->userName()}}" autofocus />
                <input type="file" id="imgupload" style="display:none"/>
                <input type="hidden" id="receveur" value="{{$correspondant->id}}" name="receveur_id">
                <input type="file" id="file" value="" name="receveur_id" style="display:none;">


                <i class="fa fa-paperclip attachment" id="OpenImgUpload" aria-hidden="true"></i>

                <!--<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>-->
            </div>
        </div>
    </div>
</div>
</div>
        <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

        <!-- Bootstrap JavaScript -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

        <!-- toastr notifications -->

        <!-- icheck checkboxes -->
        <script>
            $('#OpenImgUpload').click(function(){
                $('#file').trigger('click');
            });

        </script>
        <script >


            $('#text-box').keypress(function(e){
                if (e.keyCode == 13 && $(this).val() !== '') {
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
                $(".messages").animate({ scrollTop: $(document).height() }, "fast");



            },1500);

            $('#lien9').click(function(){
                var ide = $("#receveur").val();

                $.get('/markAsRead/'+ide);
            });


            /*
            $('.submit').click(function() {
                if (('#text-box').val()!== '') {
                    var message = $('#text-box').val();
                    var receveur = $("#receveur").val();

                    // var text = 'qui?';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    })
                    $.ajax({
                        type: 'POST',
                        data: {
                            'text': message,
                            'to': receveur
                        },
                        success:function(){
                            $('#messeges').load(location.href + " #messeges>*","");
                            $("#text-box").val("");


                        }
                    });
                }
            });
            */


        </script>
 @endsection