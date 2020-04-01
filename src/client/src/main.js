import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Tabs from 'vue-tabs-component';

Vue.use(Tabs);
const moment = require('moment')
require('moment/locale/ru')

Vue.use(require('vue-moment'), {
  moment
})



Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
