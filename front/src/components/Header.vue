<template>
  <div class="page">

    <!-- 裝置大於1530px以上時顯示 -->
    <div class="pc_header top-bar-section">
      <div class="container">
        <el-menu
          style="border-bottom: none;"
          class="el-menu-demo align-items-center"
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
          <li class="header-search main" index="9">
            <div class="header-search-wrap">
              <!-- search - icon -->
              <div class="icon icon-search">
                <svg id="zoom-in-alt" data-name="Line color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon line-color" width="48" height="48"><path id="primary" d="M19,11a8,8,0,1,1-8-8A8,8,0,0,1,19,11Zm2,10-4.34-4.34" style="fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path><path id="secondary" d="M11,14V8M8,11h6" style="fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path></svg>
              </div>
              <!-- search - input -->
              <input v-model="input" type="search" :placeholder="$t('home.searchWallet')">
            </div>
          </li>


          <!-- Header - 熱門排行 -->
          <el-menu-item class="body-B-1 hover-primary" style="padding: 0 16px" index="" @click="toHotItem()">{{$t('home.hot_item')}}</el-menu-item>

          <!-- Header - 高勝率錢包 -->
          <el-menu-item class="body-B-1 hover-primary" style="padding: 0 16px" index="1" @click="toHotRanking()">{{$t('home.highWinningWallet')}}</el-menu-item>

          <!-- Header - Minting觀測站 -->
          <el-menu-item class="body-B-1 hover-primary" style="padding: 0 16px" index="2" @click="toMinting()">{{$t('home.mint')}}</el-menu-item>

          <!-- Header - 新聞＆專欄 -->
          <el-menu-item class="body-B-1 hover-primary" style="padding: 0 16px" index="5" @click="toNews(1)">{{$t('home.news')}}</el-menu-item>

          <!-- Header - 背景調整 -->
