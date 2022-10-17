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
              <div class="card-item card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsOne?.background" alt="">-->
                  <img src="@/assets/images/random_1.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list"  @click="toDailog(1)"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px">
                    </div>
                    <div class="icon_list"  @click="toDailog(2)"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">{{ durationDateOne?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateOne?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateOne?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateOne?.value?.seconds }}</p>
                  </div>
                </div>
                <!-- 卡片內文 -->
                <div class="card-body-content p-16">

                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsOne?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsOne?.collection }}</p>
                  </div>
                  <!-- 卡片 - 文字 -->
                  <p class="card-text-p clamp-3 mb-8">{{ dropsOne?.introduction }}</p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsOne?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsOne?.total }}</p>
                  <p class="card-text-p mb-8">{{$t('home.shortTime')}}{{ dropsOne?.shortTime }}</p>
                  
                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="link-icon" @click="toWebsite(dropsOne?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="link-icon" @click="toDiscord(dropsOne?.discord || '')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="link-icon" @click="toTwitter(dropsOne?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="link-icon" @click="toSchedule(dropsOne?.schedule || '')">
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
              <div class="card-item card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsTwo?.background" alt="">-->
                  <img src="@/assets/images/random_2.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list" @click="toDailogTwo(1)"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px">
                    </div>
                    <div class="icon_list" @click="toDailogTwo(2)"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">{{ durationDateTwo?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateTwo?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateTwo?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateTwo?.value?.seconds }}</p>
                  </div>
                </div>
                <!-- card - body -->
                <div class="card-body-content p-16">
                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsTwo?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsTwo?.collection }}</p>
                  </div>

                  <!-- 卡片 - 文字 -->
                  <p class="card-text-p clamp-3 mb-8">{{ dropsTwo?.introduction }}</p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsTwo?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsTwo?.total }}</p>
                  <p class="card-text-p mb-8">{{$t('home.shortTime')}}{{ dropsTwo?.shortTime }}</p>

                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="link-icon" @click="toWebsite(dropsTwo?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="link-icon" @click="toDiscord(dropsTwo?.discord || '')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="link-icon" @click="toTwitter(dropsTwo?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="link-icon" @click="toSchedule(dropsTwo?.schedule || '')">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
            </div>

            <!-- 3rd -->
            <div class="d-none d-lg-block col-lg-3">
              <div class="card-item card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsThree?.background" alt="">-->
                  <img src="@/assets/images/random_3.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list" @click="toDailogThree(1)"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px">
                    </div>
                    <div class="icon_list" @click="toDailogThree(2)"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">{{ durationDateThree?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateThree?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateThree?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateThree?.value?.seconds }}</p>
                  </div>
                </div>
                <!-- card - body -->
                <div class="card-body-content p-16">

                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsThree?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsThree?.collection }}</p>
                  </div>

                  <!-- 卡片 - 文字 -->
                  <p class="card-text-p clamp-3 mb-8">{{ dropsThree?.introduction }}</p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsThree?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsThree?.total }}</p>
                  <p class="card-text-p mb-8">{{$t('home.shortTime')}}{{ dropsThree?.shortTime }}</p>

                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="link-icon" @click="toWebsite(dropsThree?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="link-icon" @click="toDiscord(dropsThree?.discord || '')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="link-icon" @click="toTwitter(dropsThree?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="link-icon" @click="toSchedule(dropsThree?.schedule || '')">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>

                </div>
              </div>
            </div>
    
            <!-- 4th -->
            <div class="d-none d-lg-block col-lg-3">
              <div class="card-item card">
                <!-- 卡片圖片 -->
                <div class="card-image">
    <!--              <img :src="http + dropsFour?.background" alt="">-->
                  <img src="@/assets/images/random_1.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list" @click="toDailogfour(1)"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px">
                    </div>
                    <div class="icon_list" @click="toDailogfour(2)"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">{{ durationDateFour?.value?.days }}</p>
                    <p class="count-down-hour">{{ durationDateFour?.value?.hours }}</p>
                    <p class="count-down-min">{{ durationDateFour?.value?.minutes }}</p>
                    <p class="count-down-sec">{{ durationDateFour?.value?.seconds }}</p>
                  </div>
                </div>
                <!-- card - body -->
                <div class="card-body-content p-16">
                  <!-- icon 標題組 -->
                  <div class="card-icon-title-wrap mb-12">
                    <div class="icon mr-16">
                      <img :src="dropsFour?.collection_url" alt="">
                    </div>
                    <p class="title card-title-h5 text-white clamp-1">{{ dropsFour?.collection }}</p>
                  </div>

                  <!-- 卡片 - 文字 -->
                  <p class="card-text-p clamp-3 mb-8">{{ dropsFour?.introduction }}</p>
                  <p class="card-text-p mb-8">{{$t('home.price')}}{{ dropsFour?.price }}</p>
                  <p class="card-text-p mb-8">{{$t('home.total')}}{{ dropsFour?.total }}</p>
                  <p class="card-text-p mb-8">{{$t('home.shortTime')}}{{ dropsFour?.shortTime }}</p>

                  <!-- 卡片icon -->
                  <div class="mt-auto">
                    <!-- social-link -->
                    <ul class="link-wrap">
                      <!-- icon-group -->
                      <li class="link-item">
                        <div class="link-icon" @click="toWebsite(dropsFour?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="link-item">
                        <div class="link-icon" @click="toDiscord(dropsFour?.discord || '')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="link-item">
                        <div class="link-icon" @click="toTwitter(dropsFour?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="link-item">
                        <div class="link-icon" @click="toSchedule(dropsFour?.schedule || '')">
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
          <div class="mt-40">
            <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none" @click="toView()">{{$t('home.toView')}}</div>
          </div>

        </div>






        <!-- 路線圖 & 成員介紹 -->

        <el-dialog v-model="dialogFormVisible" width="85%">
          <!-- PC     -->
          <div class=" d-none d-lg-block col-12" v-if="$store.state.os.isPc">
              <div class="main">
                <div class="main-left">
                  <div class="main-img">
                    <img :src="dropsOne?.collection_url" alt="">
                  </div>
                  <div class="main-name">{{ dropsOne?.collection }}</div>
  
                  <div class="tab-list">
                    <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                      {{item.name}}
                    </div>
                  </div>
                </div>
                <div class="main-right" v-if="type === 1">{{dropsOne?.member}}</div>
                <div class="main-right" v-if="type === 2">{{dropsOne?.roadmap}}</div>
              </div>
          </div>
          <!-- H5 || table-->
          <div v-else >
            <div class="ipad-main">
              <div class="main-img">
                <img :src="dropsOne?.collection_url" alt="">
              </div>
              <div class="right">
                <div class="main-name">{{ dropsOne?.collection }}</div>
                <div class="tags">
                  <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                    {{item.name}}
                  </div>
                </div>
      
              </div>
            </div>
            <div v-if="type === 1">{{dropsOne?.member}}</div>
            <div  v-if="type === 2">{{dropsOne?.roadmap}}</div>
          </div>
        </el-dialog>

        <el-dialog v-model="dialogFormTwo" width="85%">
          <!-- PC -->
          <div class=" d-none d-lg-block col-12" v-if="$store.state.os.isPc">
            <div class="main">
              <div class="main-left">
                <div class="main-img">
                  <img :src="dropsTwo?.collection_url" alt="">
                </div>
                <div class="main-name">{{ dropsTwo?.collection }}</div>
    
                <div class="tab-list">
                  <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                    {{item.name}}
                  </div>
                </div>
              </div>
              <div class="main-right" v-if="type === 1">{{dropsTwo?.member}}</div>
              <div class="main-right" v-if="type === 2">{{dropsTwo?.roadmap}}</div>
            </div>
          </div>
          <!-- H5 || table-->
          <div v-else >
            <div class="ipad-main">
              <div class="main-img">
                <img :src="dropsTwo?.collection_url" alt="">
              </div>
              <div class="right">
                <div class="main-name">{{ dropsTwo?.collection }}</div>
                <div class="tags">
                  <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                    {{item.name}}
                  </div>
                </div>
    
              </div>
            </div>
            <div v-if="type === 1">{{dropsTwo?.member}}</div>
            <div  v-if="type === 2">{{dropsTwo?.roadmap}}</div>
          </div>
        </el-dialog>

        <el-dialog v-model="dialogFormThree" width="85%">
          <!-- PC     -->
          <div class=" d-none d-lg-block col-12" v-if="$store.state.os.isPc">
            <div class="main">
              <div class="main-left">
                <div class="main-img">
                  <img :src="dropsThree?.collection_url" alt="">
                </div>
                <div class="main-name">{{ dropsThree?.collection }}</div>
    
                <div class="tab-list">
                  <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                    {{item.name}}
                  </div>
                </div>
              </div>
              <div class="main-right" v-if="type === 1">{{dropsThree?.member}}</div>
              <div class="main-right" v-if="type === 2">{{dropsThree?.roadmap}}</div>
            </div>
          </div>
          <!-- H5 || table-->
          <div v-else >
            <div class="ipad-main">
              <div class="main-img">
                <img :src="dropsThree?.collection_url" alt="">
              </div>
              <div class="right">
                <div class="main-name">{{ dropsThree?.collection }}</div>
                <div class="tags">
                  <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                    {{item.name}}
                  </div>
                </div>
    
              </div>
            </div>
            <div v-if="type === 1">{{dropsThree?.member}}</div>
            <div  v-if="type === 2">{{dropsThree?.roadmap}}</div>
          </div>
        </el-dialog>

        <el-dialog v-model="dialogFormFour" width="85%">
          <!-- PC     -->
          <div class=" d-none d-lg-block col-12" v-if="$store.state.os.isPc">
            <div class="main">
              <div class="main-left">
                <div class="main-img">
                  <img :src="dropsFour?.collection_url" alt="">
                </div>
                <div class="main-name">{{ dropsFour?.collection }}</div>
    
                <div class="tab-list">
                  <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                    {{item.name}}
                  </div>
                </div>
              </div>
              <div class="main-right" v-if="type === 1">{{dropsFour?.member}}</div>
              <div class="main-right" v-if="type === 2">{{dropsFour?.roadmap}}</div>
            </div>
          </div>
          <!-- H5 || table-->
          <div v-else >
            <div class="ipad-main">
              <div class="main-img">
                <img :src="dropsFour?.collection_url" alt="">
              </div>
              <div class="right">
                <div class="main-name">{{ dropsFour?.collection }}</div>
                <div class="tags">
                  <div v-for="(item,index) in List" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeList(item.value)">
                    {{item.name}}
                  </div>
                </div>
    
              </div>
            </div>
            <div v-if="type === 1">{{dropsFour?.member}}</div>
            <div  v-if="type === 2">{{dropsFour?.roadmap}}</div>
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
    item.shortTime = item.date.split(' ')[1]
    return item
  })
  dropsOne.value = list[0]
  dropsTwo.value = list[1]
  dropsThree.value = list[2]
  dropsFour.value =list[3]
}

onMounted(() => {
  getHomeWallet()
})


</script>






<style scoped lang="less">
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
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
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















  .minting-section .card-body-content {
    background-color: #1C1C24;
    border-radius: 0px 0px 16px 16px;
    color: rgba(255, 255, 255, 0.9);
  }

</style>