<template>
  <div class="page">
    <div class="pc_header">
      <div class="container">
        <el-menu
          class="el-menu-demo"
          mode="horizontal"
          :ellipsis="false"
          @select="handleSelect"
        >
          <el-menu-item index="0" @click="toHome()">NFTotal</el-menu-item>
          <el-menu-item index="9" class="!h-[58px]"><el-input class="border-circle" v-model="input" placeholder="搜索NFT和錢包" /></el-menu-item>
          <el-menu-item index="1">探索NFT</el-menu-item>
          <el-menu-item index="2">Mint观测站</el-menu-item>
          <el-menu-item index="3">统计</el-menu-item>
          <el-menu-item index="4">工具</el-menu-item>
          <el-menu-item index="5" @click="toNews()">新闻</el-menu-item>
          <el-menu-item index="6">专栏</el-menu-item>
          <div class="flex-grow"/>
          <el-menu-item index="7" @click="toggleDark(!isDark)">
            {{ $t(isDark ? 'global.dark' : 'global.light') }}
          </el-menu-item>
          <el-sub-menu index="8">
            <template #title>语言 - {{ langType[language] }}</template>
            <el-menu-item index="zhCn" @click="handleCommand('zhCn')">简体中文</el-menu-item>
            <el-menu-item index="zh-tw" @click="handleCommand('zh-tw')">繁体中文</el-menu-item>
            <el-menu-item index="en" @click="handleCommand('en')">English</el-menu-item>
          </el-sub-menu>
        </el-menu>
      </div>
    </div>
    <div class="middle_header">
          <div class="container">
            <div class="top-bar-content">
              <div class="header-logo" @click="toHome()">
                NFTotal
              </div>
              <div class="top_center">
                Connect Wallet
              </div>
              <div class="menu_icon">
                <svg t="1661333269863" class="icon" viewBox="0 0 1032 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5593" width="200" height="200"><path d="M85.825737 214.431767l864.571964 0c44.777833 0 81.055061-36.291554 81.055061-81.054037 0-44.76146-36.277228-81.053014-81.055061-81.053014L85.825737 52.324716c-44.773739 0-81.054037 36.291554-81.054037 81.053014C4.7717 178.140213 41.051998 214.431767 85.825737 214.431767zM950.397702 430.575526 85.825737 430.575526c-44.773739 0-81.054037 36.278251-81.054037 81.053014 0 44.774763 36.279275 81.053014 81.054037 81.053014l864.571964 0c44.777833 0 81.055061-36.277228 81.055061-81.053014C1031.452762 466.853777 995.175534 430.575526 950.397702 430.575526zM950.397702 808.826336 85.825737 808.826336c-44.773739 0-81.054037 36.279275-81.054037 81.051991 0 44.776809 36.279275 81.055061 81.054037 81.055061l864.571964 0c44.777833 0 81.055061-36.278251 81.055061-81.055061C1031.452762 845.10561 995.175534 808.826336 950.397702 808.826336z" p-id="5594" fill="#ffffff"></path></svg>
              </div>
            </div>
          </div>
    </div>
  </div>

</template>

<script lang='ts' setup >
import {useStore} from 'vuex';
import {langType} from '../enum/options';
import { ref } from 'vue'
import {useI18n} from 'vue-i18n';
import {useDark, useToggle} from '@vueuse/core';
import {useRouter} from 'vue-router';
import {computed} from 'vue';

const input = ref('')

const isDark = useDark();
const toggleDark = useToggle(isDark);
const router = useRouter();
const store = useStore();
// 改变语言

type languageType ='zhCn'| 'en'|'zh-tw';
const language = computed<languageType>(() => store.state.language);

const {locale} = useI18n();
const handleSelect = (value: string) => {
  console.log("-> value", value);
}
const handleCommand = (value: string) => {
  locale.value = value;
  store.commit('CHANGE_LANGUAGE', value);
};
const toHome = () =>{
  router.push({name: 'Home'})
};
const toNews = () =>{
  router.push({name: 'News'})
}
</script>
<style lang="less" scoped>

.header-logo{
  font-size:32px;
  font-weight: 700;
  width:72%;
}
.top_center{
  width:167px;
  background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
  border-radius: 24px;
  text-align: center;
  height: 38px;
  line-height:19px;
  padding: 8px 24px;
  margin-top: 17px;
  margin-right: 15px;
}
.menu_icon{
width: 3%;
}
.menu_icon svg{
  margin-top:20px;
  width: 36px;
  height:27px;

}
</style>
