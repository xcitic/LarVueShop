export default {

  fetchCart({commit, state}) {
    // If user is authenticated create a api promise call
    if(auth.checkUser())
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
      // If user is not logged in
    else {

      let localDb = localStorage.getItem('cart')
        if(localDb === null) {
        // Create a new localStorage and set the cart to empty array
          commit('createCart')
        }
        else
        {
          // If localStorage exists, then fetch and parse it
          // let data = JSON.parse(localDb);
          // console.log(localDb)
          // console.log(data)
          commit('fetchCart_success', JSON.parse(localDb))
        }
    }
},


  addToCart({commit}, payload) {
    // If user is authenticated create api promise
    if(auth.checkUser())
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
      else {
        // if user is not authenticated push to localStorage

          commit('addToLocalCart_success', payload)

      }

  },

}
