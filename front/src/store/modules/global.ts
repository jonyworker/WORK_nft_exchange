import {MutationTree} from 'vuex';
import {State} from '../state';
import {LANG_TYPE_ENUM} from '../../enum/lanuage'
export const state: State = {
    language: sessionStorage.getItem('localeLang') || 'zh-tw',
    languageEnum: LANG_TYPE_ENUM['zh-tw'],
};


export const mutations: MutationTree<State> = {
    // 修改语言
    CHANGE_LANGUAGE(state, value: string) {
        state.language = value;
        state.languageEnum = LANG_TYPE_ENUM[value as any] as any;
        sessionStorage.setItem('localeLang', value);
        sessionStorage.setItem('localeLangEnum', `${state.languageEnum}`);
    },
};

// 全局
export default {
    state,
    mutations,
    actions: {},
    getters: {}
};