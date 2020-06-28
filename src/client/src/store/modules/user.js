import router from '../../router/index';
export const state = {
    user: sessionStorage.getItem('user'),
    userData: {
        id: 1,
        login: 'admin@mail.ru',
        password: '123123',
        name: 'Иванов И.В.',
        role: 1
    }
}
export const mutations = {
    SET_USER(state) {
        state.user = JSON.parse(JSON.stringify(state.userData))
        sessionStorage.setItem('user', JSON.stringify(state.userData))
    },
    REMOVE_USER(state) {
        state.user = null
    }

}
export const actions = {
    loginUser({commit}, data) {
        if(state.userData.login === data.login && state.userData.password === data.password) {
            commit('SET_USER')
            commit('SET_TOAST', {
                message: 'Вы успешно вошли!',
                type: 'success'
            })
            router.push('/admin')
        } else {
            commit('SET_TOAST', {
                message: 'Проверьте логин или пароль!',
                type: 'error'
            })
        }
    },
    logout({commit}) {
        commit('REMOVE_USER')
        sessionStorage.removeItem('user')
    }
}
export const getters = {
    isAuthenticated: state => state.user !== null,
    isAdmin: state => state.user.role === 1 && state.user
}