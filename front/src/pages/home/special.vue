<template>
  <div class="container">
    <div class="special_box">
      <div class="title">
        <div class="box">
          <div><img src="@/assets/images/icon_title_hotitem.png" alt="logo"></div>
          <div class="tit">熱門項目</div>
        </div>
        <div class="tabs">
          <div v-for="(item,index) in dateList" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="chageTag(item.value)">
                {{item.name}}
          </div>
        </div>
      </div>
      <div class="subtitle" @click="hotRanking()">前往查看</div>
    </div>
    <div class="hot-item-content mt-10">
      <div class="row">
        <div class="col-sm-12  col-lg-4">
          <div class="hot-item-card ">
            <ul class="ranking-list" v-for="(item,index) in hotList" :key="index">
              <!-- 1st -->
              <li class="ranking-item">
                <small class="ranking-sort">0{{index+1}}</small>
                <div class="ranking-picture">
                  <img :src="item.photo_url" alt="">
                </div>
                <div class="ranking-text">
                  <div class="ranking-top">
                  <span class="title-wrap">
                         <span class="ranking-title">{{item.name}}</span>
                   </span>
                    <span class="ranking-value">
                      <span>{{ item.volume_24_p }}%</span>
                </span>
                  </div>
                  <div class="ranking-bottom">
                        <span class="floor-price">
                          <span>Floor price:
                            <span>
                              <span><img :src="item.unit_photo" alt="" class="unitImg">{{item.floor_price}}</span>
                              <span>ETH</span>
                            </span>
                          </span>
                        </span>
                    <span class="now-price">
                      <span>
                        <span><img :src="item.unit_photo" alt="" class="unitImg">{{ item.volume_24}}</span>
                        <span>ETH</span>
                      </span>
                   </span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      <div class="d-none d-lg-block col-sm-6   col-lg-4">
        <div class="hot-item-card ">
          <ul class="ranking-list" v-for="(item,index) in hotListTwo" :key="index">
            <!-- 1st -->
            <li class="ranking-item">
              <small class="ranking-sort">{{index+6}}</small>
              <div class="ranking-picture">
                <img :src="item.photo_url" alt="">
              </div>
              <div class="ranking-text">
                <div class="ranking-top">
                  <span class="title-wrap">
                         <span class="ranking-title">{{item.name}}</span>
                   </span>
                  <span class="ranking-value">
                      <span>{{ item.volume_24_p }}%</span>
                </span>
                </div>
                <div class="ranking-bottom">
                        <span class="floor-price">
                          <span>Floor price:
                            <span>
                              <span><img :src="item.unit_photo" alt="" class="unitImg">{{item.floor_price}}</span>
                              <span>ETH</span>
                            </span>
                          </span>
                        </span>
                  <span class="now-price">
                      <span>
                        <span><img :src="item.unit_photo" alt="" class="unitImg">{{ item.volume_24}}</span>
                        <span>ETH</span>
                      </span>
                   </span>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
       <div class="d-none d-lg-block col-lg-4">
         <div class="hot-item-card ">
           <ul class="ranking-list" v-for="(item,index) in hotListFree" :key="index">
             <!-- 1st -->
             <li class="ranking-item">
               <small class="ranking-sort">{{index+11}}</small>
               <div class="ranking-picture">
                 <img :src="item.photo_url" alt="">
               </div>
               <div class="ranking-text">
                 <div class="ranking-top">
                  <span class="title-wrap">
                         <span class="ranking-title">{{item.name}}</span>
                   </span>
                   <span class="ranking-value">
                      <span>{{ item.volume_24_p }}%</span>
                </span>
                 </div>
                 <div class="ranking-bottom">
                        <span class="floor-price">
                          <span>Floor price:
                            <span>
                              <span><img :src="item.unit_photo" alt="" class="unitImg">{{item.floor_price}}</span>
                              <span>ETH</span>
                            </span>
                          </span>
                        </span>
                   <span class="now-price">
                      <span>
                        <span><img :src="item.unit_photo" alt="" class="unitImg">{{ item.volume_24}}</span>
                        <span>ETH</span>
                      </span>
                   </span>
                 </div>
               </div>
             </li>
           </ul>
         </div>
       </div>

      </div>

      <!-- 前往查看按鈕 (手機顯示) -->
      <div class="mt-10">
        <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none"  @click="hotRanking()" >前往查看</div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from 'vue';
import {useRouter} from 'vue-router';
import {homeApi} from '../../api';
interface IHotListFree{
  photo_url: string;
  name: string;
  volume_24_p: string;
  unit_photo: string;
  floor_price: string;
  volume_24: string;

}
const router = useRouter();
const type = ref(1);
const hotList = ref<IHotListFree[]>([])
const hotListTwo = ref<IHotListFree[]>([])
const hotListFree = ref<IHotListFree[]>([])
const dateList = ref([{name: '24小时', value: 1,}, {name: '7天', value: 2,}, {name: '30天', value: 3}])
const chageTag = async (value: number) => {
  type.value = value
  const res = await homeApi.getHotCollections(type.value);
  hotList.value = res.hot_collections.slice(0, 5);
  hotListTwo.value = res.hot_collections.slice(5,10);
  hotListFree.value = res.hot_collections.slice(10,15);
}
const hotRanking = () => {
  router.push({name: 'HotRanking'})
}
const getHomeHot = async () => {
  const res = await homeApi.getHotCollections(type.value);
   hotList.value = res.hot_collections.slice(0,5);
  hotListTwo.value = res.hot_collections.slice(5,10);
  hotListFree.value = res.hot_collections.slice(10,15);
}
onMounted(() => {
  getHomeHot()
})

</script>

<style scoped lang="less">
@import "./index.less";

</style>