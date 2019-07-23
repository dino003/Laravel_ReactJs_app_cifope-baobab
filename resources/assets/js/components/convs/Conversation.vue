<template>
    
    <li class="sent">
			<!--<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /> -->
			    <p> {{message.message}}</p>
	</li>
</template>

<script>
    export default{
        props: {
            message: Object,
            user: Number
        },

        computed: {

            isMe() {
                return this.message.from_id === this.user
            },
            cls() {
                let cls = ['col-md-10']

                if(this.isMe){
                    cls.push('offset-md-2 text-right')
                }

                return cls
            },

            name() {
                return this.isMe ? 'moi' : this.message.user.name
            }
        }
    }
</script>