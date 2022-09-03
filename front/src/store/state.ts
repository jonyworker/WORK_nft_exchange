import {LANG_TYPE_ENUM} from "../enum/lanuage";

export type State = {
    language: string;
    languageEnum: LANG_TYPE_ENUM;
};

export const state: State = {
    language: sessionStorage.getItem("localeLang") || "zhCn",
    languageEnum: LANG_TYPE_ENUM["zh-tw"],
};
