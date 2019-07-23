<template>
    <div class="row">

        <div class="" id="sidepanel">
             <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="" class="online" alt="" />
                <p>nom de l'auth</p>
                        
            </div>
        </div>

        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" id="user" placeholder="Chercher un contact..." />
        </div>

        <div id="contacts">
            <ul class="" style="list-style:none;">
                <li class="contact">
            <router-link :to="{name: 'conversation', params: {id: conversation.id}}" class="contact" v-for="conversation in conversations" :key="conversation.id">
                    <div class="wrap">
                        <span class="contact-status online"></span>
                       <!-- <img :src="employe.photo" alt="" />-->
                        <div class="meta">
                            <p class="name"> {{conversation.prenom}} {{conversation.name}}
                                <span class="badge" v-if="conversation.unread">{{conversation.unread}}</span>
                            </p>
                            <p class="preview"></p>
                        </div>
                    </div>
            </router-link>
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

    <!--<img :src="ami.photo" alt="" />-->
    <p>Nom et prenom</p>
    
</div>
        <router-view></router-view>

    </div>

</div>

    

</template>


<script>
import {mapGetters} from 'vuex'

    export default{
        props:{
            user: Number
        },

        computed: {
            ...mapGetters(['conversations'])
        },

        mounted () {
            this.$store.dispatch('loadConversations')
            this.$store.commit('setUser', this.user)
        }
    }

</script>