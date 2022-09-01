import {MutationTree} from 'vuex';
import {State} from '../state';
export const state: State = {
    language: sessionStorage.getItem('localeLang') || 'zhCn',
};


export const mutations: MutationTree<State> = {
    // 修改语言
    CHANGE_LANGUAGE(state, value: string) {
        state.language = value;
        sessionStorage.setItem('localeLang', value);
    },
};

// 全局
export default {
    state,
    mutations,
    actions: {},
    getters: {}
};