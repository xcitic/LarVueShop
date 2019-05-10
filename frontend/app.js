// Core Imports
require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';

// External Modules



// Internal Modules
import App from './App';



// Vue Plugins
Vue.use(VueRouter);




const app = new Vue({
    el: '#app',
    components: {
      App
    },
    template: '<App/>'

});
