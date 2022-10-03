export default {
    namespaced: true,
    state: {
      listWorkout: []
    },
    mutations: {
        SET_LIST_WORKOUT(state, payload) {
            state.listWorkout = payload
        },
        SET_PROCESS(state, index) {
            state.listWorkout[index].processing = true
        }
    },
    actions: {
      addListWorkout({commit}, {payload}){
        commit("SET_LIST_WORKOUT", payload)
      },
      setProcess({commit}, {index}) {
        commit("SET_PROCESS", index)
      }
    },
  
  }