<!--          <el-menu-item index="7" @click="toggleDark(!isDark)">-->
<!--            {{ $t(isDark ? 'global.dark' : 'global.light') }}-->
<!--          </el-menu-item>-->

          <!-- Header - 連結錢包 v-if="status !== 'OK'"-->

          <div class="ml-auto">
            <div class="connectWallet" @click="toWallet()" v-if="!isLogin">Connect Wallet</div>
            <div class="login ml-auto" v-else @click="logout()"></div>
          </div>


          <!-- Header - 語言選擇 -->
          <el-sub-menu class="body-B-1" style="margin-right: -20px;" index="8">
            <template #title >{{ langType[language] }}</template>
            <el-menu-item class="body-B-1" index="zhCn" @click="handleCommand('zhCn')">简体中文</el-menu-item>
            <el-menu-item class="body-B-1" index="zh-tw" @click="handleCommand('zh-tw')">繁體中文</el-menu-item>
            <el-menu-item class="body-B-1" index="en" @click="handleCommand('en')">English</el-menu-item>
          </el-sub-menu>

        </el-menu>
      </div>
    </div>

    <!-- 裝置介於 768px 以下時顯示 -->
    <div class="middle_header top-bar-section">
      <div class="container">
        <div class="top-bar-content">
          <div class="header-logo" @click="toHome()">
            <svg width="113" height="19" viewBox="0 0 113 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.856 1.2V11.208L6.224 1.2H0.2V18H5.888V8.016L13.52 18H19.544V1.2H13.856ZM39.014 5.088V1.2H22.43V18H28.142V11.784H38.342V7.896H28.142V5.088H39.014ZM59.3536 1.2H40.9456V5.088H47.3056V18H52.9936V5.088H59.3536V1.2ZM67.4913 4.872C63.5313 4.872 59.1153 6.672 59.1153 11.616C59.1153 16.56 63.5313 18.36 67.4913 18.36C71.4273 18.36 75.8433 16.56 75.8433 11.616C75.8433 6.672 71.4273 4.872 67.4913 4.872ZM67.4913 14.952C65.0433 14.952 64.1313 13.344 64.1313 11.616C64.1313 9.888 65.0433 8.28 67.4913 8.28C69.9153 8.28 70.8273 9.888 70.8273 11.616C70.8273 13.344 69.9153 14.952 67.4913 14.952ZM88.1739 8.16V5.208H84.4299V1.896H79.1979V5.208H76.8219V8.16H79.1979V12.888C79.1979 16.704 80.3499 18.216 85.1739 18.216C86.1579 18.216 87.2859 18.144 88.1739 18.024V14.472C85.6059 14.688 84.4299 14.688 84.4299 12.888V8.16H88.1739ZM97.43 4.872C93.278 4.872 90.71 5.976 90.254 9.096H95.03C95.198 8.304 95.582 7.824 97.43 7.824C99.662 7.824 99.878 8.592 99.878 9.816V9.984C91.166 9.504 89.63 11.664 89.63 14.544C89.63 17.064 91.67 18.36 95.294 18.36C97.478 18.36 99.11 17.472 99.878 16.632V18H105.11V9.816C105.11 5.52 101.558 4.872 97.43 4.872ZM99.878 14.352C99.182 15.168 97.958 15.72 96.614 15.72C95.438 15.72 94.718 15.384 94.718 14.424C94.718 12.888 96.686 12.744 99.878 12.888V14.352ZM107.512 0.287999V18H112.744V0.287999H107.512Z" fill="white"/>
            </svg>
          </div>
          <!-- Header - 搜尋列 -->
          <div class="header-search main" index="9">
            <div class="header-search-wrap">
              <!-- search - icon -->
              <div class="icon icon-search">
                <svg id="zoom-in-alt" data-name="Line color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon line-color" width="48" height="48"><path id="primary" d="M19,11a8,8,0,1,1-8-8A8,8,0,0,1,19,11Zm2,10-4.34-4.34" style="fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path><path id="secondary" d="M11,14V8M8,11h6" style="fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path></svg>
              </div>
              <!-- search - input -->
              <input v-model="input" type="search" placeholder="搜索NFT和錢包">
            </div>
          </div>
          <!-- Header - Minting觀測站 -->
          <div class="connectWallet ml-auto mr-20" @click="toWallet()" v-if="!isLogin">
            middle
          </div>
          <div class="login ml-auto" v-else @click="logout()" style="margin-right:10px;"></div>
          <div class="burger-toggle" @click="visible = true">
            <div class="icon icon-burger">
              <svg t="1661333269863" class="icon" viewBox="0 0 1032 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5593" width="36px" height="36px"><path d="M85.825737 214.431767l864.571964 0c44.777833 0 81.055061-36.291554 81.055061-81.054037 0-44.76146-36.277228-81.053014-81.055061-81.053014L85.825737 52.324716c-44.773739 0-81.054037 36.291554-81.054037 81.053014C4.7717 178.140213 41.051998 214.431767 85.825737 214.431767zM950.397702 430.575526 85.825737 430.575526c-44.773739 0-81.054037 36.278251-81.054037 81.053014 0 44.774763 36.279275 81.053014 81.054037 81.053014l864.571964 0c44.777833 0 81.055061-36.277228 81.055061-81.053014C1031.452762 466.853777 995.175534 430.575526 950.397702 430.575526zM950.397702 808.826336 85.825737 808.826336c-44.773739 0-81.054037 36.279275-81.054037 81.051991 0 44.776809 36.279275 81.055061 81.054037 81.055061l864.571964 0c44.777833 0 81.055061-36.278251 81.055061-81.055061C1031.452762 845.10561 995.175534 808.826336 950.397702 808.826336z" p-id="5594" fill="#ffffff"></path></svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 裝置介於 768px 以下時顯示 -->
    <div class="small_header top-bar-section">
      <div class="container">
        <div class="top-bar-content">
          <div class="header-logo" @click="toHome()">
            <svg width="113" height="19" viewBox="0 0 113 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.856 1.2V11.208L6.224 1.2H0.2V18H5.888V8.016L13.52 18H19.544V1.2H13.856ZM39.014 5.088V1.2H22.43V18H28.142V11.784H38.342V7.896H28.142V5.088H39.014ZM59.3536 1.2H40.9456V5.088H47.3056V18H52.9936V5.088H59.3536V1.2ZM67.4913 4.872C63.5313 4.872 59.1153 6.672 59.1153 11.616C59.1153 16.56 63.5313 18.36 67.4913 18.36C71.4273 18.36 75.8433 16.56 75.8433 11.616C75.8433 6.672 71.4273 4.872 67.4913 4.872ZM67.4913 14.952C65.0433 14.952 64.1313 13.344 64.1313 11.616C64.1313 9.888 65.0433 8.28 67.4913 8.28C69.9153 8.28 70.8273 9.888 70.8273 11.616C70.8273 13.344 69.9153 14.952 67.4913 14.952ZM88.1739 8.16V5.208H84.4299V1.896H79.1979V5.208H76.8219V8.16H79.1979V12.888C79.1979 16.704 80.3499 18.216 85.1739 18.216C86.1579 18.216 87.2859 18.144 88.1739 18.024V14.472C85.6059 14.688 84.4299 14.688 84.4299 12.888V8.16H88.1739ZM97.43 4.872C93.278 4.872 90.71 5.976 90.254 9.096H95.03C95.198 8.304 95.582 7.824 97.43 7.824C99.662 7.824 99.878 8.592 99.878 9.816V9.984C91.166 9.504 89.63 11.664 89.63 14.544C89.63 17.064 91.67 18.36 95.294 18.36C97.478 18.36 99.11 17.472 99.878 16.632V18H105.11V9.816C105.11 5.52 101.558 4.872 97.43 4.872ZM99.878 14.352C99.182 15.168 97.958 15.72 96.614 15.72C95.438 15.72 94.718 15.384 94.718 14.424C94.718 12.888 96.686 12.744 99.878 12.888V14.352ZM107.512 0.287999V18H112.744V0.287999H107.512Z" fill="white"/>
            </svg>
          </div>
          <!-- Header - Minting觀測站 -->
          <div class="connectWallet ml-auto mr-20" @click="toWallet()" v-if="!isLogin">
            small
          </div>
          <div class="login ml-auto" v-else @click="logout()" style="margin-right:10px;"></div>
          <div class="burger-toggle" @click="visible = true">
            <div class="icon icon-burger">
              <svg t="1661333269863" class="icon" viewBox="0 0 1032 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="5593" width="36px" height="36px"><path d="M85.825737 214.431767l864.571964 0c44.777833 0 81.055061-36.291554 81.055061-81.054037 0-44.76146-36.277228-81.053014-81.055061-81.053014L85.825737 52.324716c-44.773739 0-81.054037 36.291554-81.054037 81.053014C4.7717 178.140213 41.051998 214.431767 85.825737 214.431767zM950.397702 430.575526 85.825737 430.575526c-44.773739 0-81.054037 36.278251-81.054037 81.053014 0 44.774763 36.279275 81.053014 81.054037 81.053014l864.571964 0c44.777833 0 81.055061-36.277228 81.055061-81.053014C1031.452762 466.853777 995.175534 430.575526 950.397702 430.575526zM950.397702 808.826336 85.825737 808.826336c-44.773739 0-81.054037 36.279275-81.054037 81.051991 0 44.776809 36.279275 81.055061 81.054037 81.055061l864.571964 0c44.777833 0 81.055061-36.278251 81.055061-81.055061C1031.452762 845.10561 995.175534 808.826336 950.397702 808.826336z" p-id="5594" fill="#ffffff"></path></svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 彈出選單 -->
    <!-- 彈出-會員登入頁 -->
    <el-drawer v-model="visibleLogout" :show-close="false" >
      <div class="drawer">
        <div class="heading-B-3 mb-md-16 mb-8" @click="toAnalysis(1)">追蹤項目</div>
        <div class="heading-B-3 mb-md-16 mb-8" @click="toAnalysis(2)">追蹤 NFT</div>
        <div class="heading-B-3" @click="goto('Personal')">個人資料編輯</div>
      </div>
      <div class="mt-auto">
        <div class="connectWallet justify-content-center" @click="toLogout()"  >
          登出
        </div>
      </div>
    </el-drawer>

    <!-- 彈出-漢堡選單 -->
    <el-drawer v-model="visible" :show-close="false" >
      <!-- 頭像 -->
      <div class="d-flex mb-24">
        <div class="login mr-8" v-if="!isLogin" @click="visibleLogout === true"></div>
        <div class="d-flex flex-column">
          <div class="caption-L-1 mr-24" style="color: rgba(255, 255, 255, 0.7);">使用者自訂名稱</div>
          <!-- 錢包地址 -->
          <div class="d-flex align-items-center mt-lg-0">
            <div class="caption-L-1 clamp-single" style="width: 130px; color: rgba(255, 255, 255, 0.7);">0xe9fe2d2a2385a90e3aaceb600ec75154f46abd4f</div>
            <div class="icon icon-copy ml-8" style="fill: rgba(255, 255, 255, 0.7);">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"><path d="M9 18q-.825 0-1.412-.587Q7 16.825 7 16V4q0-.825.588-1.413Q8.175 2 9 2h9q.825 0 1.413.587Q20 3.175 20 4v12q0 .825-.587 1.413Q18.825 18 18 18Zm0-2h9V4H9v12Zm-4 6q-.825 0-1.413-.587Q3 20.825 3 20V7q0-.425.288-.713Q3.575 6 4 6t.713.287Q5 6.575 5 7v13h10q.425 0 .713.288.287.287.287.712t-.287.712Q15.425 22 15 22ZM9 4v12V4Z"/></svg>
              <!-- <svg id="zoom-in-alt" data-name="Line color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon line-color" width="48" height="48"><path id="primary" d="M19,11a8,8,0,1,1-8-8A8,8,0,0,1,19,11Zm2,10-4.34-4.34" style="fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path><path id="secondary" d="M11,14V8M8,11h6" style="fill: none; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path></svg> -->
            </div>
          </div>
        </div>
      </div>
      <!-- 選單 -->
      <div class="drawer">
        <!-- 熱門排行 -->
        <div class="heading-B-3 mb-md-16 mb-8" @click="toHotItem()">{{$t('home.hot_item')}}</div>
        <!-- 高勝率錢包 -->
        <div class="heading-B-3 mb-md-16 mb-8" @click="toHotRanking()">{{$t('home.highWinningWallet')}}</div>
        <!-- minting觀測站 -->
        <div class="heading-B-3 mb-md-16 mb-8" @click="toMinting()">{{$t('home.mint')}}</div>
        <!-- 新聞&專欄 -->
        <div class="heading-B-3 mb-24" @click="toNews(1)">{{$t('home.newsBlog')}}</div>
      </div>
      <div class="heading-B-5 mb-12" index="zhCn" @click="handleCommand('zhCn')">简体中文</div>
      <div class="heading-B-5 mb-12" index="zh-tw" @click="handleCommand('zh-tw')">繁體中文</div>
      <div class="heading-B-5" index="en" @click="handleCommand('en')">English</div>

      <div class="mt-auto">
        <div class="connectWallet justify-content-center" @click="toWallet()"  v-if="!isLogin">
          Connect Wallet
        </div>
        <div class="connectWallet justify-content-center" @click="toWallet()"  v-if="isLogin">
          登出
        </div>
      </div>
    </el-drawer>

  </div>

