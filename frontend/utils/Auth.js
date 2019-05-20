class Auth {

  constructor()
  {
    this.token = null
    this.user = null
  }


  login(token, user)
  {
    window.localStorage.setItem('token', token);
    window.localStorage.setItem('user', JSON.stringify(user))

    axios.defaults.headers.common['Authorization'] = token
  }

  logout()
  {
    localStorage.removeItem('token')
    localStorage.removeItem('user')
    axios.defaults.headers.common['Authorization'] = ''
  }

  checkUser()
  {
    let user_token = localStorage.getItem('token');
    if (user_token) {
      return true
    }
    return false
  }

  isAdmin()
  {
    let user = store.state.auth.user
    if(user.role === 'admin') {
      return true
    }
    return false
  }

}

export default new Auth();
