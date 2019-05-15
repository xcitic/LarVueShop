import getters from './getters'
import actions from './actions'
import mutations from './mutations'


export default {
  namespaced: true,
  state: {
    cart: [],
    orders: {},
    cart_products: [],
    loading: false,
    status: '',
  },

  getters,
  actions,
  mutations,

}
