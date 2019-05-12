import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


// Import different Stores as Seperate Modules with Namespaces
  // Auth Modules
import auth from './auth'
import dashboard from './dashboard'
import products from './products'


const store = new Vuex.Store({
  modules: {
    products,
    auth,
    dashboard
  }
})


export default store;
