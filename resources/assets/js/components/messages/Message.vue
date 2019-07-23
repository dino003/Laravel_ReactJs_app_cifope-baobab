<template>
    
            <li :class="cls">
                   <!-- <img :src="message.user.photo" alt="" />-->
                    
                    <p>{{message.message}}</p>
                </li>

         
</template>

<script>
export default {
    props:{
        message: Object,
        user: Number
    },

    computed: {
        isMe()
        {
            return this.message.from_id === this.user
        },
        cls (){
            let cls = ['']
            if(this.isMe){
             cls.push('sent')
            }
            else{
             cls.push('replies')
 
            }
            return cls

        },

        name(){
            return this.isMe ? 'Moi' : this.message.user.name
        }

    }
}
</script>

