<template>
  <div class="container">
<!--标题-->
    <div class="minting_box">
      <div class="title">
        <div class="box">
          <div><img src="@/assets/images/icon_title_minting.png" alt="logo"></div>
          <div class="tit">Minting 觀測站</div>
        </div>
      </div>
      <div class="subtitle">前往查看</div>
    </div>
    <div class="minting-content mt-10">
      <!-- 觀測站卡片 -->
      <div class="row">
        <!-- 1st -->
        <div class="col-12 col-sm-6 col-lg-3">
          <div class="card-item card-1">
            <!-- 卡片圖片 -->
            <div class="card-image">
              <img src="@/assets/images/random_1.png" alt="">
              <div class="card_icon">
                <div class="icon_list"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px">
                </div>
                <div class="icon_list"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
              </div>
              <div class="card-time-wrap">
                <p class="count-down-day">{{ durationDate.days }}</p>
                <p class="count-down-hour">{{ durationDate.hours }}</p>
                <p class="count-down-min">{{ durationDate.minutes }}</p>
                <p class="count-down-sec">{{ durationDate.seconds }}</p>
              </div>
            </div>
            <!-- 卡片內文 -->
            <div class="card-text">
              <!-- icon 圖片 -->
              <div class="card-text-icon-wrap">
                <div class="card-icon-img">
                  <img :src="dropsOne?.collection_url" alt="">
                </div>
                <p class="heading-B-4 text-white">{{ dropsOne?.collection }}</p>
              </div>
              <!-- 內文 -->
              <div class="card-text-wrap">
                <p class="card-title text-white">
                  {{ dropsOne?.introduction }}
                </p>
                <p class="card-text  text-white">售價：{{ dropsOne?.price }}</p>
                <p class="card-text  text-white">總量：{{ dropsOne?.total }}</p>
                <p class="card-text text-white">時間：{{ (dropsOne?.date).split(' ')[1] }}</p>
              </div>
              <!-- 卡片icon -->
              <div class="card-footer">
                <!-- social-link -->
                <ul class="social-link-wrap">
                  <!-- icon-group -->
                  <li class="social-link-item">
                    <div class="social-link-icon" @click="toWebsite(dropsOne?.website || '')">
                      <img src="@/assets/images/icon_world.png" alt="">
                    </div>
                  </li>
                  <!-- icon-map -->
                  <li class="social-link-item">
                    <div class="social-link-icon" @click="toDiscord(dropsOne?.discord || '')">
                      <img src="@/assets/images/icon_discord.png" alt="">
                    </div>
                  </li>
                  <!-- icon-homepage -->
                  <li class="social-link-item">
                    <div class="social-link-icon" @click="toTwitter(dropsOne?.twitter || '')">
                      <img src="@/assets/images/icon_twitter.png" alt="">
                    </div>
                  </li>
                  <!-- icon-discord -->
                  <li class="social-link-item">
                    <div class="social-link-icon">
                      <img src="@/assets/images/icons.png" alt="">
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- 2nd -->
          <div class="d-none d-sm-block col-sm-6 col-lg-3" >
          <div class="card-item card-1">
            <!-- 卡片圖片 -->
            <div class="card-image">
              <img src="@/assets/images/random_2.png" alt="">
              <div class="card_icon">
                <div class="icon_list"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px">
                </div>
                <div class="icon_list"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
              </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">{{ durationDateTwo.days }}</p>
                    <p class="count-down-hour">{{ durationDateTwo.hours }}</p>
                    <p class="count-down-min">{{ durationDateTwo.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateTwo.seconds }}</p>
                  </div>
                </div>
                <!-- 卡片內文 -->
                <div class="card-text">
                  <!-- icon 圖片 -->
                  <div class="card-text-icon-wrap">
                    <div class="card-icon-img">
                      <img :src="dropsTwo?.collection_url" alt="">
                    </div>
                    <p class="heading-B-4 text-white">{{dropsTwo?.collection}}</p>
                  </div>
                  <!-- 內文 -->
                  <div class="card-text-wrap">
                    <p class="card-title text-white">
                      {{dropsTwo?.introduction}}
                    </p>
                    <p class="card-text  text-white">售價：{{dropsTwo?.price}}</p>
                    <p class="card-text  text-white">總量：{{dropsTwo?.total}}</p>
                    <p class="card-text text-white">時間：{{(dropsTwo?.date).split(' ')[1]}}</p>
                  </div>
                  <!-- 卡片icon -->
                  <div class="card-footer">
                    <!-- social-link -->
                    <ul class="social-link-wrap">
                      <!-- icon-group -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toWebsite(dropsTwo?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toDiscord(dropsTwo?.discord ||'')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toTwitter(dropsTwo?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="social-link-item">
                        <div class="social-link-icon">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- 3rd -->
            <div class="d-none d-lg-block col-lg-3" v-for="(item,index) in dropsFree" :key="index">
              <div class="card-item card-1">
                <!-- 卡片主圖 -->
                <div class="card-image">
                  <img src="@/assets/images/random_3.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px"></div>
                    <div class="icon_list"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">{{ durationDateFree.days }}</p>
                    <p class="count-down-hour">{{ durationDateFree.hours }}</p>
                    <p class="count-down-min">{{ durationDateFree.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateFree.seconds }}</p>
                  </div>
                </div>
                <!-- 卡片內文 -->
                <div class="card-text">
                  <!-- icon 圖片 -->
                  <div class="card-text-icon-wrap">
                    <div class="card-icon-img">
                      <img :src="item.collection_url" alt="">
                    </div>
                    <p class="heading-B-4 text-white">{{item.collection}}</p>
                  </div>
                  <!-- 內文 -->
                  <div class="card-text-wrap">
                    <p class="card-title text-white">
                      {{item.introduction}}
                    </p>
                    <p class="card-text  text-white">售價：{{item.price}}</p>
                    <p class="card-text  text-white">總量：{{item.total}}</p>
                    <p class="card-text text-white">時間：{{(item.date).split(' ')[1]}}</p>
                  </div>
                  <!-- 卡片icon -->
                  <div class="card-footer">
                    <!-- social-link -->
                    <ul class="social-link-wrap">
                      <!-- icon-group -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toWebsite(item.website|| '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toDiscord(item.discord ||'')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toTwitter(item.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="social-link-item">
                        <div class="social-link-icon">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 前往查看按鈕 (手機顯示) -->
          <div class="mt-10">
            <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none">前往查看</div>
          </div>
        </div>
  </div>
</template>

<script setup lang="ts">
import {onMounted, ref, watch} from "vue";
import {useRouter} from 'vue-router';
import {homeApi} from '../../api';
import {IDuringDate, initDuration} from '@utils/time'
import moment from "moment";


const router = useRouter();
const toWebsite = (url: string) => {
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
type IInfo ={
  collection_url:string;
  collection:string;
  introduction:string;
  price:string;
  ori_date:string;
  total:string;
  website?:string ;
  discord?:string;
  twitter?:string;
  date:string;
}
const dropsOne = ref<IInfo|null>(null);
const dropsTwo = ref<IInfo|null> (null);
const dropsFree = ref<IInfo|null>(null)
const dropsForce = ref<IInfo|null>(null)
const getHomeWallet =async()=>{
  const res = await homeApi.getDrops({});
  dropsOne.value = res.data[0]
  dropsTwo.value = res.data[1]
  dropsFree.value = res.data.slice(2, 4)
  dropsForce.value = res.data[3]
}

onMounted(() => {
  getHomeWallet()
})

const durationDate = ref<IDuringDate>(initDuration);
const durationDateTwo = ref<IDuringDate>(initDuration);
const durationDateFree = ref<IDuringDate>(initDuration);
const timer: any = ref<number>()
const buildTimer = (date: Date) => {
  return setInterval(() => {
    const now = new Date()
    if (moment(date).isBefore(now, 'seconds')) {
      durationDate.value = initDuration;
      timer.value && clearInterval(timer.value)
      return
    }
    const endTime = moment(date).unix()
    const nowTime = moment(now).unix()
    const during = moment.duration(endTime - nowTime, 'seconds');
    durationDate.value = {
      months: during.months(),
      days: during.days(),
      hours: during.hours(),
      minutes: during.minutes(),
      seconds: during.seconds()
    }
  }, 1000)
}
watch(dropsOne, (value) => {
  if (value) {
    timer.value = buildTimer(value.date ? new Date(value.date) : new Date())
  }
}, {deep: true});
const buildTimers = (date: Date) => {
  return setInterval(() => {
    const now = new Date()
    if (moment(date).isBefore(now, 'seconds')) {
      durationDateFree.value = initDuration;
      timer.value && clearInterval(timer.value)
      return
    }
    const endTime = moment(date).unix()
    const nowTime = moment(now).unix()
    const during = moment.duration(endTime - nowTime, 'seconds');
    durationDateFree.value = {
      months: during.months(),
      days: during.days(),
      hours: during.hours(),
      minutes: during.minutes(),
      seconds: during.seconds()
    }
  }, 1000)
}
watch(dropsFree, (value) => {
  if (value) {
    timer.value = buildTimers(value.date ? new Date(value.date) : new Date())
  }
}, {deep: true})
const buildTimerList = (date: Date) => {
  return setInterval(() => {
    const now = new Date()
    if (moment(date).isBefore(now, 'seconds')) {
      durationDateTwo.value = initDuration;
      timer.value && clearInterval(timer.value)
      return
    }
    const endTime = moment(date).unix()
    const nowTime = moment(now).unix()
    const during = moment.duration(endTime - nowTime, 'seconds');
    durationDateTwo.value = {
      months: during.months(),
      days: during.days(),
      hours: during.hours(),
      minutes: during.minutes(),
      seconds: during.seconds()
    }
  }, 1000)
}
watch(dropsTwo, (value) => {
  if (value) {
    timer.value = buildTimerList(value.date ? new Date(value.date) : new Date())
  }
}, {deep: true})

</script>

<style scoped lang="less">
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
  right: 80px;
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

</style>