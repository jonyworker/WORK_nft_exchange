<template>
    <div class="all-nft mt-80 section">
      <div class="container">
        <div class="all-nft-content">
          <!-- 標題組 -->
          <div class="row mb-40">
            <div class="col-12 d-flex justify-content-between align-items-center">
              <div class="section-title-wrap flex-column align-items-start">
                <!-- 標題  -->
                <h2 class="section-title color-white mb-8">
                  {{$t('home.latestNews')}}
                </h2>

                <p class="section-subTitle color-white mb-24">{{$t('home.newsList')}}</p>

                <!-- 子選項 -->
                <div class="tabs">
                  <div v-for="(item,index) in tabs" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="chageTag(item.value)">
                    {{item.name}}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- 內容 -->
          <div class="row" >
            <div class="d-none d-lg-block col-12 mb-24" >
              <div class="card" @click="toDetails(newListTwo?.id)">
                <div class="row">
                  <!-- 卡片圖片 -->
                  <div class="col-8">
                    <div class="card-image-content ratio--1-91_1 bdRadius-8">
                      <img :src="newListTwo?.photo_url" alt="">
                    </div>
                  </div>
                  <div class="col-4">
                    <!-- 卡片內文 -->
                    <div class="card-body-content">
                      <!-- 卡片 tag -->
                      <div class="card-tag mb-8">
                        <p>{{newListTwo?.ind}}</p>
                      </div>
                      <!-- 卡片標題 -->
                      <h3 class="card-title-h4 clamp-2 mb-16">{{newListTwo?.title}}</h3>
                      <!-- 內容簡介 -->
                      <div class="card-text-p clamp-5 mb-8">
                        <div v-html="newListTwo?.content" ></div>
                      </div>
                      <!-- 時間 -->
                      <small class="card-text-small">
                        <time datetime="">2022-03-30</time>
                      </small>
                    </div>
                  </div>

                </div>

              </div>
            </div >

            <!-- 小卡片 -->
            <div 
              class="col-12 col-sm-6 col-lg-4 mb-24"
              v-for="(item,index) in newList"
              :key="index"
            >
              <div class="card" @click="toDetails(item.id)">
                <!-- 卡片圖片 -->
                <div class="card-image-content ratio--1-91_1 bdRadius-8 mb-16">
                  <img :src="item.photo_url" alt="">
                </div>
                <!-- 卡片內文 -->
                <div class="card-body-content">
                  <!-- tag -->
                  <div class="card-tag mb-8">
                    <p>{{item.ind}}</p>
                  </div>

                  <!-- 標題 -->
                  <h3 class="card-title-h4 clamp-2 mb-8 flex-grow-1">{{item.title}}</h3>

                  <!-- 內文 -->
                  <!-- <div class="card-paragraph">
                    <div class="clamp-2 mb-12">
                      <div v-html="item.content"></div>
                    </div>
                  </div> -->
                  <!-- 日期 -->
                  <small class="card-text-small">
                    <time datetime="">2022-03-30</time>
                  </small>
                </div>
              </div>
            </div>

            
          </div>
        </div>
      </div>
    </div>
</template>

<script setup lang="ts">
import {onMounted, ref, watchEffect} from "vue";
import {useRouter} from 'vue-router';
import {homeApi} from '../../api';
import {useScrollHeight}from '@/hooks/useScrollHeight'
const router = useRouter();

const ps = router.currentRoute.value.query.type;
const type = ref(1)
const {scrollBtmHeight} =useScrollHeight()
const newList = ref<INewListFor[] | null>(null);
const newListTwo = ref<INewListFor | null>(null);
const count = ref(0);
const page = ref(1)
const isFinish = ref<boolean>(false);
const isLoading = ref<boolean>(false);
interface IText {
  name: string
  value: number
}

