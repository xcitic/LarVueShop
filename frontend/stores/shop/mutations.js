export default {

  fetchCart_success(state, payload = []) {
    state.status = 'success'
    state.cart = payload
    localStorage.setItem('cart', JSON.stringify(state.cart))
  },

  fetchCart_error(state, error) {
    state.status = error.message
  },

  createCart(state, payload = []) {
    state.cart = payload
    localStorage.setItem('cart', JSON.stringify(state.cart))
    state.status = 'Create cart success'
  },


  addToCart_success(state, payload) {
    state.status = 'success'
    state.cart = payload
    localStorage.setItem('cart', JSON.stringify(state.cart))
  },

  addToCart_error(state, error) {
    state.status = error.message
  },

  addToLocalCart_success(state, payload) {
    state.status = 'success'
    let localDb = JSON.parse(localStorage.getItem('cart'))
    if(localDb) {
      // TODO check if product is in array, if yes increase the quantity.
      state.cart = localDb.concat(payload)
      localStorage.setItem('cart', JSON.stringify(state.cart))
    }
    else {
      state.cart = payload
      localStorage.setItem('cart', JSON.stringify(state.cart))
    }

  },

  emptyCart(state) {
    state.cart = []
    localStorage.removeItem('cart')
  }

}
