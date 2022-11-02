 <template>
<div>
  <!-- 個人資料-背景 -->
  <div class="container-fluid">
    <div class="row">
      <div class="personal-bg"></div>
    </div>
  </div>

  <!-- 個人資料-頭像 / 資料 -->
  <div class="container">
    <div class="row">
      <div class="personal-page col-12">

        <div class="personal-page-content-1">
          <!-- 頭像 -->
          <div class="avatar-wrap mb-32">
            <div class="avatar">
              <img-upload
                  ref="uploadRef"
                  :show-icon="false"
                  v-model="avatar"
                  
                  :can-clip="false"
                  accept=".png"
              >
              </img-upload>
            </div>
          </div>
          <div class="personal-info-text-content pb-40  align-items-start">
            <!-- 使用者名稱 -->
            <div class="d-lg-flex align-items-center d-flex-column">
              <div class="heading-B-2 mr-24 color-white">使用者自訂名稱</div>
              <!-- 錢包地址 -->
              <div class="d-flex mt-lg-0 mt-8">
                <div class="body-B-1 clamp-single color-white" style="width: 130px;">{{username}}</div>
                <div class=" ml-8 i-copy bg-alpha-white-55 square-24"></div>
              </div>
            </div>
            
            <!-- setting icon -->
            <el-icon class="ml-auto" style="">
              <Setting/>
            </el-icon>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="container">

    


    <!-- 分頁選單 -->
    <div class="tabs">
      <div v-for="(item,index) in textList" :key="index" :class="['tages',type===item.value?'active_tages':'']" @click="changeTag(item.value)">
        {{item.name}}
      </div>
    </div>
    <!-- 分頁內容 type-1 -->
    <div class="row" v-show="type === 1">
      <div class="col-12">
        <div class="table-responsive">
          <div class="table-wrap">
            <table>
              <thead class="mb-40">
              <tr>
                <th>#</th>
                <th>{{$t('home.demo')}}</th>  
                <th>{{$t('home.floorPrice')}}</th>
                <th>
                  7d值
                </th>
                <th>24H%</th>
                <th>7D%</th>
                <th>Owners</th>
                <th>items</th>
              </tr>
              </thead>
              <tbody>

              <tr v-for="(item,index) in analysisList" :key="index">
                <th scope="row">0{{index + 1}}</th>
                <!-- 項目 -->
                <td class="td-wrap">
                  <div class="td-wrap-content">
                    <div class="profile-pic mr-8">
                      <img :src="item.photo_url" alt="">
                    </div>
                    <p class="single-ellipsis">{{item.name}}</p>
                  </div>
                </td>
                <!-- 地板價 -->
                <td class="">{{ item.floor_price }}</td>
                <!-- 7d值 -->
                <td :class="Number(item.volume_7d) > 0 ? 'go-down' : 'red'">{{item.volume_7d}}</td>
                <!-- 24H% -->
                <td :class="Number(item.volume_24_p) > 0 ?'go-up': 'red'">{{item.volume_24_p}}</td>
                <!-- 7d% -->
                <td>{{item. volume_7d_p}}</td>
                <!-- Owners -->
                <td>{{item.holders}}</td>
                <!-- Items -->
                <td>{{item.item_qty}}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- 分頁內容 type-2 -->
    <div class="row" v-show="type === 2">
      
      <!-- 1st -->
      <div class="col-12 col-sm-6 col-lg-3" v-for="(item,index) in dropsList" :key="index">
        <div class="card">
          <!-- 卡片圖片 -->
          <div class="card-image-content ratio--1_1">
            <img :src="item.photo_url" alt="">
          </div>
          
          <!-- 卡片內文 -->
          <div class="card-body-content p-16">

            <!-- icon 標題組 -->
            <div class="card-icon-title-wrap align-items-center mb-12">
              <!-- 項目方名稱 -->
              <p class="title card-title-h5 text-white clamp-1">{{item.collection_name}}</p>
              <!-- 愛心icon -->
              <div class="i i-24 i-white i-like" @click="toNftRemove(item.id)"></div>
            </div> 
            <!-- 卡片 - 文字 -->
            <p class="card-text-p">{{item.token_id}}</p>
            
            
          </div>
        </div>
      </div>



      <!-- Lynn做的 -->
      <div class="minting-content mt-10">

        <div class="row">

          <div class="col-12 col-sm-6 col-lg-3" v-for="(item,index) in dropsList" :key="index">
            <div class="card-item card-1 mb-10" >
              
              <div class="card-image">
                <img :src="item.photo_url" alt="">
              </div>

              <div class="card-text">
                <div class="card-text-wrap">
                  
                  <div class="text">{{item.collection_name}}</div>
                  <div class="image" @click="toNftRemove(item.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" height="38" width="38">
                      <path d="m21.95 40.2-2.65-2.45Q13.1 32 8.55 26.775T4 15.85q0-4.5 3.025-7.525Q10.05 5.3 14.5 5.3q2.55 0 5.05 1.225T24 10.55q2.2-2.8 4.55-4.025Q30.9 5.3 33.5 5.3q4.45 0 7.475 3.025Q44 11.35 44 15.85q0 5.7-4.55 10.925Q34.9 32 28.7 37.75l-2.65 2.45q-.85.8-2.05.8-1.2 0-2.05-.8Z"/>
                    </svg>
                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import {homeApi, homePageApi} from "@/api";
