import Vue from 'vue'

import VueRouter from 'vue-router'
import Messagerie from './components/messages/Messagerie'
import MessageComponent from './components/messages/MessageComponent'
import store from './store/store'


Vue.use(VueRouter)

let $chatApp = document.querySelector('#chatApp')

if($chatApp)
{
    const routes = [
        {path: '/'},
        {path: '/:id', component: MessageComponent, name: 'conversation'}
    ]
    
    const router = new VueRouter({
        mode: 'history',
        routes,
        base: $chatApp.getAttribute('data-base')
    })
    
    new Vue({
    
        el: '#chatApp',
        components: {Messagerie},
        store,
        router
    })
}
