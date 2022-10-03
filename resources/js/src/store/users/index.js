import getUser from '../../../../api/getUser'

export default {
  namespaced: true,
  state: {
    user: [],
    timer: 0,
  },
  mutations: {
    GET_USER(state, payload) {
      state.user = payload
    },
    SET_TIMER(state, payload) {
      state.timer = payload
    }
  },
  actions: {
    async getUsers({ commit }) {
      const res = await getUser()
      if (res) {
        commit('GET_USER', res.data)
      }
    },
    addTimer({commit}, {payload}){
      commit("SET_TIMER", payload)
    }
  },

}
