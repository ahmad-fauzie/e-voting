/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Echo } = require('laravel-echo');

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);

import VueSweetalert2 from 'vue-sweetalert2';

// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
import axios from 'axios';
Vue.use(VueSweetalert2);

var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        messages: [],
    },

    created() {
        this.fetchMessages();

        window.Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    id: e.message.id,
                    message: e.message.message,
                    kandidat_id: e.message.kandidat_id,
                    user: e.user,
                    group_id: e.message.group_id
                });
            })
            .listen('MessageDelete', (e) => {
                let index = this.messages.findIndex(x => x.id === e.message.id);
                this.messages.splice(index, 1);
            });
    },

    methods: {
        

        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                //
            });
        },

        deleteMessage(id) {
            console.log(id.id);
            console.log(this.messages);
            let index = this.messages.findIndex(x => x.id === id.id);
            this.messages.splice(index, 1);

            axios.post('/deleteMessages', id).then(response => {
                toastMixin.fire({
                    title: "Pesan Berhasil Dihapus!",
                    icon: 'success',
                });
            });
        },

        deleteMessageGroup(group_id){
            let filteredMessages = this.messages.filter(mess => mess.group_id === group_id.group_id);
            filteredMessages.forEach(x => {
                let index = this.messages.findIndex(y => y.id === x.id);
                this.messages.splice(index, 1);
            });

            axios.post('/deleteMessagesGroup', group_id).then(response => {
                toastMixin.fire({
                    title: "Pesan Berhasil Dihapus!",
                    icon: 'success',
                });
            });
        }
    },
});
