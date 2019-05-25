export default {

  isCollapse(state, payload) {
    state.isCollapse = payload
  },

  fetchOrders_success(state, payload) {
    state.status = 'success'
    console.log(payload)
    state.orders = payload.orders
    state.payments = payload.payments
  },

  fetchOrders_error(state, error) {
    state.status = 'error: ' + error
  }
}
