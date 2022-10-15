<!-- 新聞&專欄 -->

<template>
  <section class="section mb-80">
    <div class="container">
      <div class="content">
        <!--區域標題-->
        <div class="row mb-40">
          <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="section-title-wrap">
              <div class="title-icon">
                <img src="@/assets/images/icon_title_news.png" alt="logo">
              </div>
              <h2 class="section-title color-white">{{$t('home.newsBlog')}}</h2>
            </div>
    
            <!-- 前往查看按鈕 -->
            <div class="d-none d-sm-block">
              <button class="btn btn-bold btn-outline" @click="newsList()">{{$t('home.toView')}}</button>
            </div>
          </div>
        </div>
    
        <!-- 卡片 -->
        <div class="row">
            <!-- 1st -->
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="card" @click="toDetails(newList?.id)">
                <!-- card-img -->
                <div class="card-image-content ratio--1-91_1 bdRadius-8 mb-16">
                  <img :src="newList?.photo_url" alt="">
                </div>
                <!-- card-body -->
                <div class="card-body-content">
    
                  <div class="card-tag mb-8">
                    <p>{{newList?.ind}}</p>
                  </div>
    
                  <h3 class="card-title-h4 clamp-2 mb-16">{{newList?.title}}
                  </h3>
                  <!-- <div class="card-paragraph">
                    <div class="multiline-ellipsis mb-12" >
                      <div v-html="newList?.content"></div>
                    </div>
                  </div> -->
                  <small class="card-text-small">
                    <time datetime="">2022-03-30</time>
                  </small>
                </div>
              </div>
            </div>
            <!-- 2nd -->
            <div class="d-none d-sm-block col-sm-6 col-lg-4">
              <div class="card" @click="toDetails(newListTwo?.id)">
                <!-- card-img -->
                <div class="card-image-content ratio--1-91_1 bdRadius-8 mb-16">
                  <img :src="newListTwo?.photo_url" alt="">
                </div>
                <!-- card-body -->
                <div class="card-body-content">
    
                  <div class="card-tag mb-8">
                    <p>{{newListTwo?.ind}}</p>
                  </div>
    
                  <h3 class="card-title-h4 clamp-2 mb-16">{{newListTwo?.title}}
                  </h3>
                  <!-- <div class="card-paragraph">
                    <div class="multiline-ellipsis mb-12" >
                      <div v-html="newListTwo?.content"></div>
                    </div>
                  </div> -->
                  <small class="card-text-small">
                    <time datetime="">2022-03-30</time>
                  </small>
                </div>
              </div>
            </div>
            <!-- 3rd -->
            <div class="d-none d-lg-block col-lg-4">
              <div class="card" @click="toDetails(newListFree?.id)">
                <!-- card-img -->
                <div class="card-image-content ratio--1-91_1 bdRadius-8 mb-16">
                  <img :src="newListFree?.photo_url" alt="">
                </div>
                <!-- card-body -->
                <div class="card-body-content">
    
                  <div class="card-tag mb-8">
                    <p>{{newListFree?.ind}}</p>
                  </div>
    
                  <h3 class="card-title-h4 clamp-2 mb-16">{{newListFree?.title}}</h3>
                  <!-- <div class="card-paragraph">
                    <div class="multiline-ellipsis mb-12" >
                      <div v-html="newListFree?.content"></div>
                    </div>
                  </div> -->
                  <small class="card-text-small">
                    <time datetime="">2022-03-30</time>
                  </small>
                </div>
              </div>
            </div>
            
        </div>
    
        <!-- 前往查看按鈕 (手機顯示) -->
        <div class="mt-40">
          <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none" @click="newsList()">{{$t('home.toView')}}</div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import { useRouter } from 'vue-router';
import {homeApi} from '../../api';

