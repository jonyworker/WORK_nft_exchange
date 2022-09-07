<template>
    <div>
      <div class="all-nft mt-20">
        <div class="container">
          <div class="all-nft-content">

            <!-- 標題組 -->
            <div class="row mb-5">
              <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="title-wrap">
                  <h2 class="title-set mb-6">
                    {{$t('home.analysis')}}
                  </h2>
                  <p class="subtile mb-6">{{$t('home.newsList')}}</p>
                  <div class="tabs">
                    <div v-for="(item,index) in tabs" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeTag(item.value)">
                      {{item.name}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 熱門排行 -->
            <div class="row" v-show="type === 2">
              <div class="tabs">
                <div v-for="(item,index) in textList" :key="index" :class="['tag',date===item.value?'active_tag':'']" @click="changeDate(item.value)" v-show="index < 3">
                  {{item.name}}
                </div>
              </div>
              <div class="col-12">
                <div class="table-responsive">
                  <div class="table-wrap">
                    <table>
                      <thead class="mb-40">
                      <tr>
                        <th>#</th>
                        <th>{{$t('home.demo')}}</th>
                        <th>
                          {{$t('home.tradingVolume')}}
                          <span @click="toArrow(1)" v-if="row === 2"><el-icon><ArrowUp /></el-icon></span>
                          <span @click="toArrow(2)" v-if="row === 1"><el-icon><ArrowDown /></el-icon></span>
                          </th>
                        <th>24H%</th>
                        <th>7D%</th>
                        <th>{{$t('home.floorPrice')}}</th>
                        <th>{{$t('home.holder')}}</th>
                        <th>{{$t('home.number')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      <!-- 1st -->
                      <tr v-for="(item,index) in hotList" :key="index">
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
            <div class="row" v-show="type === 3">
              <div class="tabs">
                <div v-for="(item,index) in textList" :key="index" :class="['tag',date ===item.value?'active_tag':'']" @click="changeDate(item.value)" v-show="index < 3">
                  {{item.name}}
                </div>
              </div>
              <div class="col-12">
                <div class="table-responsive">
                  <div class="table-wrap">
                    <table>
                      <thead class="mb-40">
                      <tr>
                        <th>#</th>
                        <th>{{$t('home.wallet')}}</th>
                        <th>{{$t('home.winningRate')}}</th>
                        <th>{{$t('home.transactions')}}</th>
                        <th>{{$t('home.wins')}}</th>
                        <th>{{$t('home.failures')}}</th>
                        <th>{{$t('home.tradingDynamics')}}</th>
                      </tr>
                      </thead>
                      <tbody>
                      <!-- 1st -->
                      <tr v-for="(item,index) in walletList" :key="index">
                        <th scope="row">0{{index + 1}}</th>
                        <td class="td-wrap">
                          <div class="td-wrap-content">
                            <div class="parent">
                              <div class='parent-main'>
                                <span class='prev-span'>{{item.address.slice(0, 9)}}</span>
                                <span class='next-span'>{{item.address.slice(-6)}}</span>
                              </div>
                            </div>
                            <div class="profile-pic ml-6" @click="copyInfo(item.address)">
                              <img src="@/assets/images/icon_copy.png" alt="">
                            </div>
                          </div>
                        </td>
                        <td class="">{{item.win_p}}</td>
                        <td class="">{{item.txn_ct}}</td>
                        <td class="">{{item.win_ct}}</td>
                        <td>{{item.lost_ct}}ETH</td>
                        <td><div class="profile-pic mr-8" @click="toLink(item.other_txns)"> <img src="@/assets/images/link.png" alt=""></div></td>
                      </tr>
                      </tbody>
                    </table>
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
import { useRouter } from 'vue-router';
import {homeApi} from '../../api';
import {copy} from "@utils/copy";
const router = useRouter();

interface IHotListFree{
  photo_url: string;
  name: string;
  volume_24_p: string;
  unit_photo: string;
  floor_price: string;
  volume_24: string;
  volume_7d:string;
  volume_30d:string;
  holders:string;
  volume_7d_p:string;
}
interface  IProfit{
  id: string; //profit_stat.id
  period: string;  // profit_stat.period
  address: string;  // profit_stat.address
  win_p: string;// profit_stat.win_p
  txn_ct: string;
  win_ct: string;
  lost_ct: string;
  other_txns: string;
  item_qty:string;
}
interface IText {
  name: string
  value: string
}
//获取文本tab
const textList = ref<IText[]>();
const tabs = ref<IText[]>()
const getTextList = async() =>{
  const res = await homeApi.getText();
  textList.value = res.period;
  tabs.value = res.tab
}
const ps = router.currentRoute.value.query.type;
const type = ref ( 2);
const date = ref(3);
const row = ref(1)
const toArrow = async(val:number) =>{
  row.value = val;
  const params ={
    count :10,    //每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
    page:1,      // 返回第幾頁的數據
    orderby: date.value,//    排序, 默認1   // 1: volume_24  2: volume_7d   3: volume_30d
    orderby_ind: row.value,// 排序方向 , 默認1  //1:desc   2:asc
  }
  const res = await homeApi.getHotLists(params);
  hotList.value = res.hot_collections;
}
const changeTag = (value:number) =>{
  type.value = value
}
const copyInfo=(info:string)=>{
  copy(info)
}
const changeDate = async(value:number) =>{
  date.value = value;
  if(type.value === 2){
    const params ={
      count :10,    //每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
      page:1,      // 返回第幾頁的數據
      orderby: date.value,//    排序, 默認1   // 1: volume_24  2: volume_7d   3: volume_30d
      orderby_ind: row.value,// 排序方向 , 默認1  //1:desc   2:asc
    }
    const res = await homeApi.getHotLists(params);
    hotList.value = res.hot_collections;
  }else if(type.value === 3){
    const params ={
      count :30,    //每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
      page:1,      // 返回第幾頁的數據
      ind : date.value,  // 週期, 默認4   // 1: 24h  2:7d   3:30d  4:60d
      orderby:  date.value , //排序, 默認1   // 1: win_p  2: win_ct   3: txn_ct
      orderby_ind: 1 ,// 排序方向 , 默認1  //1:desc   2:asc
    }
    const res = await homeApi.getProfitList(params);
    walletList.value = res.high_profit
  }

}

const hotList = ref<IHotListFree[]>();
const walletList = ref<IProfit[]>();

const getHomeHot = async () => {
  const params ={
    count :10,    //每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
    page:1,      // 返回第幾頁的數據
    orderby: date.value,//    排序, 默認1   // 1: volume_24  2: volume_7d   3: volume_30d
    orderby_ind: 1,// 排序方向 , 默認1  //1:desc   2:asc
  }
  const res = await homeApi.getHotLists(params);
  hotList.value = res.hot_collections;
}
const getProfig = async () =>{
  const params ={
      count :30,    //每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
      page:1,      // 返回第幾頁的數據
    ind : date.value,  // 週期, 默認4   // 1: 24h  2:7d   3:30d  4:60d
    orderby:  date.value , //排序, 默認1   // 1: win_p  2: win_ct   3: txn_ct
    orderby_ind: 1 ,// 排序方向 , 默認1  //1:desc   2:asc
}
  const res = await homeApi.getProfitList(params);
  walletList.value = res.high_profit
}
const toLink = (url:string) =>{
  window.open(url)
}
onMounted(() => {
  getProfig()
  getHomeHot()
  changeTag(Number(ps))
  getTextList()
})
</script>

<style scoped lang="less">

.title-wrap .subtile {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.4;
  letter-spacing: 0;
  color: rgba(255, 255, 255, 0.3490196078);
}
.title-wrap .subtile {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .title-wrap .subtile {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .title-wrap .subtile {
    font-size: 18px;
  }
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
</style>