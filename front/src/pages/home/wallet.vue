<template>
  <div>
    <div class="wallet-section">
      <div class="container">
        <div class="wallet-content">
          <!-- 標題組 -->
          <div class="wallet_box">
            <div class="title">
              <div class="box">
                <div><img src="@/assets/images/icon_title_wallet.png" alt="logo"></div>
                <div class="tit">{{$t('home.highWinningWallet')}}</div>
              </div>
              <div class="tabs">
                <div v-for="(item,index) in dateList" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="chageTag(item.value)">
                  {{item.name}}
                </div>
              </div>
            </div>
            <div class="subtitle" @click="hotRanking()">{{$t('home.toView')}}</div>
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
                      <div class="profile-pic ml-6" @click="copyInfo(item.address)">
                        <img src="@/assets/images/icon_copy.png" alt="">
                      </div>
                    </div>
                  </td>
                  <td>{{item.win_p}}</td>
                  <td>{{item.txn_ct}}</td>
                  <td>{{item.win_ct}}</td>
                  <td>{{item.lost_ct}}</td>
                  <td>
                    <div class="profile-pic mr-8"> <img src="@/assets/images/link.png" alt="" @click="toLink(item.other_txns)"></div>
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
  </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import {homeApi} from '../../api';
import {copy} from '@utils/copy'
const router = useRouter();
const type = ref(4);

interface IWallet {
  address: string
  win_p: string
  txn_ct: string
  win_ct: string
  lost_ct: string
  other_txns: string
}

const walletList = ref<IWallet[]>([]);
const dateList = ref([{name: '24小时', value: 1,}, {name: '7天', value: 2,}, {name: '30天', value: 3}, {
  name: '60天',
  value: 4
}])
const copyInfo=(info:string)=>{
  copy(info)
}
const chageTag = async (value: number) => {
  type.value = value
  const res = await homeApi.getWallet(type.value);
  walletList.value = res.high_profit
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
</style>