export const state = {
    publisher: {
        title: 'Загадка дыры',
        mainColor: '#222',
        accentColor: '#1b8',
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
    ADD_RUBRIC(state, rubric) {
        state.publisher.rubrics.push({
            id: state.publisher.rubrics.length + 1,
            title: rubric,
            uri: rubric
        })
    },
    REMOVE_RUBRIC(state, id) {
        const rubricIndex = state.publisher.rubrics.findIndex(el => el.id === id)
        state.publisher.rubrics.splice(rubricIndex, 1)
    },
    SAVE_CHANGES(state, changes) {
        state.publisher = JSON.parse(JSON.stringify(changes))
    }
}
export const actions = {}
export const getters = {}