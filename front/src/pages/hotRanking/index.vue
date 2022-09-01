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
                    NFT分析
                  </h2>
                  <p class="subtile mb-6">NFTotal上排名靠前的 NFT，按數量、底價和其他統計數據排名。</p>
                  <div class="tabs">
                    <div v-for="(item,index) in list" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="chageTag(item.value)">
                      {{item.name}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- 熱門排行 -->
            <div class="row" v-show="type === 2">
              <div class="col-12">
                <div class="table-responsive">
                  <div class="table-wrap">
                    <table>
                      <thead class="mb-40">
                      <tr>
                        <th>#</th>
                        <th>項目</th>
                        <th>交易量</th>
                        <th>24H%</th>
                        <th>7D%</th>
                        <th>地板價</th>
                        <th>持有者</th>
                        <th>數量</th>
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
                        <td class="">{{ item.volume_24_p }}%</td>
                        <td class="go-down">-19.18%</td>
                        <td class="go-up">+19.18%</td>
                        <td>3.2 ETH</td>
                        <td>34.4k</td>
                        <td>98.4k</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" v-show="type === 3">
              <div class="col-12">
                <div class="table-responsive">
                  <div class="table-wrap">
                    <table>
                      <thead class="mb-40">
                      <tr>
                        <th>#</th>
                        <th>錢包</th>
                        <th>勝率</th>
                        <th>交易數</th>
                        <th>勝次數</th>
                        <th>敗次數 </th>
                        <th>交易動態</th>
                      </tr>
                      </thead>
                      <tbody>
                      <!-- 1st -->
                      <tr>
                        <th scope="row">01</th>
                        <td class="td-wrap">
                          <div class="td-wrap-content">
                            <p class="single-ellipsis">UNSEEN UNIVERSE Official UNSEEN Official UNSEEN Official UNSEEN Official UNSEEN Official UNSEEN Official</p>
                            <div class="profile-pic ml-6">
                              <img src="@/assets/images/icon_copy.png" alt="">
                            </div>
                          </div>
                        </td>
                        <td class="">2,500.38</td>
                        <td class="">-19.18%</td>
                        <td class="">+19.18%</td>
                        <td>3.2 ETH</td>
                        <td><div class="profile-pic mr-8"> <img src="@/assets/images/link.png" alt=""></div></td>
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
import {homeApi} from '../../api';

interface IHotListFree{
  photo_url: string;
  name: string;
  volume_24_p: string;
  unit_photo: string;
  floor_price: string;
  volume_24: string;

}
const type = ref (2)
const list = ref([{name:'總覽', value:1,}, {name:'熱門排行 ', value:2,}, {name:'高勝率錢包',value:3}])
const chageTag = (value:number) =>{
  type.value = value
}
const hotList = ref<IHotListFree[]>([]);

const getHomeHot = async () => {
  const params ={
    count :30,    //每頁多少筆紀錄  // 用途:讓前端進行下滑分頁使用, 每次分頁撈取30條
    page:1,      // 返回第幾頁的數據
    orderby: 1,//    排序, 默認1   // 1: volume_24  2: volume_7d   3: volume_30d
    orderby_ind: 1,// 排序方向 , 默認1  //1:desc   2:asc
  }
  const res = await homeApi.getHotLists(params);
  hotList.value = res.hot_collections;
}
onMounted(() => {
  getHomeHot()
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
</style>