<template>
  <div class="container">
<!--标题-->
    <div class="minting_box">
      <div class="title">
        <div class="box">
          <div><img src="@/assets/images/icon_title_minting.png" alt="logo"></div>
          <div class="tit">Minting 觀測站</div>
        </div>
      </div>
      <div class="subtitle">前往查看</div>
    </div>
        <div class="minting-content mt-10">
          <!-- 觀測站卡片 -->
          <div class="row">
            <!-- 1st -->
            <div class="col-12 col-sm-6 col-lg-3">
              <div class="card-item card-1">
                <!-- 卡片圖片 -->
                <div class="card-image">
                  <img src="@/assets/images/random_1.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px"></div>
                    <div class="icon_list"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">7</p>
                    <p class="count-down-hour">13</p>
                    <p class="count-down-min">30</p>
                    <p class="count-down-sec">21</p>
                  </div>
                </div>
                <!-- 卡片內文 -->
                <div class="card-text">
                  <!-- icon 圖片 -->
                  <div class="card-text-icon-wrap">
                    <div class="card-icon-img">
                      <img :src="dropsOne?.collection_url" alt="">
                    </div>
                    <p class="heading-B-4 text-white">{{dropsOne?.collection}}</p>
                  </div>
                  <!-- 內文 -->
                  <div class="card-text-wrap">
                    <p class="card-title text-white">
                      {{dropsOne?.introduction}}
                    </p>
                    <p class="card-text  text-white">售價：{{dropsOne?.price}}</p>
                    <p class="card-text  text-white">總量：{{dropsOne?.total}}</p>
                    <p class="card-text text-white">時間：{{dropsOne?.ori_date}}</p>
                  </div>
                  <!-- 卡片icon -->
                  <div class="card-footer">
                    <!-- social-link -->
                    <ul class="social-link-wrap">
                      <!-- icon-group -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toWebsite(dropsOne?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toDiscord(dropsOne?.discord || '')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toTwitter(dropsOne?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="social-link-item">
                        <div class="social-link-icon">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- 2nd -->
            <div class="d-none d-sm-block col-sm-6 col-lg-3">
              <div class="card-item card-1">
                <!-- 卡片圖片 -->
                <div class="card-image">
                  <img src="@/assets/images/random_2.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px"></div>
                    <div class="icon_list"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">11</p>
                    <p class="count-down-hour">9</p>
                    <p class="count-down-min">58</p>
                    <p class="count-down-sec">45</p>
                  </div>
                </div>
                <!-- 卡片內文 -->
                <div class="card-text">
                  <!-- icon 圖片 -->
                  <div class="card-text-icon-wrap">
                    <div class="card-icon-img">
                      <img :src="dropsTwo?.collection_url" alt="">
                    </div>
                    <p class="heading-B-4 text-white">{{dropsTwo?.collection}}</p>
                  </div>
                  <!-- 內文 -->
                  <div class="card-text-wrap">
                    <p class="card-title text-white">
                      {{dropsTwo?.introduction}}
                    </p>
                    <p class="card-text  text-white">售價：{{dropsTwo?.price}}</p>
                    <p class="card-text  text-white">總量：{{dropsTwo?.total}}</p>
                    <p class="card-text text-white">時間：時間待定</p>
                  </div>
                  <!-- 卡片icon -->
                  <div class="card-footer">
                    <!-- social-link -->
                    <ul class="social-link-wrap">
                      <!-- icon-group -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toWebsite(dropsTwo?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toDiscord(dropsTwo?.discord ||'')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toTwitter(dropsTwo?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="social-link-item">
                        <div class="social-link-icon">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- 3rd -->
            <div class="d-none d-lg-block col-lg-3">
              <div class="card-item card-1">
                <!-- 卡片主圖 -->
                <div class="card-image">
                  <img src="@/assets/images/random_3.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px"></div>
                    <div class="icon_list"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">3</p>
                    <p class="count-down-hour">23</p>
                    <p class="count-down-min">1</p>
                    <p class="count-down-sec">32</p>
                  </div>
                </div>
                <!-- 卡片內文 -->
                <div class="card-text">
                  <!-- icon 圖片 -->
                  <div class="card-text-icon-wrap">
                    <div class="card-icon-img">
                      <img :src="dropsFree?.collection_url" alt="">
                    </div>
                    <p class="heading-B-4 text-white">{{dropsFree?.collection}}</p>
                  </div>
                  <!-- 內文 -->
                  <div class="card-text-wrap">
                    <p class="card-title text-white">
                      {{dropsFree?.introduction}}
                    </p>
                    <p class="card-text  text-white">售價：{{dropsFree?.price}}</p>
                    <p class="card-text  text-white">總量：{{dropsFree?.total}}</p>
                    <p class="card-text text-white">時間：時間待定</p>
                  </div>
                  <!-- 卡片icon -->
                  <div class="card-footer">
                    <!-- social-link -->
                    <ul class="social-link-wrap">
                      <!-- icon-group -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toWebsite(dropsFree?.website|| '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toDiscord(dropsFree?.discord ||'')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toTwitter(dropsFree?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="social-link-item">
                        <div class="social-link-icon">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- 4th -->
            <div class="d-none d-lg-block col-lg-3">
              <div class="card-item card-1">
                <!-- 卡片圖片 -->
                <div class="card-image">
                  <img src="@/assets/images/random_1.png" alt="">
                  <div class="card_icon">
                    <div class="icon_list"><img src="@/assets/images/icon_group.png" alt="" width="24px" height="17px"></div>
                    <div class="icon_list"><img src="@/assets/images/icon_map.png" alt="" width="24px" height="17px"></div>
                  </div>
                  <div class="card-time-wrap">
                    <p class="count-down-day">0</p>
                    <p class="count-down-hour">4</p>
                    <p class="count-down-min">51</p>
                    <p class="count-down-sec">20</p>
                  </div>
                </div>
                <!-- 卡片內文 -->
                <div class="card-text">
                  <!-- icon 圖片 -->
                  <div class="card-text-icon-wrap">
                    <div class="card-icon-img">
                      <img :src="dropsForce?.collection_url" alt="">
                    </div>
                    <p class="heading-B-4 text-white">{{dropsForce?.collection}}</p>
                  </div>
                  <!-- 內文 -->
                  <div class="card-text-wrap">
                    <p class="card-title text-white">
                     {{dropsForce?.introduction}}
                    </p>
                    <p class="card-text  text-white">售價：{{dropsForce?.price}}</p>
                    <p class="card-text  text-white">總量：{{dropsForce?.total}}</p>
                    <p class="card-text text-white">時間：時間待定</p>
                  </div>
                  <!-- 卡片icon -->
                  <div class="card-footer">
                    <!-- social-link -->
                    <ul class="social-link-wrap">
                      <!-- icon-group -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toWebsite(dropsForce?.website || '')">
                          <img src="@/assets/images/icon_world.png" alt="">
                        </div>
                      </li>
                      <!-- icon-map -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toDiscord(dropsForce?.discord || '')">
                          <img src="@/assets/images/icon_discord.png" alt="">
                        </div>
                      </li>
                      <!-- icon-homepage -->
                      <li class="social-link-item">
                        <div class="social-link-icon" @click="toTwitter(dropsForce?.twitter || '')">
                          <img src="@/assets/images/icon_twitter.png" alt="">
                        </div>
                      </li>
                      <!-- icon-discord -->
                      <li class="social-link-item">
                        <div class="social-link-icon">
                          <img src="@/assets/images/icons.png" alt="">
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 前往查看按鈕 (手機顯示) -->
          <div class="mt-10">
            <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none">前往查看</div>
          </div>
        </div>
  </div>
</template>

<script setup lang="ts">
import {ref} from "vue";
import { useRouter } from 'vue-router';
import {onMounted } from 'vue'
import {homeApi} from '../../api';
const router = useRouter();
const toWebsite = (url:string) =>{
  if(url === ''){
    return
  }
  window.open(url)
}
const toDiscord = (url:string) =>{
  if(url === ''){
    return
  }
  window.open(url)
}
const toTwitter = (url:string) =>{
  if(url === ''){
    return
  }
  window.open(url)
}
type IInfo ={
  collection_url:string;
  collection:string;
  introduction:string;
  price:string;
  ori_date:string;
  total:string;
  website?:string ;
  discord?:string;
  twitter?:string;
}
const dropsOne = ref<IInfo|null>(null);
const dropsTwo = ref<IInfo|null> (null);
const dropsFree = ref<IInfo|null>(null)
const dropsForce = ref<IInfo|null>(null)
const getHomeWallet =async()=>{
  const res = await homeApi.getDrops({});
  dropsOne.value = res.data[0]
  dropsTwo.value = res.data[1]
  dropsFree.value = res.data[2]
  dropsForce.value = res.data[3]
}

onMounted(() => {
  getHomeWallet()
})
</script>

<style scoped lang="less">
@import "./index.less";

</style>