export default {
  getProducts({commit}) {
    return new Promise((resolve,reject) => {
      axios.get('/products')
          .then(({data}) => {
              let payload = data.data
              commit('getProducts_success', payload)
              resolve()
              })
              .catch((err) => {
                commit('getProducts_error', err)
                reject(err)
                })
              })
  },

  getOneProduct({commit}, id) {
    return new Promise((resolve,reject) => {
      axios.get('/product/' + id)
          .then(({ data }) => {
            commit('getOneProduct_success', data)
            resolve()
          })
          .catch((err) => {
            commit('getOneProduct_error', err)
            reject(err)
          })
    })
  },

  like({commit}, id) {
    return new Promise((resolve,reject) => {
      axios.post('/product/like/' + id)
          .then(({ data }) => {
            // decrement id by 1 to match array start at 0
            let id = data.id - 1
            commit('like_success', id)
            resolve()
          })
          .catch((err) => {
            commit('like_error', err)
            reject(err)
          })
    })
  },

  dislike({commit}, id) {
    return new Promise((resolve, reject) => {
      axios.post('product/dislike/' + id)
          .then(({ data }) => {
            // decrement id by 1 to match array start at 0
            let id = data.id - 1
            commit('dislike_success', id)
            resolve()
          })
          .catch((err) => {
            commit('dislike_error', err)
            reject(err)
          })
    })
  },

}
