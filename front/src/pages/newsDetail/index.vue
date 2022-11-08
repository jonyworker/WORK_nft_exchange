<template>
  <div class="container ">
    <div class="page-content mt-80">
      <!-- 卡片內文 -->
      <div class="card-text">
        <!-- 標題組 -->
        <div class="row justify-content-center">
          <div class="col-lg-8 col-12 mb-56">
            <!-- 標題組 - 新聞標籤 -->
            <div class="card-tag mb-16 align-self-start color-white">
              <p>{{newList?.ind}}</p>
            </div>
            <!-- 標題組 - 新聞標題 -->
            
            <h3 class="heading-B-2 color-white mb-24 ">{{newList?.title}}</h3>
            
            <!-- 標題組 - upload 時間 -->
            <div class="body-L-2" style="color: #FFFFFF99;">{{newList?.start_date}}</div>
          </div>
        </div>

        <!-- 標題組 - 主圖 -->
        <div class="row justify-content-center mb-56">
          <div class="col-11">
            <div class="card-image-content ratio--1-91_1 bdRadius-8 mb-12">
              <img class="blog-main-img" :src="newList?.photo_url" alt="">
            </div>
            <p class="blog-caption">{{newList?.source}}</p>
          </div>
        </div>


        <!-- 新聞內容 -->  
        <div class="row justify-content-center">
          <div class="col-lg-8 col-12">
            <div class="ck-content" v-html="newList?.content" ></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup lang="ts">
import { StringLiteral } from "@babel/types";
import {onMounted, ref} from "vue";
import { useRouter } from 'vue-router';
import {homeApi} from '../../api';
const router = useRouter();
const ids = router.currentRoute.value.query.id;
interface INewListFor{
  photo_url:string;
  ind:string;
  title:string;
  content:string;
  start_date:string;
  source:string;
  photo_url:string;
}

const newList = ref<INewListFor|null>(null);
//请求数据
const getNews =async()=>{
  const res = await homeApi.getNewsDetail(ids as any);
  newList.value = res.data

}
onMounted(() => {
  getNews()
})
</script>

<style scoped lang="less">

  

</style>