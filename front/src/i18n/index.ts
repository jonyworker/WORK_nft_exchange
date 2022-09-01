import {createI18n} from 'vue-i18n';
import zhCn from './lang/zh-cn';
import en from './lang/en';
import zhTw from './lang/zh-tw';

const i18n = createI18n({
    legacy: false,
    locale: sessionStorage.getItem('localeLang') || 'zhCn',
    messages: {
        zhCn,
        en,
        "zh-tw":zhTw
    },
});

export default i18n;