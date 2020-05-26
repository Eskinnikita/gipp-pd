import Vue from 'vue'
import Vuex from 'vuex'

import * as pageModule from './modules/page';
import * as newsModule from './modules/news';
import * as userModule from './modules/user'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isLoading: false,
        loaderMessage: ''
    },
    mutations: {
        SET_TOAST(state, toastInfo) {
            this._vm.$toast.open(
                {
                    message: toastInfo.message,
                    type: toastInfo.status
                }
            )
        }
    },
    actions: {},
    modules: {
        pageModule,
        newsModule,
        userModule
    }
})
