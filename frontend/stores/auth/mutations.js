export default {
  auth_request(state)
  {
    state.status = 'loading'
  },

  auth_success(state, payload)
  {
    state.status = 'success'
    state.authToken = payload.token
    state.user = payload.user
    auth.login(payload.token, payload.user)
  },

  auth_error(state, err)
  {
    state.status = 'Error: ' + err
  }

}