import {copy} from "@utils/copy";
import {IInfo,IPanelList} from "./analysisType";
import {useRouter} from "vue-router";

const type = ref(1);
let http = 'http://v2admin.nftotal.io/';
const router = useRouter();
const analysisList = ref<IPanelList[] >([])
const dropsList = ref<IInfo[] | null>(null);
const textList = ref([{name:'追蹤項目',value:1,},{name:'追蹤NFT',value:2}]);
const toLogin = ref({});
const avatar = ref('')
const username = localStorage.getItem('username');
const ps = router.currentRoute.value.query.type;
const changeTag = async (value: number) => {
  type.value = value
}
const copyInfo=(info:string)=>{
  copy(info)
}
//收藏
const toNft = async(id:string) =>{
  const params ={
    nftId:id,
  }
  const res = await  homePageApi.addNft(params);
  getAnalysis()
}
//移除收藏
const toNftRemove = async(id:string) =>{
  const params ={
    nftId:id,
  }
  const res = await  homePageApi.removeNft(params);
  getAnalysis()
}
const collection = async ()=>{
  const res = await homeApi.getCollection()
  analysisList.value  = res.data

}

const getAnalysis = async () => {
  const res = await homeApi.postMember();
  dropsList.value = res.data
}

onMounted(() => {
  getAnalysis()
  collection()
  changeTag(Number(ps))
})

</script>

<style scoped lang="less">
//  svg { fill: #fff;width: 30px;
//    height: 30px;
//    font-size: 30px;
//    overflow: inherit;padding-right:10px }
//  .minting-content{
//    margin-top: 30px;
//  }
//  .red{
//    color:red;
//  }
// .container{
//   position: relative;
// }
:deep .el-icon {
  color: white;
}

.analysis{
  height: 364px;
  background: #D9D9D9;
  position: relative;
  top:30px;
}
.top-image{
  position: absolute;
  top: -59px;
  img{
    width: 100px;
    height: 100px;
    border-radius: 50%;
  }
}
.tabs{
  display:flex;
  font-size:16px;
  margin-top:15px;height: 40px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.2)
}
.tages{
  margin-right:10px;
  padding: 4px 14px;
  height:30px;
  line-height:21px;
  color: rgba(255, 255, 255, 0.35);
  font-weight:400;
  marigin-bottom:10px;
}
.tages:hover{

}
.active_tages{
  color: #fff;
  height: 40px;
  border-bottom: 2px solid  #4447E2;
}
.card-image{
  img{
    border-radius: 16px 16px 0px 0px;
  }

}
.card-text{
  border-radius: 0px 0px 16px 16px;
  background: #1C1C24;
  border-color: rgba(255, 255, 255, 0.2);
  padding:20px 10px;
}
.card-text-wrap{
  display: flex;
  .text{
    width: 85%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow:ellipsis;
  }
}
.head-wrap{
  display: flex;
}
.wrap{
  width: 98%;
  display: flex;
  padding-top: 50px;
  padding-bottom: 50px;
  .tit{
    font-size: 32px;
    font-weight: 700;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
.wrap-item{
  display: flex;
  margin-left: 20px;
}
.parent{
  width: 128px;
  height: 36px;
  line-height: 36px;
  text-align: left;
  .parent-main{
    width: 100%;
    height: 36px;
    display: flex;
    overflow: hidden;
    .prev-span{
      display: block;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    .next-span{
      display: block;
      white-space: nowrap;
    }
  }
}
// .profile-pic{
//   width: 50px;
//   height: 50px;
//   img{
//     width: 19px;
//     height: 22px;
//     margin-top: 16px;
//     margin-left: 10px;
//     border-radius:50%;
//   }
// }
// .right-image{
//   padding-top: 50px;
//   text-align: right;
//   line-height: 40px;
//   font-size: 32px;
//   margin-top: 10px;
// }




.card-image-content {
  border-radius: 16px 16px 0px 0px;
}
.card-body-content {
    background-color: #1c1c24;
    border-radius: 0px 0px 16px 16px;
    color: rgba(255,255,255,.9);
    border: 2px solid rgba(255,255,255,.1019607843);
    border-top: none;
}
</style>