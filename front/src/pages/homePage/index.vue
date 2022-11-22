<template>
  <div class="mt-80">
    <!-- 項目資訊 -->
    <div class="container mb-24">
      <div class="row">
        <div class="col-12">
          <div v-if="panel.data" class="card card-background p-md-24 p-12">
            <div class="row">
              <!-- 項目info -->
              <div class="col-xl-7 col-12 d-flex flex-column mb-xl-0 mb-24">
                <!-- 項目方頭像、名稱、tabs -->
                <div class="d-flex flex-md-row flex-column gap-24 mb-24">
                  <!-- 項目頭像 -->
                  <div class="d-flex">
                    <div class="card-image-content square-120 radius-half flex-shrink-0" style="width:auto">
                      <img :src="panel.data.photo_url">
                    </div>
                    <!-- icon like -->
                    <!-- 未點擊 -->
                    <div class="d-md-none ml-auto">
                      <div class="square-36 i-like-fill i-white" @click="toCollRemove(panel.data.id)" v-if="panel.data.is_collected === 1"></div>
                      <!-- 點擊 -->
                      <div class="square-36 i-like i-white" @click="toColl(panel.data.id)" v-else></div>
                    </div>
                  </div>
                  <div class="d-flex flex-column flex-grow-1">
                    <div class="d-flex align-items-start mb-auto">
                      <!-- 項目名稱 -->
                      <h3 class="heading-B-2 mr-auto mb-md-0 mb-16">{{ panel.data.name }}</h3>
                      <!-- icon like -->
                      <!-- 未點擊 -->
                      <div class="d-md-block d-none">
                        <div class="square-36 i-like-fill i-white" @click="toCollRemove(panel.data.id)" v-if="panel.data.is_collected === 1"></div>
                        <!-- 點擊 -->
                        <div class="square-36 i-like i-white" @click="toColl(panel.data.id)" v-else></div>
                      </div>
                    </div>                 
                    
                    <div class="d-flex gap-16">
                      <!-- 項目幣值 -->
                      <div class="badge bg-alpha-white-10">{{ panel.data.unit }}</div>
                      <!-- 項目地址 -->
                      <div class="d-flex align-items-center badge bg-alpha-white-10 gap-4" @click="copyInfo(panel.data.contract)">
                        {{ panel.data.contract.slice(0, 7) }}...
                        <div class="i i-16 i-copy i-white" ></div>
                      </div>
                      
                      <!-- 項目NFT數量 -->
                      <div class="badge bg-alpha-white-10">{{ panel.data.item_qty }} NFTs</div>
                    </div>


                    

                  </div>
                </div>

                <!-- 項目介紹 -->
                <div class="body-L-1 mb-24 clamp-5">
                  {{ panel.data.introduction }}
                </div>

                <!-- 下方按鈕 -->
                <div class="
                  d-flex
                  flex-md-row 
                  flex-column 
                  align-items-md-end 
                  align-items-inherit 
                  mt-auto">
                  <!-- icon群 -->
                  <div class="d-flex align-items-center gap-16">
                    <div class="i-group bg-alpha-white-55 square-24" @click="toDailog(1)"></div>
                    <div class="i-map bg-alpha-white-55 square-24" @click="toDailog(2)"></div>
                    <div class="i-earth bg-alpha-white-55 square-24" @click="toLink(panel.data.website)"></div>
                    <div class="i-discord bg-alpha-white-55 square-24" @click="toLink(panel.data.discord)"></div>
                    <div class="i-twitter bg-alpha-white-55 square-24" @click="toLink(panel.data.instagram)"></div>
                    <div class="i-instagram bg-alpha-white-55 square-24" @click="toLink(panel.data.instagram)"></div>
                  </div>
                  <!-- 立即購買按鈕 -->
                  <div class="btn-buy btn-bold ml-md-auto mt-md-0 mt-40 " @click="toLink(panel.data.platform_url)">{{$t('home.buyNow')}}</div>
                </div>

              </div>
              
              <!-- 小資訊群 -->
              <div class="col-xl-5 col-12 overflow-hidden">
                <div class="row row-cols-1 row-cols-md-2 gx-3 gy-3 mb-16">
                  <!-- 市值 -->
                  <div class="col">
                    <div class="card card-background-dark p-16 gap-4">
                      <div class="body-B-1">{{$t('home.marketCap')}}</div>
                      <div class="heading-B-4">${{ panel.data.market_cap }}</div>
                      <div class="d-flex gap-8">
                        <span class="badge radius-caps py-4 caption-L-1">24h</span>
                        <span class="body-B-1" :style="[{color: panel.data.market_cap_p < 0 ? 'red' :'green'}]">{{ (panel.data.market_cap_p * 100).toFixed(1) }}%</span>
                      </div>
                    </div>
                  </div>
                  <!-- 持有者 -->
                  <div class="col">
                    <div class="card card-background-dark p-16 gap-4">
                      <div class="body-B-1">{{$t('home.holder')}}</div>
                      <div class="heading-B-4">{{ panel.data.holders }}</div>
                      <div class="d-flex gap-8">
                        <span class="badge radius-caps py-4 caption-L-1">24h</span>
                        <span class="body-B-1" :style="[{color: panel.data.holders_p < 0 ? 'red' :'green'}]">{{ (panel.data.holders_p * 100).toFixed(1) }}%</span>
                      </div>
                    </div>
                  </div>
                  <!-- 交易額 -->
                  <div class="col">
                    <div class="card card-background-dark p-16 gap-4">
                      <div class="body-B-1">{{$t('home.volume')}}</div>
                      <div class="heading-B-4">${{ panel.data.volume_24 }}</div>
                      <div class="d-flex gap-8">
                        <span class="badge radius-caps py-4 caption-L-1">24h</span>
                        <span class="body-B-1" :style="[{color: panel.data.volume_24_p < 0 ? 'red' :'green'}]">{{ (panel.data.volume_24_p * 100).toFixed(1) }}%</span>
                      </div>
                    </div>
                  </div>
                  <!-- 地板價 -->
                  <div class="col">
                    <div class="card card-background-dark p-16 gap-4">
                      <div class="body-B-1">{{$t('home.floorPrice')}}</div>
                      <div class="heading-B-4">${{ panel.data.floor_price }}</div>
                      <div class="d-flex gap-8">
                        <span class="badge radius-caps py-4 caption-L-1">24h</span>
                        <span class="body-B-1" :style="[{color: panel.data.floor_price_p < 0 ? 'red' :'green'}]">{{ (panel.data.floor_price_p * 100).toFixed(1) }}%</span>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!-- 項目健康指數 -->
                <div class="col-12">
                    <div class="card card-background-dark p-16 gap-4">
                      <div class="body-B-1">{{$t('home.collectionHealth')}}</div>
                      <div class="heading-B-4">{{ (panel.data.holders / panel.data.item_qty * 100).toFixed(1) }}%</div>
                    </div>
                  </div>
              </div>

            </div>
      
          </div>
        </div>
      </div>
    </div>
      
    <!--   图表 -->
    <div class="container mb-24">
      <div class="row">
        <div class="col-xl-6 col-12 mb-xl-0 mb-24">
          <div class="line p-md-24 p-12">
            <Line />
          </div>
        </div>
        <div class="col-xl-6 col-12">
          <div class="pie p-md-24 p-12">
            <Pie :panel="panel"/>
          </div>
        </div>
      </div>
    </div>
  
    <!-- 小卡片 -->
    <div class="container">

      <!-- 項目方NFT卡片工具列 -->
      <div class="dialog-wrap mb-24">
        <el-row >
          
          <el-col :md="8" :sm="8" :xs="24">
            <div class="left color-white">
              <el-switch v-model="form.filter_ind"
                        active-value="1"
                        inactive-value="2"/>
              {{$t('home.sellPrice')}}
            </div>
          </el-col>
          <el-col :md="8" :sm="8" :xs="12">
            <el-popover
                :visible="visible"
                :width="300"
                placement="bottom"
            >
              <template #reference>
                <el-button class="special-btn" size="large" style="width: 100%;justify-content: space-around" @click="visible = !visible">
                  <div style="flex: 1;text-align: left">{{$t('home.priceRange')}}</div>
                    <el-icon>
                      <ArrowDown/>
                    </el-icon>
                </el-button>
              </template>
              <div class="d-flex flex-row align-items-center justify-content-around">
                <el-input v-model="form.min" placeholder="Min" style="width: 110px;"/>
                to
                <el-input v-model="form.max" placeholder="Max" style="width: 110px;"/>
              </div>
              <div class="mt-16 d-flex flex-row align-items-center justify-content-center">
                <el-button round type="primary" @click="visible=!visible"> {{$t('home.filter')}}</el-button>
              </div>
            </el-popover>
          </el-col>
          <el-col :md="8" :sm="8" :xs="12">
            <el-select v-model="form.orderby" class="ml-16" placeholder="Select" size="large">
              <el-option
                  v-for="item in saleFilter"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value"
              />
            </el-select>
          </el-col>
        </el-row>
  
      </div>

      <!-- 項目方NFT卡片 -->
      <div class="minting-section">
        <div class="row gy-4">
          
          <!-- 尼哥做的 -->
          <div class="col-12 col-sm-6 col-lg-3"  v-for="(item,index) in dropsList" :key="index">
            <div class="card">
              <!-- 卡片圖片 -->
              <div class="card-image-content ratio--1_1" style="border-radius: 16px 16px 0 0;">
                <img :src="item.photo_url" alt="">
              </div>
              
              <!-- 卡片內文 -->
              <div class="card-body-content p-16" style=" flex:0;">

                <!-- icon 標題組 -->
                <div class="card-icon-title-wrap align-items-center mb-12" style="width:100%;">
                  <!-- 項目方名稱 -->
                  <p class="title card-title-h5 text-white clamp-1">{{ item.name }}</p>
                  <!-- 愛心icon -->
                  <!-- <div class="i i-24 i-white i-like"></div> -->
                  <div class="ml-auto">
                    <div class="square-24 i-like-fill i-white" @click="toNftRemove(item.id)" v-if="item.is_collected === 1"></div>
                    <div class="square-24 i-like i-white" @click="toNft(item.id)" v-else></div>
                  </div>
                </div> 
                <!-- 卡片 - 文字 -->
                <p class="card-text-p">#{{ item.tokenid }}</p>
                
                
              </div>
            </div>
          </div>

          <!-- Lynn做的 -->
          <!-- <div v-for="(item,index) in dropsList" :key="index" class="col-12 col-sm-6 col-lg-3">
            <div class="card-item card-1">
              <div class="card-image">
                <img :src="item.photo_url" alt="">
              </div>
              <div class="card-text">
                <div class="card-text-wrap">
                  <div class="text"> {{ item.price }} {{ item.unit }}</div>
                  <div class="image" @click="toNftRemove(item.id)" v-if="item.is_collected === 1">
                    <svg xmlns="http://www.w3.org/2000/svg" height="38" width="38"><path d="m21.95 40.2-2.65-2.45Q13.1 32 8.55 26.775T4 15.85q0-4.5 3.025-7.525Q10.05 5.3 14.5 5.3q2.55 0 5.05 1.225T24 10.55q2.2-2.8 4.55-4.025Q30.9 5.3 33.5 5.3q4.45 0 7.475 3.025Q44 11.35 44 15.85q0 5.7-4.55 10.925Q34.9 32 28.7 37.75l-2.65 2.45q-.85.8-2.05.8-1.2 0-2.05-.8Z"/></svg>
                  </div>
                  <div class="image" @click="toNft(item.id)" v-else>
                    <svg xmlns="http://www.w3.org/2000/svg" height="38" width="38"><path d="m21.95 40.2-2.65-2.45Q13.1 32 8.55 26.775T4 15.85q0-4.5 3.025-7.525Q10.05 5.3 14.5 5.3q2.55 0 5.05 1.225T24 10.55q2.2-2.8 4.55-4.025Q30.9 5.3 33.5 5.3q4.45 0 7.475 3.025Q44 11.35 44 15.85q0 5.7-4.55 10.925Q34.9 32 28.7 37.75l-2.65 2.45q-.85.8-2.05.8-1.2 0-2.05-.8Zm.75-26.35q-1.35-2.45-3.55-4-2.2-1.55-4.65-1.55-3.3 0-5.4 2.125Q7 12.55 7 15.85q0 2.9 1.95 6.075Q10.9 25.1 13.6 28.1t5.6 5.575Q22.1 36.25 24 38q1.9-1.7 4.8-4.3 2.9-2.6 5.6-5.625 2.7-3.025 4.65-6.2Q41 18.7 41 15.85q0-3.3-2.125-5.425T33.5 8.3q-2.5 0-4.675 1.525T25.2 13.85q-.25.4-.55.575-.3.175-.7.175-.4 0-.725-.175-.325-.175-.525-.575Zm1.3 9.3Z"/></svg>
                  </div>
                </div>
                <div>
                  #1234
                </div>
              </div>
            </div>
          </div> -->

        </div>
      </div>

    </div>


    <!-- 彈出視窗 Jony版本 （更新） -->
    <el-dialog v-model="dialogFormVisible">
      <div class="" v-if="$store.state.os.isPc">
        <div class="row" style="height:100%;">
          <!-- 項目資訊集合 -->
          <div class="col-lg-3 col-12" >
            <div class=" flex-lg-column flex-sm-row flex-column align-items-lg-center d-flex mb-24 mb-lg-0">
              <div class="popup-body card-image-content rwd-pic-content radius-half flex-shrink-0  mb-lg-32 mb-sm-0 mb-8 ">
                <img :src="panel.data.photo_url" alt="">
              </div>
              <div class="justify-content-between flex-column d-flex ml-lg-0 ml-sm-16 ml-0" style="width: -webkit-fill-available;">
                <!-- 項目名稱 -->
                <h3 class="heading-B-2 clamp-2 color-white mb-lg-32 mb-auto d-sm-block d-none text-lg-center text-start break-word">{{ panel.data.name }}</h3>
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
              <div class="popup-text color-white body-L-1" v-if="type === 1" v-html="panel.data.member"></div>
              <div class="popup-text color-white body-L-1" v-if="type === 2" v-html="panel.data.roadmap"></div>
            </div>
          </div>

        </div>
      </div>
    </el-dialog>
  </div>
