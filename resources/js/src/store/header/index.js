
export default {
  namespaced: true,
  state: {
    showHeader: true,
  },
  mutations: {
    CLOSE_HEADER(state) {
      state.showHeader = false
    },
    
  },
  actions: {
    closeHeader({ commit }) {
      commit('CLOSE_HEADER')
    },
   
  },

}
