<template>
    <div class="container" id="conv" style="height: 450px;">
      
         <!--ttt -->
        <div id="sidepanel">
       <!--
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" id="user" placeholder="Chercher un contact..." />
        </div>
        -->
        <div id="contacts">
            <ul  class="" style="list-style:none;">
             <li class="contact" v-for="conversation in conversations" :key="conversation.id">
                                     <div class="wrap">
                                 <!--<span class="contact-status online"></span>-->
                        <div class="meta">
                           <p class="name">

                    <router-link :to="{name: 'conversation', params: {id: conversation.id}}"  class="list-group-item">
                     <img :src="conversation.photo" alt="" />

                         {{ conversation.prenom}} {{ conversation.name}}

                        <span class="badge badge-pill badge-primary" v-if="conversation.unread">    
                            {{conversation.unread}}        
                    </span>

                    </router-link>
                           </p>
                            <!--- <p class="preview">un messge pas trop long</p>-->

                        </div>
                    </div>
                    </li>

                
            </ul>
        </div>
        <!--
        <div id="bottom-bar">
            <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Ajouter contact</span></button>
            <button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Paramètres</span></button>
        </div>
        -->
    </div>

        <!--fin -->

        <div class="content" id="contentT">

            <router-view></router-view>
        </div>

     


    </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
   props: {
       user: Number
   },

   computed:{
       ...mapGetters(['conversations'])
   },


   mounted(){

       this.$store.dispatch('loadConversations')
       this.$store.commit('setUser', this.user)
       
   }

}
</script>
