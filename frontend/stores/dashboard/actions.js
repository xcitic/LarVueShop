export default {

  isCollapse( {state, commit} ) {
      let payload = !state.isCollapse
      commit('isCollapse', payload)
  },
}
