// 用户
export default {
    // 开启命名空间
    namespaced: true,
    state: {
        info: {
            uname: 'Leo',
            age: 21
        }
    },
    mutations: {
        updateUname(state:any, val:any) {
            state.info.uname = val
        },
        updateAge(state:any, val:any) {
            state.info.age = val
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
