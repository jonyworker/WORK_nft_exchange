<template>
  <div class="container">
    <div class="wrap-containers" v-if="panel.data">
      <div class="container-flex">
        <div class="flex">
          <div class="top-flex">
            <div class="left">
              <img :src="panel.data.photo_url">
            </div>
            <div class="right">
              <div class="title-flex">{{ panel.data.name }}</div>
              <div class="bottom-flex">
                <div>{{ panel.data.unit }}</div>
                <div>{{ panel.data.contract.slice(0, 7) }}</div>
                <div>{{ panel.data.item_qty }} NFTs</div>
              </div>
            </div>
          </div>
          <div class="text-list">
            {{ panel.data.introduction }}
          </div>
        </div>
        <div class="bottom-flexs">
          <div class="left">
            <div class="img"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px"></div>
            <div class="img"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
            <div class="img"><img src="@/assets/images/icon_world.png" alt=""></div>
            <div class="img"><img src="@/assets/images/icon_discord.png" alt=""></div>
            <div class="img"><img src="@/assets/images/icon_twitter.png" alt=""></div>
            <div class="img"><img src="@/assets/images/icons.png" alt=""></div>
          </div>
          <div class="right">立即購買</div>
        </div>
      </div>
      <div class="container-right">
        <div class="right-flex">
          <div class="card">
            <div>市值</div>
            <div>${{ panel.data.market_cap }}</div>
            <div>
              <span class="time">24h</span>
              <span>{{ panel.data.market_cap_p * 100 }}%</span>
            </div>
          </div>
          <div class="card">
            <div>持有者</div>
            <div>{{ panel.data.holders }}</div>
            <div>
              <span class="time">24h</span>
              <span>{{ panel.data.holders_p * 100 }}%</span>
            </div>
          </div>
          <div class="card">
            <div>交易額</div>
            <div>${{ panel.data.volume_24 }}</div>
            <div>
              <span class="time">24h</span>
              <span>{{ panel.data.volume_24_p * 100 }}%</span>
            </div>
          </div>
          <div class="card">
            <div>地板價</div>
            <div>${{ panel.data.floor_price }}</div>
            <div>
              <span class="time">24h</span>
              <span>{{ panel.data.floor_price_p * 100 }}%</span>
            </div>
          </div>
        </div>
        <div class="demo-flex">
          <div>項目健康指數</div>
          <div>${{panel.data.health_score}}</div>
          <div>
            <span class="time">24h</span>
            <span>{{ panel.data.health_score * 100 }}%</span>
          </div>
        </div>
      </div>
    </div>
    <!--   图表 -->
    <div class="flex-wrap">
      <div class="line">
        <Line :panel="panel"/>
      </div>
      <div class="pie">
        <Pie :panel="panel"/>
      </div>

    </div>
    <!--    -->
    <div class="dialog-wrap ">
      <div class="left">
        <el-switch v-model="price"/>
        過濾售出價格
      </div>
      <div class="center">
        售出價格區間 &nbsp&nbsp&nbsp&nbsp
        <el-icon>
          <ArrowDownBold/>
        </el-icon>
      </div>
      <div class="right">
        售出價格：低至高 &nbsp&nbsp&nbsp&nbsp
        <el-icon>
          <ArrowDownBold/>
        </el-icon>
      </div>
    </div>
    <div class="minting-content mt-5">
      <!-- 觀測站卡片 -->
      <div class="row">
        <!-- 1st -->
        <div class="col-12 col-sm-6 col-lg-3" v-for="(item,index) in dropsList" :key="index">
          <div class="card-item card-1">
            <!-- 卡片圖片 -->
            <div class="card-image">
              <!--              <img :src="http + dropsOne?.background" alt="">-->
              <img :src="item.photo_url" alt="">
            </div>
            <!-- 內文 -->
            <div class="card-text">
              <div class="card-text-wrap">
                <div class="text"> {{item.price}}  {{item.unit}}</div>
<!--                <div class="text">{{item.permalink}}</div>-->
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
</template>

<script setup lang="ts">

import {onMounted, reactive, ref} from "vue";
import {homePageApi} from "@/api";
import {useRoute} from "vue-router"
import {panelData} from "@/pages/homePage/homePageTypes";
import Line from "@/pages/homePage/line.vue";
import Pie from "@/pages/homePage/pie.vue";

const route = useRoute()
const price = ref()
const panel = reactive<panelData>({} as panelData)
type IInfo = {
  id: string,
  permalink: string,
  photo_url:string,
  price: string,
  unit:string,
  usd_price:string,
}
const dropsList = ref<IInfo[] | null>(null);
const getHomePage = async () => {
  const {id} = route.query
  const res: panelData = await homePageApi.getHomePoster({collectionId: id as string});
  panel.data = res.data
  panel.price_3d = res.price_3d
  panel.price_30d = res.price_30d
  panel.price_3m = res.price_3m
  panel.holder_stat = res.holder_stat

}
const getCard = async()=>{
  const {id} = route.query
  const params = {
    collectionId:id as string,    //項目id
    filter_ind: 2,    // 過濾無價格   1:過濾無價格  2:不過濾
    orderby: 1,      //排序         1:價格低到高  2:價格高到低
    count:30,     //每頁多少筆紀錄
    page:1,
  }
  const res = await homePageApi.postHomeCard({...params});
  dropsList.value = res.data
  console.log("-> res", res);
}
onMounted(() => {
  getHomePage()
  getCard()
})
</script>

