import {createI18n} from 'vue-i18n';
import zhCn from './lang/zh-cn';
import en from './lang/en';
import zhTw from './lang/zh-tw';
import jp from './lang/jp';
import kr from './lang/kr';

const i18n = createI18n({
    legacy: false,
    locale: sessionStorage.getItem('localeLang') || 'zh-tw',
    messages: {
        zhCn,
        en,
        "zh-tw":zhTw,
        jp,
        kr
    },
});

export default i18n;