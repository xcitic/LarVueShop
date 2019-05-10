import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


// Import different Stores as Seperate Modules with Namespaces
  // Auth Modules
import auth from './auth';


const store = new Vuex.Store({
  modules: {
    auth
  }
})


export default store;
