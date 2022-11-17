// 用户
export default {
    // 开启命名空间
    namespaced: true,
    state: {
        loginInfo: {}
    },
    mutations: {
        updateLoginInfo(state:any, val:any) {
            state.loginInfo = val
        }
    },
    actions: {
        asyncUpdate(store:any, val:any) {
            setTimeout(() => {
                store.commit('updateAge', val)
            }, 2000)
        }
    },
    getters: {
        format(state:any) {
            return state.info.uname + ',nice to meet you~'
        }
    }
}
