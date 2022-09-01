import { createStore } from 'vuex'
import global from './modules/global'
import user from './modules/user'

export default createStore({
    // 公共模板直接在这里展开就可以
    ...global,
    modules: {
        user
    }
})
