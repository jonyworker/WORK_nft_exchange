import {LANG_TYPE_ENUM} from "@enum/lanuage";

export type State = {
    os: {
        isTablet: boolean,
        isPhone: boolean,
        isAndroid: boolean,
        isPc: boolean
    };
    language: string;
    languageEnum: LANG_TYPE_ENUM;
};