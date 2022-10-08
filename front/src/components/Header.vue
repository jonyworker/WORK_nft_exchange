<template>
  <div class="page">
    <div class="pc_header top-bar-section">
      <div class="container">
        <el-menu
          class="el-menu-demo"
          mode="horizontal"
          :ellipsis="false"
          @select="handleSelect"
        >
          <!-- Header - Logo商標  -->
          <li class="header-logo" index="0" @click="toHome()">
            <svg width="113" height="19" viewBox="0 0 113 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.856 1.2V11.208L6.224 1.2H0.2V18H5.888V8.016L13.52 18H19.544V1.2H13.856ZM39.014 5.088V1.2H22.43V18H28.142V11.784H38.342V7.896H28.142V5.088H39.014ZM59.3536 1.2H40.9456V5.088H47.3056V18H52.9936V5.088H59.3536V1.2ZM67.4913 4.872C63.5313 4.872 59.1153 6.672 59.1153 11.616C59.1153 16.56 63.5313 18.36 67.4913 18.36C71.4273 18.36 75.8433 16.56 75.8433 11.616C75.8433 6.672 71.4273 4.872 67.4913 4.872ZM67.4913 14.952C65.0433 14.952 64.1313 13.344 64.1313 11.616C64.1313 9.888 65.0433 8.28 67.4913 8.28C69.9153 8.28 70.8273 9.888 70.8273 11.616C70.8273 13.344 69.9153 14.952 67.4913 14.952ZM88.1739 8.16V5.208H84.4299V1.896H79.1979V5.208H76.8219V8.16H79.1979V12.888C79.1979 16.704 80.3499 18.216 85.1739 18.216C86.1579 18.216 87.2859 18.144 88.1739 18.024V14.472C85.6059 14.688 84.4299 14.688 84.4299 12.888V8.16H88.1739ZM97.43 4.872C93.278 4.872 90.71 5.976 90.254 9.096H95.03C95.198 8.304 95.582 7.824 97.43 7.824C99.662 7.824 99.878 8.592 99.878 9.816V9.984C91.166 9.504 89.63 11.664 89.63 14.544C89.63 17.064 91.67 18.36 95.294 18.36C97.478 18.36 99.11 17.472 99.878 16.632V18H105.11V9.816C105.11 5.52 101.558 4.872 97.43 4.872ZM99.878 14.352C99.182 15.168 97.958 15.72 96.614 15.72C95.438 15.72 94.718 15.384 94.718 14.424C94.718 12.888 96.686 12.744 99.878 12.888V14.352ZM107.512 0.287999V18H112.744V0.287999H107.512Z" fill="white"/>
            </svg>
          </li>
          <!-- Header - 搜尋列 -->
          <el-menu-item index="9" class="!h-[58px]">
            <el-input class="border-circle" v-model="input" placeholder="搜索NFT和錢包" />
          </el-menu-item>
          <!-- Header - NFT分析 -->
          <el-menu-item index="1" @click="toAnalysis()">{{$t('home.search')}}</el-menu-item>

          <!-- Header - 熱門排行 -->
          <el-menu-item index="" click="">熱門排行</el-menu-item>

          <!-- Header - Minting觀測站 -->
          <el-menu-item index="2" @click="toMinting()">{{$t('home.mint')}}</el-menu-item>

          <!-- 需刪除 - 統計 -->
          <!-- <el-menu-item index="3" @click="toIndex()">{{$t('home.overview')}}</el-menu-item> -->

          <!-- 需刪除 - 工具 -->
          <!-- <el-menu-item index="4">{{$t('home.tool')}}</el-menu-item> -->

          <!-- Header - 新聞＆專欄 -->
          <el-menu-item index="5" @click="toNews(1)">{{$t('home.news')}}</el-menu-item>

          <!-- 需刪除 - 專欄 -->
          <!-- <el-menu-item index="6" @click="toNews(2)">{{$t('home.blog')}}</el-menu-item> -->
          <div class="flex-grow"/>

          <!-- Header - 背景調整 -->
          <el-menu-item index="7" @click="toggleDark(!isDark)">
            {{ $t(isDark ? 'global.dark' : 'global.light') }}
          </el-menu-item>

          <!-- Header - 連結錢包 -->
            <div class="top_center" @click="toWallet()">
              Connect Wallet
            </div>

          <!-- Header - 語言選擇 -->
          <el-sub-menu index="8">
            <template #title>语言 - {{ langType[language] }}</template>
            <el-menu-item index="zhCn" @click="handleCommand('zhCn')">简体中文</el-menu-item>
            <el-menu-item index="zh-tw" @click="handleCommand('zh-tw')">繁體中文</el-menu-item>
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
              <div class="top_center" @click="toWallet()">
                Connect Wallet
              </div>
              <div class="menu_icon" @click="visible = true">
                <svg t="1661333269863" class="icon" viewBox="0 0 1032 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5593" width="200" height="200"><path d="M85.825737 214.431767l864.571964 0c44.777833 0 81.055061-36.291554 81.055061-81.054037 0-44.76146-36.277228-81.053014-81.055061-81.053014L85.825737 52.324716c-44.773739 0-81.054037 36.291554-81.054037 81.053014C4.7717 178.140213 41.051998 214.431767 85.825737 214.431767zM950.397702 430.575526 85.825737 430.575526c-44.773739 0-81.054037 36.278251-81.054037 81.053014 0 44.774763 36.279275 81.053014 81.054037 81.053014l864.571964 0c44.777833 0 81.055061-36.277228 81.055061-81.053014C1031.452762 466.853777 995.175534 430.575526 950.397702 430.575526zM950.397702 808.826336 85.825737 808.826336c-44.773739 0-81.054037 36.279275-81.054037 81.051991 0 44.776809 36.279275 81.055061 81.054037 81.055061l864.571964 0c44.777833 0 81.055061-36.278251 81.055061-81.055061C1031.452762 845.10561 995.175534 808.826336 950.397702 808.826336z" p-id="5594" fill="#ffffff"></path></svg>
              </div>
            </div>
          </div>
    </div>

      <el-drawer v-model="visible" :show-close="false" >

        <div class="drawer">
          <div @click="toAnalysis()">{{$t('home.analysis')}}</div>
          <div @click="toHotItem()">{{$t('home.hot_item')}}</div>
          <div @click="toMinting()">{{$t('home.mint')}}</div>
          <div @click="toNews(1)">{{$t('home.newsBlog')}}</div>
        </div>
        <div index="zhCn" @click="handleCommand('zhCn')">简体中文</div>
        <div index="zh-tw" @click="handleCommand('zh-tw')">繁體中文</div>
        <div index="en" @click="handleCommand('en')">English</div>
        <div class="to-wallet" @click="toWallet()"  >
          Connect Wallet
        </div>
      </el-drawer>
    </div>