</template>


<script lang="ts" setup>
import {useScrollHeight} from '@/hooks/useScrollHeight'
import {onMounted, reactive, ref, watch} from "vue";
import {homeApi, homePageApi} from "@/api";
import {useRoute} from "vue-router";
import {useStore} from "vuex";
import {panelData} from "@/pages/homePage/homePageTypes";
import Line from "@/pages/homePage/line.vue";
import Pie from "@/pages/homePage/pie.vue";

import { ArrowDown } from '@element-plus/icons-vue'
import {copy} from "@utils/copy";
const visible = ref(false)
const route = useRoute()
const store = useStore()
const filter_ind = ref()
const List = ref([{name:'成員介紹',value:1},{name:'路線圖',value:2}]);
const saleFilter = reactive<any>([
  {label: "售出價格：高至低", value: '2'},
  {label: "售出價格：低至高", value: '1'},
  {label: "賣出時間：新至舊", value: '3'},
]);
const form = reactive<Record<string, any>>({
  filter_ind: 1,
  min: '',
  max: '',
  orderby: '1',
});
const dialogFormVisible = ref(false);
const isFinish = ref<boolean>(false);
const isLoading = ref<boolean>(false);

const count = ref(12);
const page = ref(1)
const {scrollBtmHeight} = useScrollHeight()
const panel = reactive<panelData>({} as panelData)
type IInfo = {
  id: string,
  permalink: string,
  photo_url: string,
  price: string,
  unit: string,
  usd_price: string,
  is_collected: number,
  tokenid: string,
  name: string,
}
const dropsList = ref<IInfo[] | null>(null);
const type = ref(1)
const toDailog = (val:number) =>{
  dialogFormVisible.value = true;
  type.value = val
}
//路途切换
const changeList = (value:number) =>{
  type.value = value
}
//复制
const copyInfo=(info:string)=>{
  copy(info)
}
//跳转窗口
const toLink = (url:string) =>{
  if (url === '') {
    return
  }
  window.open(url)
}

