import getters from './getters'
import actions from './actions'
import mutations from './mutations'


export default {
  namespaced: true,
  state: {
    loading: false,
    product: {},
    products: {},
    inCart: null,
    status: null,
    cart: []
  },

  getters,
  actions,
  mutations,
}
