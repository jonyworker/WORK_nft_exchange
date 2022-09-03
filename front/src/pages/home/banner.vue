<template>
  <div>
    <section class="banner-section">
      <div class="container">
        <div class="banner-content">
          <div class="row flex-lg-row-reverse">
            <!-- banner-pic-5 -->
            <div class="col-12 mb-24 col-lg-6 mb-lg-0">
              <a href="#" style="height: 100%;padding-bottom: 15px;">
                <div class="pic banner-5">
                  <img :src="bannerImg4?.banner_url" alt="">
                </div>
              </a>
            </div>
            <!-- banner-pic-1~4 -->
            <div class="col-12 col-lg-6">
              <div class="row">
                <div class="col-12 mb-16">
                  <!-- banner-pic-1 -->
                  <a href="#">
                    <div class="banner-1">
                      <div class="pic">
                        <img :src="bannerList?.banner_url" alt="">
                      </div>
                      <div class="text-area">
                        <div class="title-group mb-16 mb-sm-24">
<!--                          <h2>Machina マキナ</h2>-->
<!--                          <p>@Machina_NFT</p>-->
                        </div>
                        <p class="mb-4">{{bannerList?.description}}</p>
<!--                        <small>Mar 30, 2022</small>-->
                      </div>
                    </div>
                  </a>
                </div>
                <!-- banner-pic-2 -->
                <div class="col-6 col-sm-4">
                  <a href="#">
                    <div class="banner-2">
                      <img :src="bannerImg1?.banner_url" alt="">
                    </div>
                  </a>
                </div>
                <!-- banner-pic-3 -->
                <div class="d-none d-sm-block col-sm-4">
                  <a href="#">
                    <div class="banner-3">
                      <img :src="bannerImg2?.banner_url" alt="">
                    </div>
                  </a>
                </div>
                <!-- banner-pic-4 -->
                <div class="col-6 col-sm-4">
                  <a href="#">
                    <div class="banner-4">
                      <div class="banner-4-pic">
                        <img :src="bannerImg3?.banner_url" alt="">
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup lang="ts">
import {onMounted } from 'vue'
import {homeApi} from '../../api';
import {  ref } from 'vue';
interface IBanner {
  banner_url:string
  description?:string
}
const bannerImg4 = ref<IBanner|null>(null)
const bannerImg3 = ref<IBanner|null>(null)
const bannerImg2 = ref<IBanner|null>(null)
const bannerImg1 = ref<IBanner|null>(null)
const bannerList = ref<IBanner|null>(null)
const getHomeBanner=async()=>{
  const res = await homeApi.getHomeBanner({})
  bannerList.value = res.banners[0]
  bannerImg1.value = res.banners[1]
  bannerImg2.value = res.banners[2]
  bannerImg3.value = res.banners[3]
  bannerImg4.value = res.banners[4]
}
onMounted(() => {
  getHomeBanner()
})
</script>

<style scoped lang="less">
@import "./index.less";

</style>