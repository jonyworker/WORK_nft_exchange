import { createApp } from 'vue'
import App from './App.vue'
import './assets/style/app.css'
import ElementPlus from 'element-plus';
import 'virtual:windi.css'
import 'element-plus/dist/index.css';
import 'element-plus/theme-chalk/dark/css-vars.css'
import store from "./store";
import router from "./router";


import i18n from "./i18n/index";
const app = createApp(App);

app.use(ElementPlus);
app.use(i18n);
app.use(store)
app.use(router)
app.mount('#app');