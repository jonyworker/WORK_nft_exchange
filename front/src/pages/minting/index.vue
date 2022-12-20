 <template>
  <div class="minting-section mt-80">
    <div class="container">
  
      <!-- 標題組 -->
      <div class="row mb-40">
        <div class="col-12 d-flex justify-content-between align-items-center">
          <div class="section-title-wrap flex-column align-items-start">
            <!-- 標題  -->
            <h2 class="section-title color-white mb-8">
              {{$t('home.mint')}}
            </h2>
  
            <p class="section-subTitle color-white mb-24">{{$t('home.mintSub')}}</p>
  
          </div>
        </div>
      </div>

      
      <!-- 小卡片組 -->
      <div class="minting-content mt-10">
        <div class="row">

          <!-- 卡片 -->
          <div class="col-12 col-sm-6 col-lg-3 mb-24" v-for="(item,index) in dropsList" :key="index">
            <div class="card">
              <!-- 卡片圖片 -->
              <div class="card-image">
                <img :src="http + item.background" alt="">
                <div class="card-icon-group">
                  <div class="i-group i-alpha-60 square-28"  @click="toDialog(1,item)"></div>
                  <div class="i-map i-alpha-60 square-28"  @click="toDialog(2,item)"></div>
                </div>
                <CountDown :count_down_date="item.date"/>
              </div>
              <!-- 卡片內文 -->
              <div class="card-body-content p-16">

                <!-- icon 標題組 -->
                <div class="card-icon-title-wrap mb-12 align-items-center">
                  <div class="icon mr-16">
                    <img :src="item.collection_url" alt="">
                  </div>
                  <p class="title card-title-h5 text-white clamp-1">{{ item.collection }}</p>
                </div>
                <!-- 卡片 - 文字 -->
                <p class="card-text-p clamp-3 mb-8" v-html="item.introduction"></p>
                <p class="card-text-p mb-8">{{$t('home.price')}}{{ item.price }}</p>
                <p class="card-text-p mb-8">{{$t('home.total')}}{{ item.total }}</p>
                <p class="card-text-p mb-24">{{$t('home.shortTime')}}{{ item.date }}</p>
                
                <!-- 卡片icon -->
                <div class="mt-auto">
                  <!-- social-link -->
                  <ul class="link-wrap">
                    <!-- icon-group -->
                    <div class="i-earth i-alpha-20 square-28" @click="toWebsite(item.website || '')"></div>
                    <!-- icon-map -->
                    <div class="i-discord i-alpha-20 square-28" @click="toDiscord(item.discord || '')"></div>
                    <!-- icon-homepage -->
                    <div class="i-twitter i-alpha-20 square-28" @click="toTwitter(item.twitter || '')"></div>
                    <!-- icon-discord -->
                    <div class="i-event i-alpha-20 square-28" @click="toSchedule(item.schedule || '')"></div>
                  </ul>
                </div>
              </div>
            </div>
          </div>
  
        </div>
      </div>

      <!-- 彈出視窗 Jony版本 Minting （更新） -->
      <el-dialog v-model="dialogFormVisible">
        <div class="" v-if="$store.state.os.isPc">
          <div class="row" style="height:100%;">
            <!-- 項目資訊集合 -->
            <div class="col-lg-3 col-12" >
              <div class=" flex-lg-column flex-sm-row flex-column align-items-lg-center d-flex mb-24 mb-lg-0">
                <div class="popup-body card-image-content rwd-pic-content radius-half flex-shrink-0  mb-lg-32 mb-sm-0 mb-8 ">
                  <img :src="dataList?.collection_url" alt="">
                </div>
                <div class="justify-content-between flex-column d-flex ml-lg-0 ml-sm-16 ml-0" style="width: -webkit-fill-available;">
                  <!-- 項目名稱 -->
                  <h3 class="heading-B-2 clamp-2 color-white mb-lg-32 mb-auto d-sm-block d-none text-start text-lg-center break-word text-lg-center text-start text-lg-center text-start break-word">{{ dataList?.collection }}</h3>
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
                <div class="popup-text color-white body-L-1" v-if="type === 1" v-html="dataList?.member"></div>
                <div class="popup-text color-white body-L-1" v-if="type === 2" v-html="dataList?.roadmap"></div>
              </div>
            </div>

          </div>
        </div>
      </el-dialog>



    </div>
  </div>
</template>

<script setup lang="ts">

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
const dataList = ref<IInfo>();
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
const toDialog = (val:number,item:any) =>{
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
    //item.shortTime = item.date.split(' ')[1]
    item.shortTime = item.date
    return item
  })
  dropsList.value = list
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



</style>