const getHomePage = async () => {
  const {id} = route.query
  const params = {
    collectionId: id as string,
  }
  const res: panelData = await homePageApi.getHomePoster(params);
  panel.data = res.data
  panel.holder_stat = res.holder_stat

}
//会员收藏

const toCollRemove = async(id:string) =>{
  const params ={
    collectionId:id,
  }
  const res = await  homePageApi.removeColl(params);
  getHomePage()
}
const toColl = async(id:string) =>{
  const params ={
    collectionId:id,
  }
  const res = await  homePageApi.addColl(params);
  getHomePage()
}

//收藏
const toNft = async(id:string) =>{
  const params ={
    nftId:id,
  }
  const res = await  homePageApi.addNft(params);
  page.value=1;
  isFinish.value = false;
  dropsList.value = [];
  isLoading.value = false;
  await load()
}
//移除收藏
const toNftRemove = async(id:string) =>{
  const params ={
    nftId:id,
  }
  const res = await  homePageApi.removeNft(params);
  page.value=1;
  isFinish.value = false;
  dropsList.value = [];
  isLoading.value = false;
  await load()
}
/**
 * 请求接口
 */
const load = async () => {
  if (isFinish.value || isLoading.value || scrollBtmHeight.value > 200) {
    return;
  }
  const {id} = route.query
  const params = {
    collectionId: id as string,    //項目id
    count: count.value,     //每頁多少筆紀錄
    page: page.value,
    ...form,
  }

  isLoading.value = true
  const res = await homePageApi.postHomeCard(params);
  isLoading.value = false
  if (!res) {
    return
  }
  page.value = page.value + 1
  dropsList.value = [...(dropsList.value ?? []), ...res.data];
  if (res.data.length < 12) {
    isFinish.value = true
  }
}

