<template>
    <div class="all-nft mt-20">
      <div class="container">
        <div class="all-nft-content">
          <!-- 標題組 -->
          <div class="row mb-5">
            <div class="col-12 d-flex justify-content-between align-items-center">
              <div class="title-wrap">
                <h2 class="title-set mb-6">
                  {{$t('home.latestNews')}}
                </h2>
                <p class="subtile mb-6">{{$t('home.newsList')}}</p>
                <div class="tabs">
                  <div v-for="(item,index) in tabs" :key="index" :class="['tag',type===item.value?'active_tag':'']" @click="chageTag(item.value)">
                    {{item.name}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div>
            <!-- 新聞 & 專欄卡片 -->
            <div class="row" >
              <!-- 1st -->
              <div class="d-none d-lg-block  col-12" >
                <div class="card-items card-2 mb-4" @click="toDetails(newListTwo?.id)">
                  <!-- 卡片圖片 -->
                  <div class="col-8 card-images">
                    <img :src="newListTwo?.photo_url" alt="">
                  </div>
                  <!-- 卡片內文 -->
                  <div class="card-text">
                    <div class="card-tag  mb-8">
                      <p>{{newListTwo?.ind}}</p>
                    </div>
                    <div class="card-title">
                      <h3 class="multiline-ellipsis  mb-8">{{newListTwo?.title}}</h3>
                    </div>
                    <div class="card-paragraph">
                      <div class="multiline-ellipsis  mb-12">
                        <div v-html="newListTwo?.content" ></div>
                      </div>
                    </div>
<!--                    <small class="">-->
<!--                      <time datetime="">2022-03-30</time>-->
<!--                    </small>-->
                  </div>
                </div>
              </div >
              <div class=" col-sm-6  col-lg-4" v-infinite-scroll="load" v-for="(item,index) in newList" :key="index">
                <div class="card-item card-2" @click="toDetails(item.id)">
                  <!-- 卡片圖片 -->
                  <div class="card-image mb-10">
                    <img :src="item.photo_url" alt="">
                  </div>
                  <!-- 卡片內文 -->
                  <div class="card-text">
                    <div class="card-tag mb-8">
                      <p>{{item.ind}}</p>
                    </div>
                    <div class="card-title">
                      <h3 class="multiline-ellipsis  mb-8">{{item.title}}</h3>
                    </div>
                    <div class="card-paragraph">
                      <div class="multiline-ellipsis  mb-12">
                        <div v-html="item.content"></div>
                      </div>
                    </div>
<!--                    <small class="">
                      <time datetime="">2022-03-30</time>
                    </small>-->
                  </div>
                </div>
              </div>
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

const ps = router.currentRoute.value.query.type;
const type = ref (1)
interface IText {
  name: string
  value: number
}
const tabs = ref<IText[]>()
const getTextList = async() =>{
  const res = await homeApi.getText();
  tabs.value = res.newstab
}
const toDetails = (id:number) =>{
  router.push({ name: 'NewsDetail',query:{id}})
}
const chageTag = async(value:number) =>{
  type.value = value
  const params = {
    // count:5,
    // page:1,
    ind:type.value,
  }
  const res = await homeApi.getNews(params);
  newListTwo.value = res.data[0];
  newList.value = res.data.splice(1);

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
const count = ref(0);
const page = ref(1)
//请求数据
const getNews =async()=>{
  const params = {
    // count:5,
    // page:1,
    ind:type.value,
  }
  const res = await homeApi.getNews(params);
  newList.value = res.data.slice(0,1);
  newListTwo.value = res.data[0];
  newList.value = res.data.splice(1);


}
const load = async() =>{
  const params = {
    count:30,
     page:page.value + 1,
    ind:type.value,
  }
  const res = await homeApi.getNews(params);
  newList.value = res.data;
}
onMounted(() => {
  getNews()
  getTextList()
  chageTag(Number(ps))
})
</script>

<style scoped lang="less">
.card-items{
  display: flex;
}
.card-images{
  height:408px;
  img{
    object-fit:cover;
    height:408px;
    border-radius:4px;
  }
}
.card-image{
  img{

    height:242px;
    border-radius:4px;
  }
}
.card-text {
  display: flex;
  flex-direction: column;
  align-items: start;
  flex: 1;
  color: #FFFFFF;
  padding-left: 25px;
}

/*----- 卡片下方文字 - 文字 -----*/
 .card-paragraph {
  flex: 1;
}

 .card-text .card-tag {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.4;
  letter-spacing: 0;
  padding: 2px 8px;
  background-color: #4447E2;
  border-radius: 4px;
}
 .card-text .card-tag {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
 .card-text .card-tag {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
 .card-text .card-tag {
    font-size: 18px;
  }
}

 .card-text h3 {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.33;
  letter-spacing: 0;
  -webkit-line-clamp: 2;
}
.card-text h3 {
  font-size: 22px;
}
@media screen and (min-width: 768px) {
 .card-text h3 {
    font-size: calc(0.78125vw + 16px);
  }
}
@media screen and (min-width: 1536px) {
 .card-text h3 {
    font-size: 28px;
  }
}

 .card-text .card-paragraph p {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.57;
  letter-spacing: 0;
  -webkit-line-clamp: 4;
  color: rgba(255, 255, 255, 0.5490196078);
}
 .card-text .card-paragraph p {
  font-size: 14px;
}
@media screen and (min-width: 768px) {
  .card-text .card-paragraph p {
    font-size: calc(0vw + 14px);
  }
}
@media screen and (min-width: 1536px) {
  .card-text .card-paragraph p {
    font-size: 14px;
  }
}
</style>