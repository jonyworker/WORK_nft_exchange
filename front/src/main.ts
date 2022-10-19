import { createApp } from 'vue'
import App from './App.vue'
import './assets/style/app.css'
import ElementPlus from 'element-plus';
import "element-plus/dist/index.css"; // element默认主题色
// import "./assets/style/theme/scss/theme-chalk/index.css"//更換element plus css 連結
import "element-plus/theme-chalk/dark/css-vars.css"; // 暗黑模式主题色
import "./assets/style/theme/dark/css-vars.css"; // 暗黑模式主题色
import "./assets/style/theme/light/css-vars.css"; // 暗黑模式主题色
import * as ElementPlusIconsVue from '@element-plus/icons-vue'
import store from "./store";
import router from "./router";


import i18n from "./i18n/index";
const app = createApp(App);
for (const [key, component] of Object.entries(ElementPlusIconsVue)) {
    app.component(key, component)
}
app.use(ElementPlus);
app.use(i18n);
app.use(store)
app.use(router)
app.mount('#app');