/**
 * 监听滚动
 */
watch([() => scrollBtmHeight.value,], () => {
  load()
}, {deep: true})
/**
 * 监听参数
 */
watch([() => form], () => {
  isFinish.value = false;
  page.value = 1;
  dropsList.value = [];
  isLoading.value = false;
  load()
}, {deep: true})
onMounted(() => {
  getHomePage()
  load()
})
</script>

<style lang="less" scoped>

/* jony code start */

:deep .el-input__wrapper {
  background-color: #121212;
  border:1px solid #FFFFFF99;
  box-shadow: none;
}
:deep .el-input__inner {
  color: #FFFFFFCC;
}
:deep .el-button {
  background-color: #121212;
  color: #fff;
  border:1px solid #FFFFFF99;
}
:deep .el-button.is-round {
  background-color: #4447E2;
  color: #fff;
  border:none;
}

:deep .el-button:focus, .el-button:hover {
  color: #fff;
  border-color: #FFFFFF99;
  background-color: #FFFFFF1A;
  // outline: 0;
}

:deep .el-switch.is-checked .el-switch__core {
    border-color: #4447E2;
    background-color: #4447E2;
}
:deep .el-select:hover:not(.el-select--disabled) .el-input__wrapper {
  box-shadow: none;
}


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



/* jony code end */

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
.coll{
  position: relative;
  left: 400px;
  display: inline-block;
  top: -36px;
  .image{
    margin-right:30px;
  }
}
:deep .special-btn{
  span{
    width: 100% !important;
  }
}
.time {
  padding: 4px 9px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50px;
  margin-right: 15px;
}