</template>

<script lang='ts' setup >
import {langType} from '../enum/lanuage';
import { ElButton, ElDrawer } from 'element-plus'
import { CircleCloseFilled } from '@element-plus/icons-vue'
import {homeApi} from "@/api";

import { ref } from 'vue'
import {useI18n} from 'vue-i18n';
import {useDark, useToggle} from '@vueuse/core';
import {useRouter} from 'vue-router';
import {computed} from 'vue';
import {useStore} from "vuex";
const input = ref('')
const visible = ref(false);
const visibleLogout = ref(false);
const isDark = useDark();
const toggleDark = useToggle(isDark);
const router = useRouter();
const store = useStore();
const isLogin = computed<languageType>(() => store.state.isLogin);
// 改变语言
const goto =(pathName:string,query?:Record<string, any>)=>{
  const pushParams ={name: pathName,...(query??{})}
  visibleLogout.value=false
  router.push(pushParams)
}
type languageType ='zhCn'| 'en'|'zh-tw';
const language = computed<languageType>(() => store.state.language);

const {locale} = useI18n();
const handleSelect = (value: string) => {
}
const toHot = () =>{
  router.push({name: 'HotRanking',query:{type:2}})
}

const handleCommand = (value: string) => {
  store.commit('CHANGE_LANGUAGE', value);
  router.go(0);
};
const toAnalysis = (type:number) =>{
  router.push({name: 'Analysis',query:{type:type}});
  visibleLogout.value = false
  visible.value = false
}