const tabs = ref<IText[]>()
const getTextList = async () => {
  const res = await homeApi.getText();
  tabs.value = res.newstab
  tabs.value&&chageTag(tabs.value[0].value)
}
const toDetails = (id: number) => {
  router.push({name: 'NewsDetail', query: {id}})
}
const chageTag = async (value: number) => {
  type.value = value
  newList.value = []
  page.value = 1
  isFinish.value = false
  const params = {
    // count:5,
    // page:1,
    ind: type.value,
  }
  const res = await homeApi.getNews(params);
  if (!res) {
    return
  }
  newListTwo.value = res.data[0];
  newList.value = res.data.splice(1);

}

interface INewListFor {
  id: any;
  photo_url: string;
  ind: string;
  title: string;
  content: string;
}

//请求数据
const getNews = async () => {
  const params = {
    // count:5,
    // page:1,
    ind: type.value,
  }
  const res = await homeApi.getNews(params);
  if (!res) {
    return
  }
  newList.value = res.data.slice(0, 1);
  newListTwo.value = res.data[0];
  newList.value = res.data.splice(1);
}
const load = async () => {
  if (isFinish.value||isLoading.value||scrollBtmHeight.value>400) {
    return;
  }
  const params = {
    count: 30,
    page:page.value,
    ind: type.value,
  }
  isLoading.value =true
  const res = await homeApi.getNews(params);
  isLoading.value =false
  if (!res) {
    return
  }
  page.value =page.value + 1
  newList.value = [...(newList.value??[]),...res.data] ;
  if (res.data.length < 30) {
    isFinish.value = true
  }

}
watchEffect(()=>{
  load()
})
onMounted(() => {
  getNews()
  getTextList()
  chageTag(Number(ps))
})
</script>

<style scoped lang="less">
// .card-items{
//   display: flex;
// }
// .card-images{
//   height:408px;
//   img{
//     object-fit:cover;
//     height:408px;
//     border-radius:4px;
//   }
// }
// .card-image{
//   img{

//     height:242px;
//     border-radius:4px;
//   }
// }
// .card-text {
//   display: flex;
//   flex-direction: column;
//   align-items: start;
//   flex: 1;
//   color: #FFFFFF;
//   padding-left: 25px;
// }

/*----- 卡片下方文字 - 文字 -----*/
//  .card-paragraph {
//   flex: 1;
// }

//  .card-text .card-tag {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 400;
//   line-height: 1.4;
//   letter-spacing: 0;
//   padding: 2px 8px;
//   background-color: #4447E2;
//   border-radius: 4px;
// }
//  .card-text .card-tag {
//   font-size: 18px;
// }
// @media screen and (min-width: 768px) {
//  .card-text .card-tag {
//     font-size: calc(0vw + 18px);
//   }
// }
// @media screen and (min-width: 1536px) {
//  .card-text .card-tag {
//     font-size: 18px;
//   }
// }

//  .card-text h3 {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 700;
//   line-height: 1.33;
//   letter-spacing: 0;
//   -webkit-line-clamp: 2;
// }
// .card-text h3 {
//   font-size: 22px;
// }
// @media screen and (min-width: 768px) {
//  .card-text h3 {
//     font-size: calc(0.78125vw + 16px);
//   }
// }
// @media screen and (min-width: 1536px) {
//  .card-text h3 {
//     font-size: 28px;
//   }
// }

//  .card-text .card-paragraph p {
//   font-family: "Noto Sans TC", sans-serif;
//   font-style: normal;
//   font-weight: 400;
//   line-height: 1.57;
//   letter-spacing: 0;
//   -webkit-line-clamp: 4;
//   color: rgba(255, 255, 255, 0.5490196078);
// }
//  .card-text .card-paragraph p {
//   font-size: 14px;
// }
// @media screen and (min-width: 768px) {
//   .card-text .card-paragraph p {
//     font-size: calc(0vw + 14px);
//   }
// }
// @media screen and (min-width: 1536px) {
//   .card-text .card-paragraph p {
//     font-size: 14px;
//   }
// }
</style>