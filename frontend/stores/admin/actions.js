export default {
  fetchTables({commit}) {
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
  },

  createProduct({commit}, payload) {
      return new Promise((resolve, reject) => {
        axios.post('/admin/createProduct', payload)
             .then(({data}) => {
               commit('createProduct_success', data)
               resolve()
             })
             .catch((err) => {
               commit('createProduct_error', err)
               reject()
             })
      })
  },
}
