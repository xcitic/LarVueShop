export default {

  fetchCart({commit, state}) {
    // If user is authenticated create a api promise call
    if( auth.checkUser() ) {
      return new Promise((resolve, reject) => {
        axios.get('/cart')
             .then(({ data }) => {
               commit('fetchCart_success', data)
               resolve()
             })
             .catch((err) => {
               commit('fetchCart_error', err)
               reject()
             })
         })
      }
      // If user is not logged in
    else {

      const localDb = localStorage.getItem('cart')
        if(localDb === null) {
        // Create a new localStorage and set the cart to empty array
          commit('createCart')
        }
        else
        {
          // If localStorage exists, then fetch and parse it
          let data = JSON.parse(localDb);
          commit('fetchCart_success', data)
        }
    }
},


  addToCart({commit, rootState, state}, payload) {
    // If user is authenticated create api promise
    if( auth.checkUser() ) {
      return new Promise((resolve, reject) => {
        axios.post(`/product/cart/add/${payload.product_id}/${payload.quantity}`)
             .then(({ data }) => {
               commit('addToCart_success', data)
               resolve()
             })
             .catch((err) => {
               commit('addToCart_error', err)
               reject()
             })
         })
      }
      else {
        // if user is not authenticated push to localStorage
          let id = payload.product_id - 1
          let product = rootState.products.products.data[id]
          product.quantity = payload.quantity

          let data = {
            product: product,
            quantity: payload.quantity
          }

          return new Promise((resolve, reject) => {
            commit('addToLocalCart_success', data)
              localStorage.setItem('cart', JSON.stringify(state.cart))
              resolve()
            .catch((err) => {
              commit('addToLocalCart_error', err)
              reject()
            })
        })
    }
  },

  removeFromCart({commit, state}, item) {
    if (auth.checkUser() ) {
      return new Promise((resolve, reject) => {
        axios.post(`/product/cart/remove/${item}`)
              .then(({ data }) => {
                commit('removeFromCart_success', data)
                resolve()
              })
              .catch((err) => {
                commit('removeFromCart_error', err)
                reject()
              })
      })
    }
    else {
      // user is not authenticated only modify localStorage
      commit('removeFromCart_success', item)
      localStorage.setItem('cart', JSON.stringify(state.cart))
    }
  },

  fetchCartProducts({commit}) {
    if (auth.checkUser()) {
      return new Promise((resolve, reject) => {
        axios.get('/cart/products')
             .then(({data}) => {
               commit('fetchCartProducts_success', data)
               resolve()
             })
             .catch((err) => {
               commit('fetchCartProducts_error', err.message)
               reject(err.message)
             })
      })
    }
    else {
        commit('fetchLocalCart_success')
    }

  },

  createPayment({commit, state}, payload) {
    return new Promise((resolve,reject) => {
      axios.post('/cart/payment', payload)
           .then(({data}) => {
             commit('createPayment_success', data)
             commit('emptyCart')
             resolve('success')
           })
           .catch((err) => {
             commit('createPayment_error', err)
             reject('error ' + err)
           })
        })
    },

  guestOrder({state, commit}, payload) {
    return new Promise((resolve, reject) => {
      axios.post('/cart/order/guest', payload)
      .then(({data}) => {
          resolve('success')
      })
      .catch((err) => {
        commit('createOrder_error', err)
        reject(err)
      })
    })

  },

  guestPayment({commit, state}, payload) {
    return new Promise((resolve, reject) => {
      axios.post('/cart/payment/guest', payload)
           .then(({data}) => {
             commit('createPayment_success', data)
             commit('emptyCart')
             resolve('success')
           })
           .catch((err) => {
             commit('createPayment_error', err)
             reject('error ' + err)
           })
    })
  }
}
