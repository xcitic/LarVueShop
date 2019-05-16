export default {
  getProducts_success(state, payload) {
    state.products = payload
  },

  getProducts_error(state, error) {
    state.status = error
  },

  getOneProduct_success(state, payload) {
    state.product = payload
  },

  getOneProduct_error(state, error) {
    state.status = error
  },

  like_success(state, id) {
    state.products[id].likes++
  },

  like_error(state, error) {
    state.error = error
  },

  dislike_success(state, id) {
    state.products[id].likes--
  },

  dislike_error(state, error) {
    state.status = error
  },


}
