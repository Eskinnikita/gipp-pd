import Vue from 'vue'
import Vuex from 'vuex'

import * as pageModule from './modules/page';
import * as newsModule from './modules/news'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {

  },
  mutations: {
  },
  actions: {
  },
  modules: {
    pageModule,
    newsModule
  }
})
