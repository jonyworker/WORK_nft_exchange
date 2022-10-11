<template>
  <div class="wallet-section section mb-80">
    <div class="container">
      <div class="wallet-content content">
        
        <!-- 標題組 -->
        <div class="row mb-40">
          <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="title-wrap d-flex flex-column flex-md-row align-items-md-center ">
              <!-- 標題  -->
              <div class="section-title-wrap mr-24" @click="toAnalysis()">
                <div class="title-icon">
                  <img src="@/assets/images/icon_title_wallet.png" alt="logo">
                </div>
                <h2 class="section-title color-white" >{{$t('home.highWinningWallet')}}</h2>
              </div>

              <!-- 子選項 -->
              <div class="tabs">
                <div v-for="(item,index) in textList" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="changeTag(item.value)">
                  {{item.name}}
                </div>
              </div>
            </div>

            <!-- 前往查看按鈕 -->
            <div class="d-none d-sm-block">
              <a class="btn btn-bold btn-outline" @click="hotRanking()">{{$t('home.toView')}}</a>
            </div>
          </div>  
        </div>


        <div class="table-responsive">
          <div class="table-wrap">
            <table>
              <thead class="mb-40">
              <tr>
                <th></th>
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
                <td>

                  <div class="td-wrap-content">
                    <div class="parent">
                      <div class='parent-main'>
                        <span class='prev-span'>{{item.address.slice(0, 9)}}</span>
                        <span class='next-span'>{{item.address.slice(-6)}}</span>
                      </div>
                    </div>
<!--                      <p class="single-ellipsis">{{item.address}}</p>-->
                    <div class="profile ml-8" @click="copyInfo(item.address)">
                      <img width="20px" height="20px" src="@/assets/images/icon_copy.png" alt="">
                    </div>
                  </div>
                </td>
                <td>{{item.win_p}}</td>
                <td>{{item.txn_ct}}</td>
                <td>{{item.win_ct}}</td>
                <td>{{item.lost_ct}}</td>
                <td>
                  <div class="profile-pic"> <img src="@/assets/images/link.png" alt="" @click="toLink(item.other_txns)"></div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- 前往查看按鈕 (手機顯示) -->
      <div class="mt-10">
        <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none" @click="hotRanking()">{{$t('home.toView')}}</div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import {homeApi} from '../../api';
import {copy} from '@utils/copy'
const router = useRouter();
const type = ref(4);
const props = defineProps({
  textList: {
    default: function() {
      return null
    },
    type: Array<{name:string,value:number}>
  },
})
interface IWallet {
  address: string
  win_p: string
  txn_ct: string
  win_ct: string
  lost_ct: string
  other_txns: string
}

const walletList = ref<IWallet[]>([]);
const copyInfo=(info:string)=>{
  copy(info)
}
const changeTag = async (value: number) => {
  type.value = value
  const res = await homeApi.getWallet(type.value);
  walletList.value = res.high_profit
}
const toAnalysis = () =>{
  console.log("-> ssss", );
  router.push({name: 'Analysis',})
}
const hotRanking = () => {
  router.push({name: 'HotRanking',query:{type:3}})
}
const getHomeWallet = async () => {
  const res = await homeApi.getWallet(type.value);
  walletList.value = res.high_profit

}
//跳转
const toLink = (value: string) => {
  window.open(value);
}
onMounted(() => {
  getHomeWallet()
})
</script>

<style scoped lang="less">
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
  .profile-pic img{
    width: 28px;
  }
  .profile {
    width: 16px;
  }
</style>