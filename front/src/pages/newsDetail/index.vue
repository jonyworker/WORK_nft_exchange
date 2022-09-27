<template>
  <div class="container ">
    <div class="page ">
      <!-- 卡片內文 -->
<<<<<<< HEAD
      <div class="card-text ">
        <div class="center">
          <div class="pt-1"></div>
          <div class="card-tag mb-8 ">
            <p>{{newList?.ind}}</p>
          </div>
          <div class="card-title text-white">
            <h3 class="multiline-ellipsis text-black mb-8">{{newList?.title}}</h3>
          </div>
          <div class="text-black">{{newList?.start_date}}</div>
        </div>
        <div class="newImg col-12 col-8">
          <img :src="newList?.photo_url" alt="">
        </div>
        <div class="card-paragraph text-white">
          <div class=" text-black mb-12">
=======
      <div class="card-text">
        <!-- 標題組 -->
        <div class="row justify-content-center mb-5">
          <div class="col-lg-8 col-12">
            <!-- 標題組 - 新聞標籤 -->
            <div class="card-tag mb-16">
              <p>{{newList?.ind}}</p>
            </div>
            <!-- 標題組 - 新聞標題 -->
            <div class="">
              <h3 class="heading-B-1 text-white mb-24 ">{{newList?.title}}</h3>
            </div>
            <!-- 標題組 - upload 時間 -->
            <div class="body-B-2 text-white ">{{newList?.start_date}}</div>
          </div>
        </div>
        <!-- 標題組 - 主圖 -->
        <div class="row justify-content-center bs-mb-32">
          <div class="col-12">
            <div class="blog-main-img-wrap">
              <img class="blog-main-img" :src="newList?.photo_url" alt="">
            </div>
          </div>
        </div>
        <!-- 新聞內容 -->  
        <div class="row justify-content-center">
          <div class="col-lg-8 col-12">
>>>>>>> e707d4797dc4a6f610fefce3897823d5f8af0539
            <div v-html="newList?.content" ></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup lang="ts">
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
.container{
  background-color: #fff;
  color:#333;
  padding-bottom: 10px;
}
.center{
  width: 80%;
  margin: auto;
}
.card-tag{
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.4;
  letter-spacing: 0;
  padding: 2px 8px;
  width:80px;
  color: #fff;
  text-align: center;
  background-color: #4447E2;
  border-radius: 4px;
  margin-top:50px;
}
.newImg{
  padding: 30px 0px;
  //img{
  //  height: 619px;
  //}

}
.card-paragraph{
  width:80%;
  margin: auto;
}
.blog-main-img-wrap {
  display: block;
  width: 100%;
  aspect-ratio: 7/4;
}
.blog-main-img {
  vertical-align: middle;
  height: 100%;
  width: 100%;
  object-fit: cover;
}
</style>