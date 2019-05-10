// Core Imports
require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';

// External Modules
import axios from 'axios';
import Vuetify from 'vuetify';


// Internal Modules
import App from './App';
import routes from '@/router';


// Vue Plugins
Vue.use(VueRouter);
Vue.use(Vuetify);

// Routing
const router = new VueRouter({
  mode: 'history',
  routes
});




const app = new Vue({
    el: '#app',
    router,
    components: {
      App
    },
    template: '<App/>'
});
