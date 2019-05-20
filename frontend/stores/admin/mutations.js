export default {
  fetchTables_success(state, data) {
    state.status = 'success'
    state.users = data.users
    state.products = data.products
    state.orders = data.orders
    state.payments = data.payments
  },

  fetchTables_error(state, error) {
    state.status = 'Error: ' + error
  }
}
