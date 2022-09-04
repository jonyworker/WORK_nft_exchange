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
                <div class="tit">高勝率錢包</div>
              </div>
              <div class="tabs">
                <div v-for="(item,index) in dateList" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="chageTag(item.value)">
                  {{item.name}}
                </div>
              </div>
            </div>
            <div class="subtitle" @click="hotRanking()">前往查看</div>
          </div>
          <div class="table-responsive">
            <div class="table-wrap">
              <table>
                <thead class="mb-40">
                <tr>
                  <th></th>
                  <th>錢包</th>
                  <th>勝率</th>
                  <th>交易數</th>
                  <th>勝次數</th>
                  <th>敗次數</th>
                  <th>交易動態</th>
                </tr>
                </thead>
                <tbody>
                <!-- 1st -->
                <tr v-for="(item,index) in walletList" :key="index">
                  <th scope="row">0{{index + 1}}</th>
                  <td>

                    <div class="td-wrap-content">
                      <p class="single-ellipsis">{{item.address}}</p>
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
          <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none" @click="hotRanking()">前往查看</div>
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

</style>