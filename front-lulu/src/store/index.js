import { createStore } from 'vuex'

export default createStore({
    state: {
        products: {},
        user: null
    },
    getters: {},
    mutations: {
        setUser (state, user) {
            state.user = user
        }
    },
    actions: {},
    modules: {}
})
