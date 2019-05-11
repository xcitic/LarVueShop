// Core imports
import Vue from 'vue'
import VueRouter from 'vue-router'

// Internal Modules
import routes from '@/router/routes'
import store from '@/stores'

// Vue plugin
Vue.use(VueRouter)


// Instanciate Router
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
  // the default action
  return next()
})


export default router;