const router = useRouter();
const newsList = () =>{
  router.push({ name: 'News'})
}
const toDetails = (id:number) =>{
  router.push({ name: 'NewsDetail',query:{id} })
}
interface INewListFor{
  id:any;
  photo_url:string;
  ind:string;
  title:string;
  content:string;
}
const newList = ref<INewListFor|null>(null);
const newListTwo = ref<INewListFor|null>(null);
const newListFree = ref<INewListFor|null>(null);
const newListFor = ref<INewListFor|null>(null);
//请求数据
const getHomeNew = async() =>{
  const params = {
    count:8,
    page:1
  }
  const res = await homeApi.getNews(params);
  console.log("-> res=====", res);
  newList.value = res.data[0];
  newListTwo.value = res.data[1];
  newListFree.value = res.data[2];
  newListFor.value = res.data[3];

}
onMounted(() => {
  getHomeNew()
})
</script>

<style scoped lang="less">
// .news_box{
//   display: flex;
//   justify-content:space-between;
//   margin-top: 82.5px;
// }
//.news-content{
//  display: flex;
//  justify-content: space-between;
//  flex-wrap: wrap;
//}
// .news-content .card-item {
//   display: flex;
//   flex-direction: column;
//   height: 100%;
// }

// /*----- 卡片圖片 -----*/
// .news-content .card-image {
//   width: 100%;
//   border-radius: 16px;
//   overflow: hidden;
//   position: relative;
//   img{
//     height: 306px;
//     object-fit:cover;
//   }
// }
// .news-content .card-image .card-time-wrap {
//   display: flex;
//   gap: 8px;
//   position: absolute;
//   top: 16px;
//   right: 16px;
// }

// .news-content .card-image .card-time-wrap p {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 700;
//   line-height: 1.4;
//   letter-spacing: 0;
//   color: #FFFFFF;
//   padding: 10px;
//   border-radius: 8px;
//   background-color: #4447E2;
// }
// .news-content .card-image .card-time-wrap p {
//   font-size: 18px;
// }
// @media screen and (min-width: 768px) {
//   .news-content .card-image .card-time-wrap p {
//     font-size: calc(0vw + 18px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .news-content .card-image .card-time-wrap p {
//     font-size: 18px;
//   }
// }

/*----- 卡片下方文字區塊 -----*/
/*----- 卡片下方文字 - 容器 -----*/
// .news-content .card-text {
//   display: flex;
//   flex-direction: column;
//   align-items: start;
//   flex: 1;
//   color: #FFFFFF;
// }

/*----- 卡片下方文字 - 文字 -----*/
// .news-content .card-paragraph {
//   flex: 1;
// }



// .news-content .card-text h3 {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 700;
//   line-height: 1.33;
//   letter-spacing: 0;
//   -webkit-line-clamp: 2;
// }
// .news-content .card-text h3 {
//   font-size: 22px;
// }
// @media screen and (min-width: 768px) {
//   .news-content .card-text h3 {
//     font-size: calc(0.78125vw + 16px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .news-content .card-text h3 {
//     font-size: 28px;
//   }
// }

// .news-content .card-text .card-paragraph p {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 400;
//   line-height: 1.57;
//   letter-spacing: 0;
//   -webkit-line-clamp: 4;
//   color: rgba(255, 255, 255, 0.5490196078);
// // }
// .news-content .card-text .card-paragraph p {
//   font-size: 14px;
// }
// @media screen and (min-width: 768px) {
//   .news-content .card-text .card-paragraph p {
//     font-size: calc(0vw + 14px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .news-content .card-text .card-paragraph p {
//     font-size: 14px;
//   }
// }

// .news-content .card-text small {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 400;
//   line-height: 1.57;
//   letter-spacing: 0;
//   color: rgba(255, 255, 255, 0.3490196078);
// }
// .news-content .card-text small {
//   font-size: 14px;
// }
// @media screen and (min-width: 768px) {
//   .news-content .card-text small {
//     font-size: calc(0vw + 14px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .news-content .card-text small {
//     font-size: 14px;
//   }
// }

</style>