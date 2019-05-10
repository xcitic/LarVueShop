// Core Imports
require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

// External Modules
import axios from 'axios';
import Vuetify from 'vuetify';

// Internal Modules
import App from './App';
import routes from '@/router';
import store from '@/stores';
import auth from '@/utils/Auth';


// Vue Plugins
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(Vuetify);

// Routing
const router = new VueRouter({
  mode: 'history',
  routes
});

// Enable Auth as global
window.auth = auth;



const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
      App
    },
    template: '<App/>'
});
