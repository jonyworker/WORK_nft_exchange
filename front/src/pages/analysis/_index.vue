<template>
<div >
  <div class="analysis"></div>
  <div class="container">
    <div class="top-image">
      <img src="@/assets/images/nft_profile_3.png" alt="">
    </div>
    <div class="head-wrap">
      <div class="wrap">
        <div class="tit">使用者自訂名稱</div>
        <div class="wrap-item">
          <div class="parent">
            <div class='parent-main'>
<!--              <span class='prev-span'>{{item.address.slice(0, 9)}}</span>-->
<!--              <span class='next-span'>{{item.address.slice(-6)}}</span>-->
            </div>
          </div>
          <div class="profile-pic ml-6" @click="copyInfo('1')">
            <img src="@/assets/images/icon_copy.png" alt="">
          </div>
        </div>
      </div>
      <div class="right-image">...</div>
    </div>
    <div class="tabs">
      <div v-for="(item,index) in textList" :key="index" :class="['tages',type===item.value?'active_tages':'']" @click="changeTag(item.value)">
        {{item.name}}
      </div>
    </div>
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
                  {{$t('home.tradingVolume')}}
                </th>
                <th>24H%</th>
                <th>7D%</th>
                <th>Owners</th>
                <th>items</th>
              </tr>
              </thead>
              <tbody>
              <!-- 1st -->
              <tr v-for="(item,index) in analysisList" :key="index">
                <th scope="row">0{{index + 1}}</th>
                <td class="td-wrap">
                  <div class="td-wrap-content">
                    <div class="profile-pic mr-8">
                      <img :src="item.photo_url" alt="">
                    </div>
                    <p class="single-ellipsis">{{item.name}}</p>
                  </div>
                </td>
                <td class="" v-if="date === 1">{{ item.volume_24_p }}</td>
                <td class="" v-if="date === 2">{{ item.volume_7d }}</td>
                <td class="" v-if="date === 3">{{ item.volume_30d}}</td>
                <td class="go-down">{{item.volume_24_p}}</td>
                <td class="go-up">{{item.volume_7d_p}}</td>
                <td>{{item.holders}}</td>
                <td>{{item.floor_price}}</td>
                <td>{{item.item_qty}}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div v-show="type === 2">
      <div class="minting-content mt-10">
        <!-- 觀測站卡片 -->
        <div class="row">
          <!-- 1st -->
          <div class="col-12 col-sm-6 col-lg-3" v-for="(item,index) in dropsList" :key="index">
            <div class="card-item card-1" >
              <!-- 卡片圖片 -->
              <div class="card-image">
                <!--              <img :src="http + dropsOne?.background" alt="">-->
                <img src="@/assets/images/random_1.png" alt="">
              </div>
                <!-- 內文 -->
                <div class="card-text">
                  <div class="card-text-wrap">
                    <div class="text">動態項目方名稱動態項目方名...</div>
                    <div class="image"><img src="@/assets/images/icon_favorite.png" alt=""></div>
                  </div>
                  <div>
                    #1234
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
import {homeApi} from "@/api";
import {copy} from "@utils/copy";
type IInfo = {
  background:string;
  collection_url: string;
  collection: string;
  introduction: string;
  price: string;
  ori_date: string;
}
const type = ref(1);
const analysisList = ref({})
const dropsList = ref<IInfo[] | null>(null);
const textList = ref([{name:'追蹤項目',value:1,},{name:'追蹤NFT',value:2}]);
const changeTag = async (value: number) => {
  type.value = value
}
const copyInfo=(info:string)=>{
  copy(info)
}
const getAnalysis = async () => {
  const res = await homeApi.getDrops({});
  const list = res.data.map((item: { shortTime: any; date: string; }) => {
    item.shortTime = item.date.split(' ')[1]
    return item
  })
  dropsList.value = list
}

onMounted(() => {
  getAnalysis()
})

</script>

<style scoped lang="less">
.container{
  position: relative;
}
.analysis{
  height: 364px;
  background: #D9D9D9;
}
.top-image{
  position: absolute;
  top: -155px;
  img{
    width: 190px;
    height: 190px;
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
  padding: 10px;
}
.card-text-wrap{
  display: flex;
  .text{
    width: 95%;
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
  }
}
.wrap-item{
  display: flex;
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
.profile-pic{
  width: 50px;
  height: 50px;
  img{
    width: 19px;
    height: 22px;
    margin-top: 20px;
  }
}
.right-image{
  padding-top: 50px;
  text-align: right;
  line-height: 40px;
  font-size: 32px;
  margin-top: 10px;
}
</style>