.flex-wrap {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
  flex-direction: row !important;

  .line {
    width: 50%;
    background: #1C1C24;
    /* bgWh/20 */
    padding: 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
  }

}

.pie, .line {
  // margin: 12px 0;
  background: #1C1C24;
  border: 2px solid rgba(255, 255, 255, 0.1019607843);
  border-radius: 16px;
}

@media screen and (max-width: 450px) {
  .coll{
    position: relative;
    left: 298px !important;
    display: inline-block;
    top: 1px !important;
    .image{
      margin-right:30px;
    }
  }
  .wrap-containers {
    display: block !important;
    height: 1050px !important;
    margin-top: 40px !important;
  }

  .top-flex {
    display: block !important;
    height: auto !important;
    padding-bottom: 20px !important;
  }

  .container-flex {
    width: 100% !important;
  }

  .top-flex .bottom-flex div {
    margin-right: 10px;
  }

  .text-list {
    display: -webkit-box ;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2 !important;
    overflow: hidden;
    margin-bottom:20px;
  }

  .bottom-flexs {
    display: block !important;

    .right {
      margin-top: 20px;
      text-align: center;
      padding: 8px 16px;
    }
  }

  .container-right {
    width: 100% !important;
  }

  .right-flex {
    display: block !important;
    padding: 0px !important;
    margin-top: 20px;

    .card {
      width: 100% !important;
    }
  }

  .demo-flex {
    width: 100% !important;
    margin-left: 0px !important;
  }

  .flex-wrap .line {
    width: 100% !important;
    margin-bottom: 15px !important;
  }

  .flex-wrap .pie {
    width: 100% !important;
  }
}

