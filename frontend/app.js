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

// Authenticate routes and set headers
router.beforeEach((to, from, next) => {
  // send action to vuex, populate localstorage
  store.dispatch('auth/fetchToken');
  const token = localStorage.getItem('token');
  // if user has token saved, include it in every request header
  if (token) {
    axios.defaults.headers.common['Authorization'] = 'bearer ' + token
  }
  // match any routes that has requireAuth set to true in router
  if(to.matched.some(record => record.meta.requiresAuth)){
    // check to see if authentication token exists
    // TODO check on client that the auth token is real and not spoofed
    if(token) {
      return next()
    }
    // if user does not have token redirect to login page
    return next('/login')
  }
    // return next request
    return next()
})

// Base URL for the API
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`

// Make auth global
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
