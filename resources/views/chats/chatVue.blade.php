@extends('admin.templates.main')

@section('content')

<div id="frame" class="container" style="height: 450px;">
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="{{Auth::user()->photo}}" class="online" alt="" />
                <p>{{Auth::user()->userName(40)}}</p>
                        
            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" id="user" placeholder="Chercher un contact..." v-model="search" />
        </div>
        <div id="contacts">
            <ul  class="" style="list-style:none;">
             <li v-for="employe in userFiltres" @click="messages(employe.id)" :key="employe.id" class="contact">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                        <img :src="employe.photo" alt="" />
                        <div class="meta">
                            <p class="name">@{{employe.prenom}} @{{employe.name}}</p>
                            <p class="preview"></p>
                        </div>
                    </div>
                </li>
                
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
    <span class="contact-status busy"></span>

    <img :src="ami.photo" alt="" />
    <p>@{{ami.prenom}} @{{ami.name}}</p>
    
</div>
<div class="messages" id="messeges" style="padding-bottom: -90px;" v-chat-scroll="{always: false, smooth: true}">
    <ul v-for="conversation in coversations" v-chat-scroll="{always: false, smooth: true}">
            <li :class="conversation.emmeteur_id === <?php echo Auth::user()->id; ?> ? 'sent' : 'replies'">
                    <img :src="conversation.emmeteur_id === <?php echo Auth::user()->id; ?> ? '' : 'ami.photo'" alt="" />
                    
                    <p>@{{conversation.message}}</p>
                </li>

               
    </ul>
    <br><br>    <br>    <br>



</div>
    <div class="message-input">
            <div class="wrap" style="padding: 50px; width: 1500px;">
                <input type="hidden" v-model="amiId">
            <input v-model="msgFrom" @keydown.13="inputHandler" type="text" placeholder="Envoyer un message à puis taper entrer" autofocus style="border: 1px solid transparent; border-radius:60px;" />
             
           <!-- <i class="fa fa-paperclip attachment" aria-hidden="true" id="file-push"></i>
            <button class="submit"><i class="fa fa-paper-plane"></i></button>
            -->
            </div>
        </div>
        <br>
    </div>
</div>


@endsection