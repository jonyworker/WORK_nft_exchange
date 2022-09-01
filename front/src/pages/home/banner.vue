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

<style scoped>
.banner-content{
  padding-top: 40px;
}
.banner-content .banner-1 {
  padding: 20px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  gap: 16px;
  border: 4px solid transparent;
  border-radius: 20px;
  background: -webkit-gradient(linear, left top, left bottom, from(#1C1C24), to(#1C1C24)) padding-box, -webkit-gradient(linear, left top, left bottom, from(var(--rotate-angle)), color-stop(-16.15%, #CB12F2), color-stop(49.76%, #121212), color-stop(112.97%, #7512F2)) border-box;
  background: linear-gradient(#1C1C24, #1C1C24) padding-box, linear-gradient(var(--rotate-angle), #CB12F2 -16.15%, #121212 49.76%, #7512F2 112.97%) border-box;
  position: relative;
}

.banner-content .banner-1::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  -webkit-transform: scale(1.03, 1.05);
  transform: scale(1.03, 1.05);
  z-index: -1;
  -webkit-filter: blur(10px);
  filter: blur(10px);
  background: -webkit-gradient(linear, left top, left bottom, from(var(--rotate-angle)), color-stop(-16.15%, #CB12F2), color-stop(49.76%, #121212), color-stop(112.97%, #7512F2)) padding-box;
  background: linear-gradient(var(--rotate-angle), #CB12F2 -16.15%, #121212 49.76%, #7512F2 112.97%) padding-box;
  opacity: 0;
  -webkit-transition: opacity .2s;
  transition: opacity .2s;
}

.banner-content .banner-1:hover,
.banner-content .banner-1:hover::before {
  -webkit-animation-duration: 0.5s;
  animation-duration: 0.5s;
  -webkit-animation-name: rotate;
  animation-name: rotate;
  -webkit-animation-timing-function: ease-in;
  animation-timing-function: ease-in;
}

.banner-content .banner-1:hover::before {
  opacity: .7;
}

@-webkit-keyframes rotate {
  0% {
    --rotate-angle:101.97deg;
  }
  100% {
    --rotate-angle:281.97deg;
  }
}

@keyframes rotate {
  0% {
    --rotate-angle:101.97deg;
  }
  100% {
    --rotate-angle:281.97deg;
  }
}

.banner-content .banner-1 .pic {
  min-width: 64.968%;
  border-radius: 16px;
  overflow: hidden;
}

.banner-content .banner-1 .pic img {
  -o-object-fit: cover;
  object-fit: cover;
}

.banner-content .banner-1 .text-area .title-group h2 {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
  color: #FFFFFF;
}

.banner-content .banner-1 .text-area .title-group h2 {
  font-size: 18px;
}

@media screen and (min-width: 768px) {
  .banner-content .banner-1 .text-area .title-group h2 {
    font-size: calc(0vw + 18px);
  }
}

@media screen and (min-width: 1536px) {
  .banner-content .banner-1 .text-area .title-group h2 {
    font-size: 18px;
  }
}

.banner-content .banner-1 .text-area .title-group h2 {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.57;
  letter-spacing: 0;
  color: #FFFFFF;
}

.banner-content .banner-1 .text-area .title-group h2 {
  font-size: 16px;
}

@media screen and (min-width: 768px) {
  .banner-content .banner-1 .text-area .title-group h2 {
    font-size: calc(0vw + 16px);
  }
}

@media screen and (min-width: 1536px) {
  .banner-content .banner-1 .text-area .title-group h2 {
    font-size: 16px;
  }
}

.banner-content .banner-1 .text-area p {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.375;
  letter-spacing: 0;
  color: #FFFFFF;
}

.banner-content .banner-1 .text-area p {
  font-size: 16px;
}

@media screen and (min-width: 768px) {
  .banner-content .banner-1 .text-area p {
    font-size: calc(0vw + 16px);
  }
}

@media screen and (min-width: 1536px) {
  .banner-content .banner-1 .text-area p {
    font-size: 16px;
  }
}

.banner-content .banner-1 .text-area small {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.57;
  letter-spacing: 0;
  color: #FFFFFF59;
}

.banner-content .banner-1 .text-area small {
  font-size: 14px;
}

@media screen and (min-width: 768px) {
  .banner-content .banner-1 .text-area small {
    font-size: calc(0vw + 14px);
  }
}

@media screen and (min-width: 1536px) {
  .banner-content .banner-1 .text-area small {
    font-size: 14px;
  }
}

/*///////////////////////////////
===== layout - banner-2,3,4 =====
///////////////////////////////*/
.banner-2,
.banner-3,
.banner-4,
.banner-5 {
  width: 100%;
  background-color: #1C1C24;
  border-radius: 16px;
  overflow: hidden;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
}

.banner-2,
.banner-3,
.banner-4 {
  aspect-ratio: 1/1;
}

.banner-4-pic {
  max-width: 41%;
  -webkit-box-flex: 1;
  -ms-flex: 1;
  flex: 1;
}

.banner-5 {
  height: 100%;
}

.banner-5 img {
  height: 100%;
  -o-object-fit: cover;
  object-fit: cover;
}

/*/////////////////////////////
===== Desktop First START =====
/////////////////////////////*/
/*----- max-width 1536 -----*/
/*----- max-width 1200 -----*/
/*----- max-width 992 -----*/
/*----- max-width 768 -----*/
@media screen and (max-width: 767px) {
  .banner-content .banner-1 {
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
  }
}


</style>