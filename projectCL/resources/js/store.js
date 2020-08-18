import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    actions: {

    },

    getters: {

    },

    modules: {

    },

    mutations: {
        SET_GROUP_INFO(state, arr) {
            state.groups = arr
        },
        SET_REPLY_MODE(state, parent_id) {
            state.replyMode = parent_id
        },
    },

    state: {
        apiURL: 'http://localhost/api',
        serverPath: 'http://localhost',
        groups: [],
        replyMode: '',
    },
});