@media screen and (max-width: 768px) {
  .flex-wrap .line {
    width: 100% !important;
    margin-bottom: 15px !important;
  }

  .flex-wrap .pie {
    width: 100% !important;
  }

  .container-right {
    width: 100% !important;
  }

  //.demo-flex {
  //  width: 606px !important;
  //  margin-left: 0px !important;
  //}
  .container-flex {
    width: 100% !important;
  }
}

@media screen and (min-width: 768px) {
  .flex-wrap .line {
    width: 100% !important;
    margin-bottom: 15px !important;
  }

  .flex-wrap .pie {
    width: 100% !important;
  }

  .wrap-containers {
    display: block !important;
    height: 740px !important;
  }

  .container-right {
    width: 100% !important;
  }

  .container-flex {
    width: 100% !important;
  }

  .flex {
    height: 280px !important;
  }


  .right-flex {
    display: flex !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important;
    padding: 0px !important;
    margin-top: 20px !important;

    .card {
      width: 48% !important;
    }
  }

}

@media screen and (min-width: 900px) {

  .flex {
    height: 350px !important;
  }

  .wrap-containers {
    display: flex !important;
    flex-direction: row !important;
    height: 422px !important;
  }

  .flex-wrap {
    display: flex !important;
    flex-direction: row !important;
  }

}

.demo-flex {
  //width: 604px;
  height: 114px;
  background: #121212;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  padding: 20px;
  line-height: 26px;
}

.right-flex {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;

  padding: 16px 16px 0px 0px;

  .card {
    width: 275px;
    height: 114px;
    background: #121212;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    margin-bottom: 10px;
    padding: 20px;
    line-height: 26px;
  }
}

.top-flex {
  height: 120px;
  display: flex;

  .left {
    width: 150px;

    img {
      height: 100px;
      width: 100px;
      border-radius: 50%;
    }
  }

  .bottom-flex {
    display: flex;

    div {
      margin-right: 16px;
      padding: 4px 16px;
      border-radius: 4px;
      background: rgba(255, 255, 255, 0.1);
    }
  }

  .title-flex {
    font-size: 32px;
    height: 80px;
  }
}

.text-list {
  padding: 0 26px;
  line-height: 22px;
  font-size: 16px;
  flex: 1;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 6;
  overflow: hidden;
}

.container-flex {
  width: 48%;
}

.container-right {
  width: 48%;
}

.minting-content {
  margin-top: 20px;
}

.bottom-flexs {
  padding: 0 26px;
  display: flex;
  justify-content: space-between;

  .left {
    display: flex;
    justify-content: space-around;

    .img {
      margin-right: 15px;
    }
  }

  .right {
    background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
    border-radius: 8px;
    padding: 5px 20px;
  }
}

.wrap-containers {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  background: #1C1C24;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  height: 422px;
  margin-bottom: 20px;
  padding: 20px;
  margin-top: 100px;
}



:deep .el-icon {
  color: rgba(255, 255, 255, 0.4) !important;

}

.dialog-wrap {
  display: flex;
  justify-content: flex-end;
  font-size: 16px;

  .left {
    margin-right: 15px;
    line-height: 40px;
  }

  .center {
    margin-right: 15px;
    border: 1px solid rgba(68, 71, 226, 1);
    padding: 8px 15px;
    background: #1C1C24;
    height: 40px;
    border-radius: 8px;
  }

  .right {
    border: 1px solid rgba(68, 71, 226, 1);
    padding: 8px 15px;
    background: #1C1C24;
    border-radius: 8px;
    height: 40px;
  }
}

.card-image {
  img {
    //width:261px ;
    //height:261px;
    border-radius: 16px 16px 0px 0px;
  }
}

.card-text {
  border-radius: 0px 0px 16px 16px;
  background: #1C1C24;
  border-color: rgba(255, 255, 255, 0.1);
  padding: 10px;
  margin-bottom: 15px;
}

.card-text-wrap {
  display: flex;

  .text {
    width: 85%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
}
svg { fill: #fff;width: 30px;
  height: 30px;
  font-size: 30px;
  overflow: inherit;padding-right:10px }





  .btn-buy {
    border: none;
    display: inline-block;
    text-align: center;
    padding: 8px 16px;
    border-radius: 8px;
    background-image: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
    color: #FFFFFF;
    transition: 0.3s;
    cursor: pointer;
  }

  .card-background-dark .badge {
    background-color: #FFFFFF1A;
  }
</style>