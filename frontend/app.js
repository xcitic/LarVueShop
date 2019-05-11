// Core Imports
require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';

// External Modules
import axios from 'axios';
import Vuetify from 'vuetify';
import ElementUI from 'element-ui';

// Internal Modules
import App from './App';
import routes from '@/router';
import store from '@/stores';
import auth from '@/utils/Auth';


// Vue Plugins
Vue.use(VueRouter);
Vue.use(Vuetify);
// TODO Only include the used elements.
Vue.use(ElementUI);

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
  axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}
// match any routes that has requireAuth set to true in router
if(to.matched.some(record => record.meta.requiresAuth)){
  // check to see if authentication token exists
  // TODO check on client that the auth token is real and not spoofed
  if(token) {
    // Post to server and check that the token is real..?
    // Is there any other way to perform the token check to avoid client side token injection?
    return next()
  }
  // if user does not have token redirect to login page
  return next('/login')
}

// If user is already authenticated don't let them enter register and login, redirect to dashboard
if(to.matched.some(record => record.meta.guest)) {
  if(token) {
    return next('/dashboard')
  }
}
  // return next request
  return next()
})


// Base URL for the API
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`

// Make auth global
window.auth = auth;


// Create the Vue instance and mount it to the element id: #app
const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
      App
    },
    template: '<App/>'
});