const logout = () =>{
  visibleLogout.value = true
  visible.value = false
}
//退出登录
const toLogout = async() =>{
  const res = await homeApi.postLogout({})
  if(res.status){
    store.commit('changeLoginStatus',false)
    localStorage.removeItem('token');
  }
  visibleLogout.value = false
  visible.value = false
}
const toHotRanking = () =>{
  /*router.push({name: 'Analysis'})*/
  router.push({name: 'HotRanking',query:{type:2}})
}
const toWallet = () =>{
  router.push({name: 'Login'})
}

const toHome = () =>{
  router.push({name: 'Home'})
};
const toNews = (value:number) =>{
  router.push({name: 'News',query:{type:value}})
}
const toHotItem = () =>{
  router.push({name: 'HotRanking',query:{type:1}})
}
const toIndex = () =>{
  router.push({name: 'HomePage',})
}
const toMinting = () =>{
  router.push({name:'Minting'})
}
</script>
<style lang="less" scoped>

  /* main nav hover效果 開始*/
  :deep .el-menu--horizontal .el-menu-item:not(.is-disabled):hover {
    background-color: #FFFFFF1A;
  }
  :deep .el-menu--horizontal>.el-menu-item.is-active {
    border-bottom: 2px solid #4447E2;
    color: #4447E2 !important;
  }
  :deep .el-menu--horizontal .el-menu-item:not(.is-disabled):focus, .el-menu--horizontal .el-menu-item:not(.is-disabled):hover,
  .el-menu--horizontal>.el-menu-item:not(.is-disabled):focus {
      background-color: none;
  }
  /* main nav hover效果 結束*/





