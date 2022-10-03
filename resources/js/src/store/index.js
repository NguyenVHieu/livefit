import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'
import products from './products'
import guide from "./guide"
import plans from "./plans"
import header from "./header"
import users from "./users"
import workout from "./workout"

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    app,
    appConfig,
    verticalMenu,
    products,
    guide,
    plans,
    header,
    users,
    workout
  },
  strict: process.env.DEV,
})
