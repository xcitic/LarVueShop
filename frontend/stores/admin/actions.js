export default {
  fetchTables({state, commit}) {
    return new Promise((resolve,reject) => {
      axios.get('/admin/dashboard')
           .then(({data}) => {
             commit('fetchTables_success', data)
             resolve()
           })
           .catch((err) => {
             commit('fetchTables_error', err)
             reject()
           })

    })
  }
}
