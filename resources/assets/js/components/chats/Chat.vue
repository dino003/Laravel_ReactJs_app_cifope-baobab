
<template>
   <div id="frame" class="container" style="height: 450px;">
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="" class="online" alt="" />
                <p>Nom du Auth</p>
                        
            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" id="user" placeholder="Chercher un contact..." name="user" />
        </div>
        <div id="contacts">
            <ul v-for="employe in employes" class="" style="list-style:none;" :key="employe.id">
             <li @click="messages(employe.id)" class="contact">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                        <img :src="employe.photo" alt="" />
                        <div class="meta">
                            <p class="name">{{employe.prenom}} {{employe.name}}</p>
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
    <p>{{ami.prenom}} {{ami.name}}</p>
    
</div>
<div class="messages" id="messeges" style="padding-bottom: -90px;" v-chat-scroll="{always: false, smooth: true}">
    <ul v-for="conversation in coversations" v-chat-scroll="{always: false, smooth: true}" :key="conversation.id">
            <li v-if="conversation.emmeteur_id !== ami.id" class="sent">
                    <img src="" alt="" />
                    
                    <p>{{conversation.message}}</p>
                </li>

                 <li v-else class="replies">
                    <img src="" alt="" />
                    
                    <p>{{conversation.message}}</p>
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


</template>
 
<script>
    export default {
       
     data(){
            return {
               msg: 'bonjour boris',
                employes: [],
                coversations: [],
                amiId: '',
                msgFrom: '',
                moi: '',
                ami: '',
                dernierEnvoye: '',
                tyy: 'emmanuel bonjour'
               
            }
        },


ready: function(){
   this.created();
 },



 created(){
   this.commencerConversation();

 },

  methods: {
    messages: function(id){
        axios.get('conversation/' +id)
        .then(response => {
          this.coversations = response.data.messages; 
          this.amiId = id;
          this.ami = response.data.user1;
        })
        .catch(function (error) {
          console.log(error); 
        });  

      },
      /*
      auth()
      {
         axios.get('auth')
        .then(response => {
          this.moi = response.data;
        })
        .catch(function (error) {
          console.log(error); 
        }); 
      },
      */

      dernierMessage(id)
      {
         axios.get('dernier_message/'+id)
        .then(response => {
          this.amiId = id;
          console.log(response.data);

        })
        .catch(function (error) {
          console.log(error); 
        }); 
      },

      commencerConversation()
      {
        axios.get('start_conversationVue')
        .then(response => {
          console.log(response.data); 
          this.employes = response.data; 
        })
        .catch(function (error) {
          console.log(error); 
        });
      },

  inputHandler(e)
  {
      if(e.keyCode === 13 && !e.shiftKey)
      {
        e.preventDefault();
        this.sendMessage();
    
      }
 },


 sendMessage()
 {
    if(this.msgFrom)
    {
       axios.post('chat/' +this.amiId, {
              receveur_id: this.amiID,
              message: this.msgFrom
            })
            .then( (response) => {              
              console.log(response.data); // show if success
              if(response.status===200){
                this.coversations = response.data.messagesp;
                this.ami = response.data.user;
                this.msgFrom = '';
              }

            })
            .catch(function (error) {
              console.log(error); // run if we have error
            });


  }

 }

 


 }


       

    }
</script>