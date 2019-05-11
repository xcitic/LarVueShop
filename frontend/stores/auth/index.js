import actions from './actions'
import mutations from './mutations'
import getters from './getters'

export default {
  namespaced: true,

  state: {
    status: '',
    authToken: '',
    user: {},
  },

  mutations,
  getters,
  actions
}
