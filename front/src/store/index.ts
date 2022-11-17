import { createStore } from 'vuex'
import createPersistedstate from 'vuex-persistedstate'
import global from './modules/global'
import user from './modules/user'

export default createStore({
    // 公共模板直接在这里展开就可以
    ...global,
    modules: {
        user
    },
    plugins: [
        createPersistedstate({
            key: 'saveInfo',
            paths: ['user','isLogin','token']
        })
    ]
})
