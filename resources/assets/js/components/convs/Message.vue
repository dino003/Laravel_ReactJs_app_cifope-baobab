<template>
    <div classs="messages">


        <ul class="">
            <Conversation :message="message" v-for="message in messages" :user="user" :key="message.id"></Conversation>

            
        </ul>

        	<div class="message-input">
                <div class="wrap">
                         <form action="" method="">

                <div class="form-group">
                    <textarea name="message" @keypress.enter="sendMessage" v-model="message"></textarea>
                </div>
                <div class="con" v-if="loading">
                    <div class="loader">

                    </div>
                </div>
            </form>
                </div>
		</div>
    </div>
</template>

<script>
import Conversation from './Conversation'
import {mapGetters} from 'vuex'
    export default {


        components: {Conversation},

        date () {
            return {
                message: '',
                errors: {},
                loading: true
            }
        },

        computed:{
            ...mapGetters(['user']),

            messages: function(){
                return this.$store.getters.messages(this.$route.params.id)
            }
        },

        mounted() {
            this.loadMessages()
        },

        watch: {
            '$route.params.id': function(){
                this.loadMessages()
            }
        },

        methods: {
            loadMessages() {
                this.$store.dispatch('loadMessages', this.$route.params.id)


            },

           async sendMessage (e){
                if(e.shiftKey == false){
                    this.loading = true
                    e.preventDefault()
                   try {
                        await this.$store.dispatch('sendMessage', {
                        message: this.message,
                        userId: this.$route.params.id
                    })
                    this.message = ''

                   }catch (e){
                       this.errors = e.errors
                   }

                   this.loading = false
                }
            }
        }
    }

</script>