</template>

<script lang='ts' setup >
import {langType} from '../enum/lanuage';
import { ElButton, ElDrawer } from 'element-plus'
import { CircleCloseFilled } from '@element-plus/icons-vue'


import { ref } from 'vue'
import {useI18n} from 'vue-i18n';
import {useDark, useToggle} from '@vueuse/core';
import {useRouter} from 'vue-router';
import {computed} from 'vue';
import {useStore} from "vuex";
const input = ref('')
const visible = ref(false)
const isDark = useDark();
const toggleDark = useToggle(isDark);
const router = useRouter();
const store = useStore();
// 改变语言

type languageType ='zhCn'| 'en'|'zh-tw';
const language = computed<languageType>(() => store.state.language);

const {locale} = useI18n();
const handleSelect = (value: string) => {
}
const handleCommand = (value: string) => {
  store.commit('CHANGE_LANGUAGE', value);
  router.go(0);
};
const toAnalysis = () =>{
  router.push({name: 'Analysis'})
}
const toWallet = () =>{
  router.push({name: 'Wallet'})
}

const toHome = () =>{
  router.push({name: 'Home'})
};
const toNews = (value:number) =>{
  router.push({name: 'News',query:{type:value}})
}
const toHotItem = () =>{
  router.push({name: 'HotRanking',query:{type:2}})
}
const toIndex = () =>{
  router.push({name: 'HomePage',})
}
const toMinting = () =>{
  router.push({name:'Minting'})
}
</script>
<style lang="less" scoped>
.drawer{
line-height: 40px;
  font-weight: 700;
  font-size: 17px;
}
:deep  .el-overlay {
  position: fixed;
  top: 0px;
  right: 0px;
  bottom: 0;
  left: 0;
  z-index: 2000;
  height: 100%;
  background-color: rgba(18, 18, 18, 0.85);
  color: #fff;
/*  backdrop-filter: blur(20px);*/
  overflow: auto;
}
:deep  .el-drawer {
  width: 45% !important;
  position: absolute;
  box-sizing: border-box;
  right: 20px !important;
  background-color: var(--el-drawer-bg-color);
  display: flex;
  flex-direction: column;
  box-shadow: var(--el-box-shadow-dark);
  overflow: hidden;
  transition: all var(--el-transition-duration);
}
:deep  .el-drawer__body {
  background:rgba(18, 18, 18, 0.85);
  flex: 1;
  border: 2px solid rgba(255, 255, 255, 0.2);
  padding: var(--el-drawer-padding-primary);
  overflow: auto;
  margin-bottom: 50px;
  border-radius: 10px;
}
.header-logo{
  font-size:32px;
  font-weight: 700;
  width:72%;
}
.to-wallet{
  background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
  border-radius: 24px;
  text-align: center;
  margin-top: 17px;
  height: 32px;
  line-height:28px;

}
.top_center{
  width:167px;
  background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
  border-radius: 24px;
  text-align: center;
  height: 32px;
  line-height:12px;
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
