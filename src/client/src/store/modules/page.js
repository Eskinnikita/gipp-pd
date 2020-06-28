export const state = {
    publisher: {
        title: 'Загадка дыры',
        mainColor: '#222',
        accentColor: '#3597A7',
        rubrics: [
            {
                title: 'Путин',
                uri: 'putin'
            },
            {
                title: 'Сирия',
                uri: 'siriya'
            },
            {
                title: 'Бытие',
                uri: 'bitie'
            },
            {
                title: 'Коронавирус',
                uri: 'koronavirus'
            }
        ]
    }
}
export const mutations = {
    SET_CHANGES(state, changes) {
        state.publisher = JSON.parse(JSON.stringify(changes))
    }
}
export const actions = {
    addRubric({commit}, rubric) {
        commit('SET_RUBRIC', rubric)
    },
    savePageChanges({commit}, changes) {
        commit('SET_CHANGES', changes)
        commit('SET_TOAST', {
            message: 'Изменения сохранены!',
            type: 'success'
        })
    }
}
export const getters = {}