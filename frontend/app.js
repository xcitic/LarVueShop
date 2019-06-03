// Core Imports
require('./bootstrap')
import Vue from 'vue'
import VueRouter from 'vue-router'

// External Modules
import axios from 'axios'
import Vuetify from 'vuetify'
import ElementUI from 'element-ui'

// Internal Modules
import App from './App'
import store from '@/stores'
import auth from '@/utils/Auth'
import router from '@/router'

// Vue Plugins
Vue.use(Vuetify)
// TODO Only include the used elements.
Vue.use(ElementUI)




// Base URL for the API
const host = 'http://localhost:8000'
axios.defaults.baseURL = 'http://localhost:8000/api'

// Make auth global
window.auth = auth;

// Test if Store can be access globally
window.store = store;


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
