import getters from './getters'
import actions from './actions'
import mutations from './mutations'

export default {
  namespaced: true,
  state: {
    users: [],
    products: [],
    orders: [],
    payments: [],
    status: '',
    loading: false,
  },

  getters,
  actions,
  mutations


}
