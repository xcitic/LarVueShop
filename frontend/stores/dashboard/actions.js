export default {

  isCollapse( {state, commit} ) {
      let payload = !state.isCollapse
      commit('isCollapse', payload)
  },

  fetchOrders( {commit} ) {
    return new Promise((resolve,reject) => {
      axios.get('/dashboard/orders')
           .then(({data}) => {
             commit('fetchOrders_success', data)
             resolve()
           })
           .catch((err) => {
             commit('fetchOrders_error', err)
             reject()
           })
    })
  }
}
