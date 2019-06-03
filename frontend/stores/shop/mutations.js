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

  addToLocalCart_success(state, data) {
    state.status = 'success'
    // check if product exists in cart
    let cartIndex = state.cart.findIndex((product) => {
        return product.id === data.product.id
    })
    if (cartIndex >= 0) {
      return state.cart[cartIndex].quantity+= data.quantity
    }
    else {
      state.cart = [...state.cart, data.product]
    }

  },

  addToLocalCart_error(state, error) {
    state.status = 'Error: ' + error
  },

  fetchLocalCart_success(state) {
    state.status = 'success'
    const localDb = JSON.parse(localStorage.getItem('cart'))
    if(localDb) {
      state.cart_products = localDb
    }
  },


  removeFromCart_success(state, item) {
    state.status = 'success'
    let productToRemove = state.cart.findIndex((product) => {
      return product.id === item
    })
    state.cart.splice(productToRemove, 1)
  },

  removeFromCart_error(state, error) {
    state.status = error.message
  },

  emptyCart(state) {
    state.cart = []
    localStorage.removeItem('cart')
  },

  fetchCartProducts_success(state, payload) {
    state.status = 'success'
    state.cart_products = payload
  },

  fetchCartProducts_error(state, error) {
    state.status = error
  },

  createOrder_success(state, payload) {
    state.status = 'success'
    state.orders = payload
  },

  createOrder_error(state, error) {
    state.status = 'Error' + error
  },

  createPayment_success(state, payload) {
    state.status = 'success'
    state.orders = payload.order
  },

  createPayment_error(state, error) {
    state.status = 'Error ' + error
  }
}
