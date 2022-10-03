<template>
  <div class="container">
    <!--标题-->
    <div class="minting_box">
      <div class="title">
        <div class="box">
          <div><img src="@/assets/images/icon_title_minting.png" alt="logo"></div>
          <div class="tit">{{$t('home.mint')}}</div>
        </div>
      </div>
    </div>
    <div class="minting-content mt-10">
      <!-- 觀測站卡片 -->
      <div class="row">
        <!-- 1st -->
        <!-- <div class="col-12 col-sm-6 col-lg-3" v-for="(item,index) in dropsList" :key="index"> -->
          <div class="card-item card-1" >
            <!-- 卡片圖片 -->
            <div class="card-image">
              <!--              <img :src="http + dropsOne?.background" alt="">-->
              <img src="@/assets/images/random_1.png" alt="">
              <!-- <div class="card_icon">
                <div class="icon_list"  @click="toDialog(1,item)"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px">
                </div>
                <div class="icon_list"  @click="toDialog(2,item)"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
              </div> -->
              <!-- <CountDown :count_down_date="item.date"/> -->
            </div>
            <!-- 卡片內文 -->
            <div class="card-text">
              <!-- icon 圖片 -->
              <div class="card-text-icon-wrap">
                <div class="card-icon-img">
                  <!-- <img :src="item.collection_url" alt=""> -->
                </div>
                <p class="heading-B-4 text-white">{{ item.collection }}</p>
              </div>
              <!-- 內文 -->
              <div class="card-text-wrap">
                <p class="card-title text-white">
                  <!-- {{ item.introduction }} -->
                </p>
                <!-- <p class="card-text  text-white">{{$t('home.price')}}{{ item.price }}</p>
                <p class="card-text  text-white">{{$t('home.total')}}{{ item.total }}</p>
                <p class="card-text text-white">{{$t('home.shortTime')}}{{ item.shortTime }}</p> -->
              </div>
              <!-- 卡片icon -->
              <div class="card-footer">
                <!-- social-link -->
                <ul class="social-link-wrap">
                  <!-- icon-group -->
                  <!-- <li class="social-link-item">
                    <div class="social-link-icon" @click="toWebsite(item.website || '')">
                      <img src="@/assets/images/icon_world.png" alt="">
                    </div>
                  </li> -->
                  <!-- icon-map -->
                  <!-- <li class="social-link-item">
                    <div class="social-link-icon" @click="toDiscord(item.discord || '')">
                      <img src="@/assets/images/icon_discord.png" alt="">
                    </div>
                  </li> -->
                  <!-- icon-homepage -->
                  <!-- <li class="social-link-item">
                    <div class="social-link-icon" @click="toTwitter(item.twitter || '')">
                      <img src="@/assets/images/icon_twitter.png" alt="">
                    </div>
                  </li> -->
                  <!-- icon-discord -->
                  <!-- <li class="social-link-item">
                    <div class="social-link-icon" @click="toSchedule(item.schedule || '')">
                      <img src="@/assets/images/icons.png" alt="">
                    </div>
                  </li> -->
                </ul>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- <el-dialog v-model="dialogFormVisible" width="85%"> -->
      <!-- <div class=" d-none d-lg-block col-12" v-if="$store.state.os.isPc">
        <div class="main">
          <div class="main-left">
            <div class="main-img">
              <img :src="dataList?.collection_url" alt="">
            </div>
            <div class="main-name">{{ dataList?.collection }}</div>

            <div class="tab-list">
              <div v-for="(items,index) in List" :key="index" :class="['tag',type===items.value?'active_tag':'']" @click="changeList(items.value)">
                {{items.name}}
              </div>
            </div>
          </div>
          <div class="main-right" v-if="type === 1">{{dataList?.member}}</div>
          <div class="main-right" v-if="type === 2">{{dataList?.roadmap}}</div>
        </div>
      </div> -->
      <!--      &lt;!&ndash; H5 || table&ndash;&gt;-->
      <!-- <div v-else >
        <div class="ipad-main">
          <div class="main-img">
            <img :src="dataList?.collection_url" alt="">
          </div>
          <div class="right">
            <div class="main-name">{{ dataList?.collection }}</div>
            <div class="tags">
              <div v-for="(ite,index) in List" :key="index" :class="['tag',type===ite.value?'active_tag':'']" @click="changeList(ite.value)">
                {{ite.name}}
              </div>
            </div>

          </div>
        </div>
        <div v-if="type === 1">{{dataList?.member}}</div>
        <div  v-if="type === 2">{{dataList?.roadmap}}</div>
      </div> -->

    <!-- </el-dialog> -->
  </div>
