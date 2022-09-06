<template>
  <div class="container">
    <div class="special_box">
      <div class="title">
        <div class="box">
          <div><img src="@/assets/images/icon_title_hotitem.png" alt="logo"></div>
          <div class="tit">{{$t('home.hot_item')}}</div>
        </div>
        <div class="tabs">
          <div v-for="(item,index) in dateList" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="chageTag(item.value)">
                {{item.name}}
          </div>
        </div>
      </div>
      <div class="subtitle" @click="hotRanking()">{{$t('home.toView')}}</div>
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
        <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none"  @click="hotRanking()" >{{$t('home.toView')}}</div>
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
  router.push({name: 'HotRanking',query:{type:2}})
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
.special_box{
  display: flex;
  justify-content:space-between;
  margin-top: 82.5px;
}

.hot-item-content{
  padding-top: 42.5px;
  //display: flex;
  //flex-direction: column;
  //width:416px;
}
 .hot-item-card {
  background-color: #1C1C24;
  border-radius: 16px;
  padding: 12px 24px;
}

.ranking-item {
  display: flex;
  align-items: center;
  gap: 8px;
  color: rgba(255, 255, 255, 0.3490196078);
  padding: 12px 0;
}

 .ranking-item .ranking-sort {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
  color: rgba(255, 255, 255, 0.3490196078);
}
 .ranking-item .ranking-sort {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .ranking-item .ranking-sort {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
 .ranking-item .ranking-sort {
    font-size: 18px;
  }
}

 .ranking-item .ranking-picture {
  flex: 0 0 50px;
   width:38px;
 height:38px;
   img{
     width:38px;
     height:38px;
     border-radius:50%;
   }
}

.ranking-item .ranking-text {
  width: 100%;
  min-width: 50%;
  display: flex;
  flex-direction: column;
}

 .ranking-item .ranking-top,
.ranking-item .ranking-bottom {
  display: flex;
  flex-wrap: nowrap;
  align-items: center;
  justify-content: space-between;
}

 .ranking-item .ranking-top .title-wrap {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
  color: #FFFFFF;
  max-width: 100%;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  margin-right: 8px;
}
 .ranking-item .ranking-top .title-wrap {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .ranking-item .ranking-top .title-wrap {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .ranking-item .ranking-top .title-wrap {
    font-size: 18px;
  }
}

.ranking-item .ranking-top .ranking-title {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
  color: #FFFFFF;
  white-space: nowrap;
  text-overflow: ellipsis;
}
 .ranking-item .ranking-top .ranking-title {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
 .ranking-item .ranking-top .ranking-title {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .ranking-item .ranking-top .ranking-title {
    font-size: 18px;
  }
}

.ranking-item .ranking-top .ranking-value {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
  color: #14D400;
  white-space: nowrap;
}
.ranking-item .ranking-top .ranking-value {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .ranking-item .ranking-top .ranking-value {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
   .ranking-item .ranking-top .ranking-value {
    font-size: 18px;
  }
}

</style>