<style scoped lang="less">
.time{
  padding: 4px 9px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50px;
  margin-right: 15px;
}
.flex-wrap{
  display: flex;
  justify-content: space-between;
  margin-bottom:20px;
  flex-direction: row !important;
  .line{
    width: 50% ;
    background: #1C1C24;
    /* bgWh/20 */
    padding: 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
  }
  .pie{
    background: #1C1C24;
    width: 48% ;
    /* bgWh/20 */
    padding: 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
  }
}
@media screen and (max-width: 450px) {
  .wrap-containers {
    display: block !important;
    height: 1100px !important;
    margin-top: 40px !important;
  }

  .top-flex {
    display: block !important;
    height: auto !important;
    padding-bottom: 20px !important;
  }

  .container-flex {
    width: 100% !important;
  }

  .top-flex .bottom-flex div {
    margin-right: 10px;
  }

  .text-list {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 5;
    overflow: hidden;
  }

  .bottom-flexs {
    display: block !important;

    .right {
      margin-top: 20px;
      text-align: center;
      padding: 8px 16px;
    }
  }

  .container-right {
    width: 100% !important;
  }

  .right-flex {
    display: block !important;
    padding: 0px !important;
    margin-top: 20px;

    .card {
      width: 100% !important;
    }
  }

  .demo-flex {
    width: 100% !important;
    margin-left: 0px !important;
  }
  .flex-wrap .line{
    width: 100% !important;
    margin-bottom:15px !important;
  }
  .flex-wrap .pie{
    width: 100% !important;
  }
}
@media screen and (max-width: 768px){
  .flex-wrap .line{
    width: 100% !important;
    margin-bottom:15px !important;
  }
  .flex-wrap .pie{
    width: 100% !important;
  }
}
@media screen and (min-width: 768px) {

  .wrap-containers {
    display: block !important;
    height: 740px !important;
  }

  .container-flex {
    width: 100% !important;
  }

  .flex {
    height: 280px !important;
  }

  .container-right {
    width: 100% !important;
  }

  .right-flex {
    display: flex !important;
    justify-content: space-between !important;
    flex-wrap: wrap !important;
    padding: 0px !important;
    margin-top: 20px !important;

    .card {
      width: 48% !important;
    }
  }

  .demo-flex {
    width: 656px !important;
    margin-left: 0px !important;
  }
}

@media screen and (min-width: 900px) {

  .flex {
    height: 350px !important;
  }

  .wrap-containers {
    display: flex !important;
    flex-direction: row !important;
    height: 422px !important;
  }
  .flex-wrap{
    display: flex !important;
    flex-direction: row !important;
  }

}

.demo-flex {
  width: 568px;
  height: 114px;
  background: #121212;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  margin-left: 16px;
  padding: 20px;
  line-height: 26px;
}

.right-flex {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;

  padding: 16px 16px 0px 16px;

  .card {
    width: 275px;
    height: 114px;
    background: #121212;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    margin-bottom: 10px;
    padding: 20px;
    line-height: 26px;
  }
}

.top-flex {
  height: 120px;
  display: flex;

  .left {
    width: 150px;

    img {
      height: 100px;
      width: 100px;
      border-radius: 50%;
    }
  }

  .bottom-flex {
    display: flex;

    div {
      margin-right: 16px;
      padding: 4px 16px;
      border-radius: 4px;
      background: rgba(255, 255, 255, 0.1);
    }
  }

  .title-flex {
    font-size: 32px;
    height: 80px;
  }
}

.text-list {
  padding: 0 26px;
  line-height: 22px;
  font-size: 16px;
  flex: 1;
}

.container-flex {
  width: 48%;
}

.container-right {
  width: 48%;
}

.minting-content {
  margin-top: 20px;
}

.bottom-flexs {
  padding: 0 26px;
  display: flex;
  justify-content: space-between;

  .left {
    display: flex;
    justify-content: space-around;

    .img {
      margin-right: 15px;
    }
  }

  .right {
    background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
    border-radius: 8px;
    padding: 5px 20px;
  }
}

.wrap-containers {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  background: #1C1C24;
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  height: 422px;
  margin-bottom: 20px;
  padding: 20px;
  margin-top: 100px;
}

.container {
  margin-top: 30px !important;
}

:deep .el-icon {
  color: rgba(255, 255, 255, 0.4) !important;

}

.dialog-wrap {
  display: flex;
  justify-content: flex-end;
  font-size: 16px;

  .left {
    margin-right: 15px;
    line-height: 40px;
  }

  .center {
    margin-right: 15px;
    border: 1px solid rgba(68, 71, 226, 1);
    padding: 8px 15px;
    background: #1C1C24;
    height: 40px;
    border-radius: 8px;
  }

  .right {
    border: 1px solid rgba(68, 71, 226, 1);
    padding: 8px 15px;
    background: #1C1C24;
    border-radius: 8px;
    height: 40px;
  }
}

.card-image {
  img {
    border-radius: 16px 16px 0px 0px;
  }
}

.card-text {
  border-radius: 0px 0px 16px 16px;
  background: #1C1C24;
  border-color: rgba(255, 255, 255, 0.1);
  padding: 10px;
  margin-bottom:15px;
}

.card-text-wrap {
  display: flex;

  .text {
    width: 95%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
}
</style>