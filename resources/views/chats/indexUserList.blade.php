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
            <input type="text" id="user" placeholder="Chercher un contact..." name="user" />
        </div>
        <div id="contacts">
            <ul class="cars" style="list-style:none;">
              @foreach($employeAChoisirs as $value => $employe)
                <li class="contact" data-id="{{$employe->id}}" id="lien">
                    <div class="wrap">
                      @if($employe->isOnline())
                          <span class="contact-status online"></span>

                           @else
                            <span class="contact-status busy"></span>

                          @endif                      

                            <img src="{{$employe->avatar()}}" alt="" />
                        <div class="meta">
                           <p class="name">
                              @php 
                                  $nouveauxMessage = Auth::user()->messageNouLu($employe->id)

                              @endphp
                                        {{$employe->userName(40)}}
                                        @if($nouveauxMessage > 0)
                                        <strong id="gt" class="badge badge-error pull-right">{{$nouveauxMessage}}
                                    </strong>
                                    @endif                              
                            </p>
                            <p class="preview">{{Auth::user()->dernierMessage($employe->id)}}</p>
                            
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

    <div class="content" id="chatA"></div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

        <!-- Bootstrap JavaScript -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

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

            $(document).on('keyup','#user',function(){

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

    $('li').click(function(){
      var ide = $(this).data('id');
      var url = 'chat_conversationAjax/'+ide;
      $('#chatA').load(url);
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
            /*
            setInterval(function(){

                $('#chatA').load(location.href + " #chatA>*","");
                $('#messeges').scrollTop($('#messeges')[0].scrollHeight);


            },1500);
            */

});
              
        </script>
@endsection