</template>

<!-- <script setup lang="ts">

import {computed, onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import {homeApi} from '../../api';
import {useCountdown} from '@utils/time'
import {useStore} from "vuex";
import CountDown from "@components/CountDown.vue";

type IInfo = {
  background:string;
  collection_url: string;
  collection: string;
  introduction: string;
  price: string;
  ori_date: string;
  total: string;
  website?: string;
  discord?: string;
  twitter?: string;
  date: string;
  shortTime:string;
  member:string;
  roadmap:string;
  schedule:string;
}

const router = useRouter();
const type = ref(1);
const dataList = ref<IInfo[] | null>(null);
const List = ref([{name:'成員介紹',value:1},{name:'路線圖',value:2}]);
const changeList = (value:number) =>{
  type.value = value
}
const http = 'http://v2admin.nftotal.io';
const toWebsite = (url: string) => {
  if (url === '') {
    return
  }
  window.open(url)
}
const toSchedule = (url:string) =>{
  if (url === '') {
    return
  }
  window.open(url)
}
const toDiscord = (url: string) => {
  if (url === '') {
    return
  }
  window.open(url)
}
const toTwitter = (url: string) => {
  if (url === '') {
    return
  }
  window.open(url)
}
//弹窗
const dialogFormVisible = ref(false);

const dropsList = ref<IInfo[] | null>(null);
const Lists = ref([])

//弹窗
const toDialog = (val:number,item:Object) =>{
  dialogFormVisible.value = true;
  dataList.value = item;
  type.value = val
}
const durationDateOne = computed(() => {
  const list = Lists.value.forEach((item: { shortTime: any; date: string; }) => {
    item.shortTime = item.date.split(' ')[1]
  })
  if (Lists.value.length > 0) {
    return useCountdown(new Date())
  }
})
const store = useStore()

const getHomeWallet = async () => {
  const res = await homeApi.getDrops({});
  Lists.value = res.data
  const list = res.data.map((item: { shortTime: any; date: string; }) => {
    item.shortTime = item.date.split(' ')[1]
    return item
  })
  dropsList.value = list
}

onMounted(() => {
  getHomeWallet()
})


</script> -->

<!-- <style scoped lang="less">
.ipad-main{
  display: flex;
  padding-bottom: 30px;
  .tags{
    display: flex;
    padding-top:20px;
  }
  .right{
    width: 75%;
    padding-left:10px;
  }
  .main-img{
    width:25%;
  }
  img{
    width: 132px;
    /* height:132px;*/
    border-radius:50%;
  }
}
.tag{
  margin-top: 10px;
}
.tab-list{
  width: 65%;
  margin: auto;
}
:deep  .el-dialog{
  background: rgba(47, 47, 47, 1);
}
.main{
  display: flex;
  height: 50vh;
}
.main-left{
  width:30%;
  text-align: center;
  .main-img{

    width: 196px;
    margin: auto;
    height: 196px;
    img{
      width: 100%;
      height: 100%;
      border-radius: 50%;
    }
  }
  .main-name{
    padding: 30px 0px;
  }
}
.main-right{
  overflow-y: scroll;
  text-indent: 2em;
  width: 68%;
}
/* 设置滚动条的样式 */

.card-icon-img{
  width: 38px;
  height: 38px;
  img{
    width: 100%;
    height: 100%;
    border-radius: 50%;
  }
}
.card_icon{
  width: 50px;
  display: flex;
  position: absolute;
  top:10%;
  left: 10%;
  gap:12px;
  .icon_list{
    width: 50px;
    img{
      width: 24px;
      height: 16.5px;
    }
  }
}
.minting_box{
  display: flex;
  justify-content:space-between;
  margin-top: 82.5px;
}
.minting-content .card-item {
  display: flex;
  flex-direction: column;
  height: 100%;
}

/*----- 卡片圖片 -----*/
.minting-content .card-image {
  width: 100%;
  border-radius: 16px 16px 0px 0px;
  overflow: hidden;
  position: relative;
}

.minting-content .card-image .card-time-wrap {
  display: flex;
  gap: 8px;
  position: absolute;
  top: 40%;
  right: 30%;
}

.minting-content .card-image .card-time-wrap p {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
  color: #FFFFFF;
  padding: 10px;
  border-radius: 8px;
  background-color: #4447E2;
}
.minting-content .card-image .card-time-wrap p {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .minting-content .card-image .card-time-wrap p {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .minting-content .card-image .card-time-wrap p {
    font-size: 18px;
  }
}

/*----- 卡片下方文字區塊 -----*/
/*----- 卡片下方文字 - 容器 -----*/
.minting-content .card-text {
  display: flex;
  flex-direction: column;
  flex: 1;
  background-color: #1C1C24;
  border-radius: 0px 0px 16px 16px;
  padding:6px 16px 0px 16px;
  color:rgba(255, 255, 255, 0.9);
}

/*----- 卡片下方文字 - 文字 -----*/
.minting-content .card-title {
  flex: 1;
}

.minting-content .card-text h3 {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.33;
  letter-spacing: 0;
  -webkit-line-clamp: 2;
}
.minting-content .card-text h3 {
  font-size: 22px;
}
@media screen and (min-width: 768px) {
  .minting-content .card-text h3 {
    font-size: calc(0.78125vw + 16px);
  }
}
@media screen and (min-width: 1536px) {
  .minting-content .card-text h3 {
    font-size: 28px;
  }
}

.minting-content .card-text .card-time {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.375;
  letter-spacing: 0;
}
.minting-content .card-text .card-time {
  font-size: 16px;
}
@media screen and (min-width: 768px) {
  .minting-content .card-text .card-time {
    font-size: calc(0vw + 16px);
  }
}
@media screen and (min-width: 1536px) {
  .minting-content .card-text .card-time {
    font-size: 16px;
  }
}

/*----- 卡片下方文字 - 列表 -----*/
.minting-content .card-text .info-list {
  display: flex;
  flex-wrap: wrap;
}

.minting-content .card-text .info-item:nth-of-type(-1n+2) {
  padding-right: 3.2%;
  border-right: 1px solid #fff;
  margin-right: 3%;
}

.minting-content .card-text .community-icon {
  fill: #FFFFFF;
}

.minting-content .card-text .info-item {
  display: flex;
}

.minting-content .card-text .info-item h4 {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
}
.minting-content .card-text .info-item h4 {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .minting-content .card-text .info-item h4 {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .minting-content .card-text .info-item h4 {
    font-size: 18px;
  }
}

.minting-content .card-text .info-item small {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.66;
  letter-spacing: 0;
}
.minting-content .card-text .info-item small {
  font-size: 12px;
}
@media screen and (min-width: 768px) {
  .minting-content .card-text .info-item small {
    font-size: calc(0vw + 12px);
  }
}
@media screen and (min-width: 1536px) {
  .minting-content .card-text .info-item small {
    font-size: 12px;
  }
}
.card-footer {
  padding: 6px 16px 16px;
  background-color: #1C1C24;
}
.card-footer .social-link-wrap {
  display: flex;
  gap: 24px;
}
.card-footer .social-link-wrap .social-link-icon svg {
  fill: rgba(255, 255, 255, 0.2);
  height: 32px;
  width: 32px;
}

</style> -->