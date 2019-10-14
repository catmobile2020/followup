
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Toaster from 'v-toaster'
// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'
// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})

import Nl2br from 'vue-nl2br'
Vue.component('nl2br', Nl2br)

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

import EventBus from './EventBus'
Vue.prototype.$bus = EventBus

Vue.component('InfiniteLoading', require('vue-infinite-loading'));
Vue.component('notifications', require('./components/NotificationsComponent'));
Vue.component('messages', require('./components/MessagesComponent'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
