export default {
  fetchTables_success(state, data) {
    state.users = data.users
    state.products = data.products
    state.orders = data.orders
    state.payments = data.payments
    state.status = 'Success'
  },

  fetchTables_error(state, error) {
    state.status = 'Error: ' + error
  },

  createProduct_success(state, data) {
    state.products = [...state.products, data]
    state.status = 'Success'
  },

  createProduct_error(state, error) {
    state.status = 'Error: ' + error
  }
}
