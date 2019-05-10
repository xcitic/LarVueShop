export default {
  auth_request(state)
  {
    state.status = 'loading'
  },

  auth_success(state, payload)
  {
    state.status    = 'logged in'
    state.authToken = payload.token
    state.user      = payload.user
    // Save to localStorage
    auth.login(payload.token, payload.user)
  },

  auth_error(state, err)
  {
    // Update state with error message
    state.status = 'Error: ' + err
  },

  logout(state)
  {
    state.status    = 'logged out'
    state.authToken = null
    state.user = ''
    auth.logout()
  },

  updateToken(state, payload)
  {
    // Update state with $token string and $user object.
    state.authToken = payload.token
    state.user      = payload.user
  }

}
