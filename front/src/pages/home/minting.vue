<template>
  <div class="minting-section section mb-80">
    <div class="container">
      <div class="content">
        <!--區域標題-->
        <div class="row mb-40">
          <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="section-title-wrap">
              <div class="title-icon">
                <img src="@/assets/images/icon_title_minting.png" alt="logo">
              </div>
              <h2 class="section-title color-white">{{$t('home.mint')}}</h2>
            </div>
    
            <!-- 前往查看按鈕 -->
            <div class="d-none d-sm-block">
              <button class="btn btn-bold btn-outline" @click="toView()">{{$t('home.toView')}}</button>
            </div>
          </div>
        </div>
    
        <!-- 卡片 -->
        <div class="minting-content mt-10">
          <!-- 觀測站卡片 -->
          <div class="row">
            <!-- 1st -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsOne?.background" alt="">-->
                  <img src="@/assets/images/random_1.png" alt="">
                  <div class="card-icon-group">
                    <div class="i-group i-alpha-60 square-28"  @click="toDailog(1)"></div>
                    <div class="i-map i-alpha-60 square-28"  @click="toDailog(2)"></div>
                  </div>
                  <div class="card-time-wrap color-white" v-if="durationDateOne?.value?.days && durationDateOne?.value?.hours && durationDateOne?.value?.minutes && durationDateOne?.value?.seconds !== 0">
                    <p class="count-down-day">{{ durationDateOne?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateOne?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateOne?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateOne?.value?.seconds }}</p>
                  </div>

                  <div class="card-time-wrap color-white" v-else>
                    <p class="count-down-day">-</p>
                    <p class="count-down-hour">-</p>
                    <p class="count-down-min">-</p>
                    <p class="count-down-sec">-</p>
                  </div>
                  
                  

                </div>
                <!-- 卡片內文 -->
                <div class="card-body-content p-16">

                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap align-items-center mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsOne?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsOne?.collection }}</p>
                  </div>
                  <!-- 卡片 - 文字 -->
                  <p class="card-text-p clamp-3 mb-8" v-html="dropsOne?.introduction"></p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsOne?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsOne?.total }}</p>
                  <p class="card-text-p mb-24" v-if="dropsOne?.date != null">{{$t('home.shortTime')}}{{ dropsOne?.date }}</p>
                  <p class="card-text-p mb-24" v-else >{{$t('home.shortTime')}}--</p>
                  
                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="i-earth i-alpha-20 square-28" @click="toWebsite(dropsOne?.website || '')"></div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="i-discord i-alpha-20 square-28" @click="toDiscord(dropsOne?.discord || '')"></div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="i-twitter i-alpha-20 square-28" @click="toTwitter(dropsOne?.twitter || '')"></div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="i-event i-alpha-20 square-28" @click="toSchedule(dropsOne?.schedule || '')"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- 2nd -->
            <div class="d-none d-sm-block col-sm-6 col-lg-3" >
              <div class="card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsTwo?.background" alt="">-->
                  <img src="@/assets/images/random_2.png" alt="">
                  <div class="card-icon-group">
                    <div class="i-group i-alpha-60 square-28"  @click="toDailog(1)"></div>
                    <div class="i-map i-alpha-60 square-28"  @click="toDailog(2)"></div>
                  </div>
                
                  <div class="card-time-wrap color-white" v-if="durationDateTwo?.value?.days && durationDateTwo?.value?.hours && durationDateTwo?.value?.minutes && durationDateTwo?.value?.seconds !== 0">
                    <p class="count-down-day">{{ durationDateTwo?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateTwo?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateTwo?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateTwo?.value?.seconds }}</p>
                  </div>

                  <div class="card-time-wrap color-white" v-else>
                    <p class="count-down-day">-</p>
                    <p class="count-down-hour">-</p>
                    <p class="count-down-min">-</p>
                    <p class="count-down-sec">-</p>
                  </div>



                </div>
                <!-- card - body -->
                <div class="card-body-content p-16">
                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap align-items-center mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsTwo?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsTwo?.collection }}</p>
                  </div>

                  <!-- 卡片 - 文字 -->
                  
                  <p class="card-text-p clamp-3 mb-8" v-html="dropsTwo?.introduction"></p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsTwo?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsTwo?.total }}</p>
                  <p class="card-text-p mb-24">{{$t('home.shortTime')}}{{ dropsTwo?.date }}</p>

                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="i-earth i-alpha-20 square-28" @click="toWebsite(dropsTwo?.website || '')"></div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="i-discord i-alpha-20 square-28" @click="toDiscord(dropsTwo?.discord || '')"></div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="i-twitter i-alpha-20 square-28" @click="toTwitter(dropsTwo?.twitter || '')"></div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="i-event i-alpha-20 square-28" @click="toSchedule(dropsTwo?.schedule || '')"></div>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
            </div>

            <!-- 3rd -->
            <div class="d-none d-lg-block col-lg-3">
              <div class="card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsThree?.background" alt="">-->
                  <img src="@/assets/images/random_3.png" alt="">
                  <div class="card-icon-group">
                    <div class="i-group i-alpha-60 square-28"  @click="toDailog(1)"></div>
                    <div class="i-map i-alpha-60 square-28"  @click="toDailog(2)"></div>
                  </div>
                
                  <div class="card-time-wrap color-white" v-if="durationDateThree?.value?.days && durationDateThree?.value?.hours && durationDateThree?.value?.minutes && durationDateThree?.value?.seconds !== 0">
                    <p class="count-down-day">{{ durationDateThree?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateThree?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateThree?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateThree?.value?.seconds }}</p>
                  </div>

                  <div class="card-time-wrap color-white" v-else>
                    <p class="count-down-day">-</p>
                    <p class="count-down-hour">-</p>
                    <p class="count-down-min">-</p>
                    <p class="count-down-sec">-</p>
                  </div>




                </div>
                <!-- card - body -->
                <div class="card-body-content p-16">

                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap align-items-center mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsThree?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsThree?.collection }}</p>
                  </div>

                  <!-- 卡片 - 文字 -->
                  <p class="card-text-p clamp-3 mb-8" v-html="dropsThree?.introduction"></p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsThree?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsThree?.total }}</p>
                  <p class="card-text-p mb-24">{{$t('home.shortTime')}}{{ dropsThree?.date }}</p>

                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="i-earth i-alpha-20 square-28" @click="toWebsite(dropsThree?.website || '')"></div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="i-discord i-alpha-20 square-28" @click="toDiscord(dropsThree?.discord || '')"></div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="i-twitter i-alpha-20 square-28" @click="toTwitter(dropsThree?.twitter || '')"></div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="i-event i-alpha-20 square-28" @click="toSchedule(dropsThree?.schedule || '')"></div>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
            </div>
    
            <!-- 4th -->
            <div class="d-none d-lg-block col-lg-3">
              <div class="card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsFour?.background" alt="">-->
                  <img src="@/assets/images/random_1.png" alt="">
                  <div class="card-icon-group">
                    <div class="i-group i-alpha-60 square-28"  @click="toDailog(1)"></div>
                    <div class="i-map i-alpha-60 square-28"  @click="toDailog(2)"></div>
                  </div>
                  
                  <div class="card-time-wrap color-white" v-if="durationDateFour?.value?.days && durationDateFour?.value?.hours && durationDateFour?.value?.minutes && durationDateFour?.value?.seconds !== 0">
                    <p class="count-down-day">{{ durationDateFour?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateFour?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateFour?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateFour?.value?.seconds }}</p>
                  </div>

                  <div class="card-time-wrap color-white" v-else>
                    <p class="count-down-day">-</p>
                    <p class="count-down-hour">-</p>
                    <p class="count-down-min">-</p>
                    <p class="count-down-sec">-</p>
                  </div>

                </div>
                <!-- card - body -->
                <div class="card-body-content p-16">
                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap align-items-center mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsFour?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsFour?.collection }}</p>
                  </div>

                  <!-- 卡片 - 文字 -->
                  <p class="card-text-p clamp-3 mb-8" v-html="dropsFour?.introduction"></p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsFour?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsFour?.total }}</p>
                  <p class="card-text-p mb-24">{{$t('home.shortTime')}}{{ dropsFour?.date }}</p>

                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="i-earth i-alpha-20 square-28" @click="toWebsite(dropsFour?.website || '')"></div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="i-discord i-alpha-20 square-28" @click="toDiscord(dropsFour?.discord || '')"></div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="i-twitter i-alpha-20 square-28" @click="toTwitter(dropsFour?.twitter || '')"></div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="i-event i-alpha-20 square-28" @click="toSchedule(dropsFour?.schedule || '')"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
    
          </div>

          <!-- 前往查看按鈕 (手機顯示) -->
          <div class="mt-40">
            <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none" @click="toView()">{{$t('home.toView')}}</div>
          </div>

        </div>




        <!-- 彈出視窗 Jony版本 首頁 Minting 第一個 -->
        <el-dialog v-model="dialogFormVisible">
          <div class="" v-if="$store.state.os.isPc" >
            <div class="row" style="height:100%;">
              <!-- 項目資訊集合 -->
              <div class="col-lg-3 col-12" >
                <div class=" flex-lg-column flex-sm-row flex-column align-items-lg-center d-flex mb-24 mb-lg-0">
                  <div class="popup-body card-image-content rwd-pic-content radius-half flex-shrink-0  mb-lg-32 mb-sm-0 mb-8 ">
                    <img :src="dropsOne?.collection_url" alt="">
                  </div>
                  <div class="justify-content-between flex-column d-flex ml-lg-0 ml-sm-16 ml-0" style="width: -webkit-fill-available;">
                    <!-- 項目名稱 -->
                    <h3 class="heading-B-2 clamp-2 color-white mb-lg-32 mb-auto d-sm-block d-none text-lg-center text-start break-word">{{ dropsOne?.collection }}</h3>
                    <!-- 路線圖成員介紹按鈕 -->
                    <div class="flex-lg-column d-flex gap-16">
                      <div
                        class="heading-B-5" 
                        v-for="(item,index) in List" 
                        :key="index" 
                        :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                        {{item.name}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 項目資訊集合 -->
              <div class="col-lg-9 col-12">
                <div class="popup-scroll">
                  <div class="popup-text color-white body-L-1" v-if="type === 1" v-html="dropsOne?.member"></div>
                  <div class="popup-text color-white body-L-1" v-if="type === 2" v-html="dropsOne?.roadmap"></div>
                </div>
              </div>

            </div>
          </div>
        </el-dialog>
        <!-- 彈出視窗 Jony版本 首頁 Minting 第二個 -->
        <el-dialog v-model="dialogFormTwo">
          <div class="" v-if="$store.state.os.isPc" >
            <div class="row" style="height:100%;">
              <!-- 項目資訊集合 -->
              <div class="col-lg-3 col-12" >
                <div class=" flex-lg-column flex-sm-row flex-column align-items-lg-center d-flex mb-24 mb-lg-0">
                  <div class="popup-body card-image-content rwd-pic-content radius-half flex-shrink-0  mb-lg-32 mb-sm-0 mb-8 ">
                    <img :src="dropsTwo?.collection_url" alt="">
                  </div>
                  <div class="justify-content-between flex-column d-flex ml-lg-0 ml-sm-16 ml-0" style="width: -webkit-fill-available;">
                    <!-- 項目名稱 -->
                    <h3 class="heading-B-2 clamp-2 color-white mb-lg-32 mb-auto d-sm-block d-none text-lg-center text-start break-word">{{ dropsTwo?.collection }}</h3>
                    <!-- 路線圖成員介紹按鈕 -->
                    <div class="flex-lg-column d-flex gap-16">
                      <div
                        class="heading-B-5" 
                        v-for="(item,index) in List" 
                        :key="index" 
                        :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                        {{item.name}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 項目資訊集合 -->
              <div class="col-lg-9 col-12">
                <div class="popup-scroll">
                  <div class="popup-text color-white body-L-1" v-if="type === 1" v-html="dropsTwo?.member"></div>
                  <div class="popup-text color-white body-L-1" v-if="type === 2" v-html="dropsTwo?.roadmap"></div>
                </div>
              </div>

            </div>
          </div>
        </el-dialog>
        <!-- 彈出視窗 Jony版本 首頁 Minting 第三個 -->
        <el-dialog v-model="dialogFormThree">
          <div class="" v-if="$store.state.os.isPc" >
            <div class="row" style="height:100%;">
              <!-- 項目資訊集合 -->
              <div class="col-lg-3 col-12" >
                <div class=" flex-lg-column flex-sm-row flex-column align-items-lg-center d-flex mb-24 mb-lg-0">
                  <div class="popup-body card-image-content rwd-pic-content radius-half flex-shrink-0  mb-lg-32 mb-sm-0 mb-8 ">
                    <img :src="dropsThree?.collection_url" alt="">
                  </div>
                  <div class="justify-content-between flex-column d-flex ml-lg-0 ml-sm-16 ml-0" style="width: -webkit-fill-available;">
                    <!-- 項目名稱 -->
                    <h3 class="heading-B-2 clamp-2 color-white mb-lg-32 mb-auto d-sm-block d-none text-lg-center text-start break-word">{{ dropsThree?.collection }}</h3>
                    <!-- 路線圖成員介紹按鈕 -->
                    <div class="flex-lg-column d-flex gap-16">
                      <div
                        class="heading-B-5" 
                        v-for="(item,index) in List" 
                        :key="index" 
                        :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                        {{item.name}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 項目資訊集合 -->
              <div class="col-lg-9 col-12">
                <div class="popup-scroll">
                  <div class="popup-text color-white body-L-1" v-if="type === 1" v-html="dropsThree?.member"></div>
                  <div class="popup-text color-white body-L-1" v-if="type === 2" v-html="dropsThree?.roadmap"></div>
                </div>
              </div>

            </div>
          </div>
        </el-dialog>
        <!-- 彈出視窗 Jony版本 首頁 Minting 第三個 -->
        <el-dialog v-model="dialogFormFour">
          <div class="" v-if="$store.state.os.isPc" >
            <div class="row" style="height:100%;">
              <!-- 項目資訊集合 -->
              <div class="col-lg-3 col-12" >
                <div class=" flex-lg-column flex-sm-row flex-column align-items-lg-center d-flex mb-24 mb-lg-0">
                  <div class="popup-body card-image-content rwd-pic-content radius-half flex-shrink-0  mb-lg-32 mb-sm-0 mb-8 ">
                    <img :src="dropsFour?.collection_url" alt="">
                  </div>
                  <div class="justify-content-between flex-column d-flex ml-lg-0 ml-sm-16 ml-0" style="width: -webkit-fill-available;">
                    <!-- 項目名稱 -->
                    <h3 class="heading-B-2 clamp-2 color-white mb-lg-32 mb-auto d-sm-block d-none text-lg-center text-start break-word">{{ dropsFour?.collection }}</h3>
                    <!-- 路線圖成員介紹按鈕 -->
                    <div class="flex-lg-column d-flex gap-16">
                      <div
                        class="heading-B-5" 
                        v-for="(item,index) in List" 
                        :key="index" 
                        :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                        {{item.name}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- 項目資訊集合 -->
              <div class="col-lg-9 col-12">
                <div class="popup-scroll">
                  <div class="popup-text color-white body-L-1" v-if="type === 1" v-html="dropsFour?.member"></div>
                  <div class="popup-text color-white body-L-1" v-if="type === 2" v-html="dropsFour?.roadmap"></div>
                </div>
              </div>

            </div>
          </div>
        </el-dialog>
        

      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

import {computed, onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import {homeApi} from '../../api';
import {useCountdown} from '@utils/time'
import {useStore} from "vuex";


const router = useRouter();
const type = ref(1)
const List = ref([{name:'成員介紹',value:1},{name:'路線圖',value:2}]);
const changeList = (value:number) =>{
  type.value = value
}
const toView = () =>{
  router.push({name:'Minting'})
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
const dialogFormTwo = ref(false);
const dialogFormThree = ref(false);
const dialogFormFour = ref(false)
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
const dropsOne = ref<IInfo | null>(null);
const dropsTwo = ref<IInfo | null>(null);
const dropsThree = ref<IInfo | null>(null)
const dropsFour = ref<IInfo | null>(null)

//弹窗
const toDailog = (val:number) =>{
  dialogFormVisible.value = true;
  type.value = val
}
const toDailogTwo = (val:number) =>{
  dialogFormTwo.value = true
  type.value = val
}
const toDailogThree = (val:number) =>{
  dialogFormThree.value = true
  type.value = val
}
const toDailogfour = (val:number) =>{
  dialogFormFour.value = true
  type.value = val
}
const durationDateOne = computed(() => {
  if (dropsOne?.value?.date) {
    return useCountdown(new Date(dropsOne?.value?.date))
  }
})
const durationDateTwo = computed(() => {
  if (dropsTwo?.value?.date) {
    return useCountdown(new Date(dropsTwo?.value?.date))
  }
})
const durationDateThree = computed(() => {
  if (dropsThree?.value?.date) {
    return useCountdown(new Date(dropsThree?.value?.date))
  }
})
const durationDateFour = computed(() => {
  if (dropsFour?.value?.date) {
    return useCountdown(new Date(dropsFour?.value?.date))
  }
})
const store = useStore()

const getHomeWallet = async () => {
  const res = await homeApi.getDrops({});
  const list = res.data.map((item: { shortTime: any; date: string; }) => {
   // item.shortTime = item.date.split(' ')[1]
    item.shortTime = item.date
    return item
  })
  dropsOne.value = list[0]
  console.log("->dropsOne.value ", dropsOne.value);
  dropsTwo.value = list[1]
  dropsThree.value = list[2]
  dropsFour.value =list[3]
}

onMounted(() => {
  getHomeWallet()
})


</script>

<style scoped lang="less">

 /*----- Popup Code Start -----*/
:deep .el-overlay {
  background-color: rgba(18, 18, 18, 0.1);
  backdrop-filter: blur(8px);
}
:deep .el-overlay-dialog {
  display: flex;
}
:deep .el-dialog {
  width: 100%;
  padding-top: 24px !important;
  padding-right: 24px !important;
  padding-left: 24px !important;
  padding-bottom: 24px !important;
  background: rgba(18,18,18,.92) !important; 
  backdrop-filter: blur(2px);
  border: 2px solid rgba(255,255,255,.2);
  height: 80vh;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  margin-right: auto;
  margin-left: auto;
  margin-top: auto;
  margin-bottom: auto;
}
:deep .el-dialog__body {
  padding: 0;
}
.popup-body.card-image-content {
  width: 196px;
  height: 196px;
}
.popup-text {
  overflow-y: auto;
  max-height: calc(80vh - 48px - 30px - 4px);
  padding-bottom: 24px;
  width: 100%;
}
.tag {
  height: auto;
  text-align: center;
}
.break-word {
  word-break: break-word;
}


/*/////////////////////////////
===== Desktop First START =====
/////////////////////////////*/
/*----- max-width 1536 -----*/
@media screen and (max-width: 1536px) {}
/*----- max-width 1200 -----*/
@media screen and (max-width: 1200px) {}
/*----- max-width 992 -----*/
@media screen and (max-width: 992px) {
  .popup-text {
    max-height: calc(80vh - 48px - 132px - 24px - 30px - 4px);
  }
  .popup-body.card-image-content {
    width: 132px;
    height: 132px;
  }
  
  
}
/*----- max-width 768 -----*/
@media screen and (max-width: 768px) {}
/*----- max-width 576 -----*/
@media screen and (max-width: 576px) {
  .popup-text {
    max-height: calc(80vh - 48px - 173px - 24px - 30px - 4px);
  }
  .popup-body.card-image-content {
    width: 120px;
    height: 120px;
  }
  :deep .el-dialog {
      max-width: 540px;
    }
}

  /*/////////////////////////////
  ===== Mobile First START =====
  /////////////////////////////*/
  @media (min-width: 576px) {
    :deep .el-dialog {
      max-width: 540px;
    }
  }
  @media (min-width: 768px) {
    :deep .el-dialog {
      max-width: calc( 720px * 0.9166666667 );
    }
  }
  @media (min-width: 992px) {
    :deep .el-dialog {
      max-width: 960px;
    }
  }
  @media (min-width: 1200px) {
    :deep .el-dialog {
      max-width: calc( 1140px * 0.9166666667 );
    }
  }
  @media (min-width: 1400px) {
    :deep .el-dialog {
      max-width: calc( 1320px * 0.9166666667 );
      // 1320 x 0.9166666667 (col-11)
    }
  }
/*----- Popup Code End -----*/ 


// 成員介紹 & 路線圖
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
  line-height: 24px;
}
/* 设置滚动条的样式 */

// .card-icon-img{
//   width: 38px;
//   height: 38px;
//   img{
//     width: 100%;
//     height: 100%;
//     border-radius: 50%;
//   }
// }
// .card_icon{
//   width: 50px;
//   display: flex;
//   position: absolute;
//   top:10%;
//   left: 10%;
//   gap:12px;
//   .icon_list{
//     width: 50px;
//     img{
//       width: 24px;
//       height: 16.5px;
//     }
//   }
// }
// .minting_box{
//   display: flex;
//   justify-content:space-between;
//   margin-top: 82.5px;
// }
// .minting-content .card-item {
//   display: flex;
//   flex-direction: column;
//   height: 100%;
// }

// /*----- 卡片圖片 -----*/
// .minting-content .card-image {
//   width: 100%;
//   border-radius: 16px 16px 0px 0px;
//   overflow: hidden;
//   position: relative;
// }

// .minting-content .card-image .card-time-wrap {
//   display: flex;
//   gap: 8px;
//   position: absolute;
//   top: 50%;
//   left: 50%;
//   transform: translate(-50%,-50%);
// }

// .minting-content .card-image .card-time-wrap p {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 700;
//   line-height: 1.4;
//   letter-spacing: 0;
//   color: #FFFFFF;
//   padding: 10px;
//   border-radius: 8px;
//   background-color: #4447E2;
// }
// .minting-content .card-image .card-time-wrap p {
//   font-size: 18px;
// }
// @media screen and (min-width: 768px) {
//   .minting-content .card-image .card-time-wrap p {
//     font-size: calc(0vw + 18px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .minting-content .card-image .card-time-wrap p {
//     font-size: 18px;
//   }
// }

/*----- 卡片下方文字區塊 -----*/
/*----- 卡片下方文字 - 容器 -----*/
// .minting-content .card-text {
//   display: flex;
//   flex-direction: column;
//   flex: 1;
//   background-color: #1C1C24;
//   border-radius: 0px 0px 16px 16px;
//   padding:6px 16px 0px 16px;
//   color:rgba(255, 255, 255, 0.9);
// }

/*----- 卡片下方文字 - 文字 -----*/
// .minting-content .card-title {
//   flex: 1;
// }

// .minting-content .card-text h3 {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 700;
//   line-height: 1.33;
//   letter-spacing: 0;
//   -webkit-line-clamp: 2;
// }
// .minting-content .card-text h3 {
//   font-size: 22px;
// }
// @media screen and (min-width: 768px) {
//   .minting-content .card-text h3 {
//     font-size: calc(0.78125vw + 16px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .minting-content .card-text h3 {
//     font-size: 28px;
//   }
// }

// .minting-content .card-text .card-time {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 400;
//   line-height: 1.375;
//   letter-spacing: 0;
// }
// .minting-content .card-text .card-time {
//   font-size: 16px;
// }
// @media screen and (min-width: 768px) {
//   .minting-content .card-text .card-time {
//     font-size: calc(0vw + 16px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .minting-content .card-text .card-time {
//     font-size: 16px;
//   }
// }

/*----- 卡片下方文字 - 列表 -----*/
// .minting-content .card-text .info-list {
//   display: flex;
//   flex-wrap: wrap;
// }

// .minting-content .card-text .info-item:nth-of-type(-1n+2) {
//   padding-right: 3.2%;
//   border-right: 1px solid #fff;
//   margin-right: 3%;
// }

// .minting-content .card-text .community-icon {
//   fill: #FFFFFF;
// }

// .minting-content .card-text .info-item {
//   display: flex;
// }

// .minting-content .card-text .info-item h4 {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 700;
//   line-height: 1.4;
//   letter-spacing: 0;
// }
// .minting-content .card-text .info-item h4 {
//   font-size: 18px;
// }
// @media screen and (min-width: 768px) {
//   .minting-content .card-text .info-item h4 {
//     font-size: calc(0vw + 18px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .minting-content .card-text .info-item h4 {
//     font-size: 18px;
//   }
// }

// .minting-content .card-text .info-item small {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 400;
//   line-height: 1.66;
//   letter-spacing: 0;
// }
// .minting-content .card-text .info-item small {
//   font-size: 12px;
// }
// @media screen and (min-width: 768px) {
//   .minting-content .card-text .info-item small {
//     font-size: calc(0vw + 12px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .minting-content .card-text .info-item small {
//     font-size: 12px;
//   }
// }
// .card-footer {
//   padding: 6px 16px 16px;
//   background-color: #1C1C24;
// }
//  .card-footer .social-link-wrap {
//   display: flex;
//   gap: 24px;
// }
//  .card-footer .social-link-wrap .social-link-icon svg {
//   fill: rgba(255, 255, 255, 0.2);
//   height: 32px;
//   width: 32px;
// }















  

</style>