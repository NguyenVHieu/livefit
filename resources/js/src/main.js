import Vue from 'vue'
import {ToastPlugin, ModalPlugin, BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import router from './router'
import store from './store'
import App from './App.vue'
// Global Components
import './global-components'

// 3rd party plugins
import '@/libs/portal-vue'
import '@/libs/toastification'

// BSV Plugin Registration

Vue.use(ToastPlugin)
Vue.use(ModalPlugin)
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

// Composition API
Vue.use(VueCompositionAPI)

// import core styles
require('@resources/scss/core.scss')

// import assets styles
require('@resources/assets/scss/style.scss')

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
