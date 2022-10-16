import {MutationTree} from 'vuex';
import {State} from '../state';
import {LANG_TYPE_ENUM} from '@enum/lanuage'
import osInfo from '@utils/judjeOS'
export const state: State = {
    os: osInfo,
    token: '',
    language: sessionStorage.getItem('localeLang') || 'zh-tw',
    languageEnum: LANG_TYPE_ENUM['zh-tw'],
    isLogin:false,
};


export const mutations: MutationTree<State> = {
    // 修改语言
    CHANGE_LANGUAGE(state, value: string) {
        state.language = value;
        state.languageEnum = LANG_TYPE_ENUM[value as any] as any;
        sessionStorage.setItem('localeLang', value);
        sessionStorage.setItem('localeLangEnum', `${state.languageEnum}`);
    },
    changeLoginStatus(state, value: boolean){
        console.log("-> 登录", value);
        state.isLogin =value;
    }
};

// 全局
export default {
    state,
    mutations,
    actions: {},
    getters: {}
};