:deep .el-menu {
  background:#121212 !important;
  color:#FFF !important;
}
:deep .el-sub-menu__title{
  color:#FFF !important;
}
:deep .el-sub-menu__title:hover{
  background:#121212 !important;
  color:#FFF !important;
}
:deep .el-menu-item{
  color:#FFF !important;
}
  .login{
    width:40px;
    height:40px;
    border-radius: 50%;
    background: #D9D9D9;
  }
  .drawer{
    line-height: 40px;
    font-weight: 700;
    font-size: 17px;
  }
  :deep .el-overlay {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 2000;
    height: 100%;
    background-color: rgba(18, 18, 18, 0.10);
    color: #fff;
    backdrop-filter: blur(8px);
    overflow: auto;
  }
  :deep .el-drawer {
    width: 327px !important;
    right: 24px !important;
    position: absolute;
    box-sizing: border-box;
    // display: flex;
    // flex-direction: column;
    background: none;
    box-shadow: none; 
    overflow: hidden;
    transition: all var(--el-transition-duration);
  }
  :deep .el-drawer__header {
    display: none;
  }
  :deep .el-drawer__body {
    background:rgba(18, 18, 18, 0.9);
    backdrop-filter: blur(2px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    height: 100%;
    padding: 24px;
    overflow: auto;
    margin: 24px 0px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
  }
  :deep .el-drawer__body .heading-B-3 {
    color: rgba(255, 255, 255, 0.9);
  }
  :deep .el-drawer__body .heading-B-5 {
    color: rgba(255, 255, 255, 0.7);
  }
// .header-logo{
//   font-size:32px;
//   font-weight: 700;
//   width:72%;
// }
  .to-wallet{
    background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
    border-radius: 24px;
    text-align: center;
    // margin-top: 17px;
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
    margin-top: 12px;
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
  .connectWallet {
    cursor: pointer;
  }
</style>
