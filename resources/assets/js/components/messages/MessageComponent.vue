

<template>
    <div >
            <div class="contact-profile">
                <span class="contact-status busy"></span>

                <img :src="photo" alt="" />
                <p>{{prenom}} {{name}}</p>
                
            </div>
                <div class="messages" id="contentTa" style="padding-bottom: -90px;">
        <ul>
           <div class="ui active dimmer" v-if="loading">

                        <div class="ui loader"></div>
                        </div>
            <Message :message="message" :user="user" v-for="message in messages" :key="message.id"></Message>
            <hr>

               
        </ul>
    <br><br>    <br>    <br>



</div>

       
           

        <!--hsh -->
            <div class="message-input">
            <div class="wrap" style="padding: 50px; width: 1500px;">
            <input v-model="message" @keypress.enter="sendMessage" type="text" placeholder="Envoyer un message à puis taper entrer" autofocus 
            style="border: 1px solid transparent; border-radius:60px;" />
             
           
        
            </div>
             
        </div>
        <!--fin  -->
        
    </div>
</template>


<script>
import Message from './Message'
import {mapGetters} from 'vuex'
export default {
    components: {Message},
    data (){
        return {
            message: '',
            loading: false
        }
    },
    computed:{
        ...mapGetters(['user']),
        messages: function (){
            return this.$store.getters.messages(this.$route.params.id)
        },

         count: function (){
            return this.$store.getters.conversation(this.$route.params.id).count
        },

         prenom: function (){
            return this.$store.getters.conversation(this.$route.params.id).prenom
        },

         photo: function (){
            return this.$store.getters.conversation(this.$route.params.id).photo
        },

        
         name: function (){
            return this.$store.getters.conversation(this.$route.params.id).name
        }
    },
 mounted(){
     this.loadMessages()

     
     this.$messages = this.$el.querySelector('#contentTa')
     //setInterval(this.rechargerPage(), 3000)

 },


 watch: {
     '$route.params.id': function(){
         this.loadMessages()
     }
 },
 
 methods: {
    async loadMessages (){
     await this.$store.dispatch('loadMessages', this.$route.params.id)
      if(this.messages.length < this.count){
               this.$messages.addEventListener('scroll', this.onScroll)
           }
     this.scrollBot()

     },

    async onScroll(){
         if(this.$messages.scrollTop === 0){
             this.loading = true
            this.$messages.removeEventListener('scroll', this.onScroll)
            let previousHeight = this.$messages.scrollHeight
           await this.$store.dispatch('loadPreviousMessages', this.$route.params.id)
           this.$nextTick(() => {
               this.$messages.scrollTop = this.$messages.scrollHeight - previousHeight
           })
           if(this.messages.length < this.count){
               this.$messages.addEventListener('scroll', this.onScroll())
           }
           this.loading = false

         }
     },

     scrollBot (){
         this.$nextTick(() => {
            this.$messages.scrollTop = this.$messages.scrollHeight 
         })
     },

     sendMessage(e){
         if(e.shiftKey === false){
             this.loading = true
             e.preventDefault()
             this.$store.dispatch('sendMessage', {
                 message: this.message,
                 userId: this.$route.params.id
             })

             this.message = ''
             this.scrollBot()
             this.loading = false
         }
     },
      rechargerPage(){
        //location.reload(true);
        $('#contentTa').load(location.href + " #contentTa>*","");


    }
     


     
 }




}
</script>

