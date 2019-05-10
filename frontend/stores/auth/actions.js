export default {

  login({state, commit}, payload)
  {
    // Create new Promise instance to call login api
      return new Promise((resolve, reject) => {
        // Change status
        commit('auth_request')
        // Make api request
        axios.post('/login', payload)
              // On successful response, create mutation for saving user info
             .then((resp) => {
               let data = {
                 token: resp.data.token,
                 user: resp.data.user
               }
               commit('auth_success', data)
               resolve()
             })
             // On failure clear all local data
             .catch((err) => {
               commit('auth_error', err)
               auth.logout()
               reject(err)
             })
      })
  },

  register({commit}, payload)
  {
    return new Promise((resolve, reject) => {
      commit('auth_request')
      axios.post('/register', payload)
           .then((resp) => {
             let data = {
               token: resp.data.token,
               user: resp.data.user
             }
             commit('auth_success', data)
             resolve()
           })
           .catch((err) => {
             commit('auth_error', err)
             auth.logout()
             reject(err)
           })
    })
  },

  logout({commit})
  {
    commit('logout')
  },

  fetchToken({commit})
  {
    // fetch data from localstorage
    // TODO json.parse fails if 'user' is not json format
      let data = {
        token: localStorage.getItem('token'),
        user: JSON.parse(localStorage.getItem('user'))
    }
    // send mutation to vuex
    commit('updateToken', data)
  }
}
