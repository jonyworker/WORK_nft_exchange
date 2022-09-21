<template>
  <div class="container">
    <!--标题-->
    <div class="news_box">
      <div class="title">
        <div class="box">
          <div><img src="@/assets/images/icon_title_news.png" alt="logo"></div>
          <div class="tit">{{$t('home.newsBlog')}}</div>
        </div>
      </div>
      <div class="subtitle" @click="newsList()">{{$t('home.toView')}}</div>
    </div>
            <div class="news-content mt-10">
              <!-- 新聞 & 專欄卡片 -->
              <div class="row">
                <!-- 1st -->
                <div class="col-12 col-sm-6 col-lg-3">
                  <div class="card-item card-2" @click="toDetails(newList?.id)">
                    <!-- 卡片圖片 -->
                    <div class="card-image mb-5">
                      <img :src="newList?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-2">
                        <p>{{newList?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis">{{newList?.title}}</h3>
                      </div>
                      <div class="card-paragraph">
                        <div class="multiline-ellipsis mb-12" >
                         <div v-html="newList?.content"></div>
                        </div>
                      </div>
<!--                      <small class="">
                        <time datetime="">2022-03-30</time>
                      </small>-->
                    </div>
                  </div>
                </div>
                <!-- 2nd -->
                <div class="d-none d-sm-block col-sm-6 col-lg-3">
                  <div class="card-item card-2" @click="toDetails(newListTwo?.id)">
                    <!-- 卡片圖片 -->
                    <div class="card-image mb-5">
                      <img :src="newListTwo?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-2">
                        <p>{{newListTwo?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis">{{newListTwo?.title}}</h3>
                      </div>
                      <div class="card-paragraph">
                        <div class="multiline-ellipsis mb-12" >
                          <div v-html="newListTwo?.content"></div>
                        </div>
                      </div>
<!--                      <small class="">-->
<!--                        <time datetime="">2022-03-30</time>-->
<!--                      </small>-->
                    </div>
                  </div>
                </div>
                <!-- 3rd -->
                <div class="d-none d-lg-block col-lg-3">
                  <div class="card-item card-2" @click="toDetails(newListFree?.id)">
                    <!-- 卡片圖片 -->
                    <div class="card-image mb-5">
                      <img :src="newListFree?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-2">
                        <p>{{newListFree?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis">{{newListFree?.title}}</h3>
                      </div>
                      <div class="card-paragraph">
                        <div class="multiline-ellipsis mb-12" >
                          <div v-html="newListFree?.content"></div>
                        </div>
                      </div>
<!--                      <small class="">
                        <time datetime="">2022-03-30</time>
                      </small>-->
                    </div>
                  </div>
                </div>
                <!-- 4th -->
                <div class="d-none d-lg-block col-lg-3">
                  <div class="card-item card-2" @click="toDetails(newListFor?.id)">
                    <!-- 卡片圖片 -->
                    <div class="card-image mb-5">
                      <img :src="newListFor?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-2">
                        <p>{{newListFor?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis">{{newListFor?.title}}</h3>
                      </div>
                      <div class="card-paragraph">
                        <div class="multiline-ellipsis mb-12" >
                            <div v-html="newListFor?.content"></div>
                        </div>
                      </div>
<!--                      <small class="">
                        <time datetime="">2022-03-30</time>
                      </small>-->
                    </div>
                  </div>
                </div>
              </div>

              <!-- 前往查看按鈕 (手機顯示) -->
              <div class="mt-10">
                <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none" @click="newsList()">{{$t('home.toView')}}</div>
              </div>
            </div>


  </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import { useRouter } from 'vue-router';
import {homeApi} from '../../api';

const router = useRouter();
const newsList = () =>{
  router.push({ name: 'News' })
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
const getHomeNews =async()=>{
  const params = {
    count:5,
    page:1
  }
  const res = await homeApi.getNews(params);
  newList.value = res.data[0];
  newListTwo.value = res.data[1];
  newListFree.value = res.data[2];
  newListFor.value = res.data[3];

}
onMounted(() => {
  getHomeNews()
})
</script>

<style scoped lang="less">
.news_box{
  display: flex;
  justify-content:space-between;
  margin-top: 82.5px;
}
//.news-content{
//  display: flex;
//  justify-content: space-between;
//  flex-wrap: wrap;
//}
.news-content .card-item {
  display: flex;
  flex-direction: column;
  height: 100%;
}

/*----- 卡片圖片 -----*/
.news-content .card-image {
  width: 100%;
  border-radius: 16px;
  overflow: hidden;
  position: relative;
  img{
    height: 306px;
    object-fit:cover;
  }
}
.single-ellipsis {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.multiline-ellipsis {
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 5;
  overflow: hidden;
}
.news-content .card-image .card-time-wrap {
  display: flex;
  gap: 8px;
  position: absolute;
  top: 16px;
  right: 16px;
}

.news-content .card-image .card-time-wrap p {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.4;
  letter-spacing: 0;
  color: #FFFFFF;
  padding: 10px;
  border-radius: 8px;
  background-color: #4447E2;
}
.news-content .card-image .card-time-wrap p {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .news-content .card-image .card-time-wrap p {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .news-content .card-image .card-time-wrap p {
    font-size: 18px;
  }
}

/*----- 卡片下方文字區塊 -----*/
/*----- 卡片下方文字 - 容器 -----*/
.news-content .card-text {
  display: flex;
  flex-direction: column;
  align-items: start;
  flex: 1;
  color: #FFFFFF;
}

/*----- 卡片下方文字 - 文字 -----*/
.news-content .card-paragraph {
  flex: 1;
}

.news-content .card-text .card-tag {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.4;
  letter-spacing: 0;
  padding: 2px 8px;
  background-color: #4447E2;
  border-radius: 4px;
}
.news-content .card-text .card-tag {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .news-content .card-text .card-tag {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .news-content .card-text .card-tag {
    font-size: 18px;
  }
}

.news-content .card-text h3 {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 700;
  line-height: 1.33;
  letter-spacing: 0;
  -webkit-line-clamp: 2;
}
.news-content .card-text h3 {
  font-size: 22px;
}
@media screen and (min-width: 768px) {
  .news-content .card-text h3 {
    font-size: calc(0.78125vw + 16px);
  }
}
@media screen and (min-width: 1536px) {
  .news-content .card-text h3 {
    font-size: 28px;
  }
}

.news-content .card-text .card-paragraph p {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.57;
  letter-spacing: 0;
  -webkit-line-clamp: 4;
  color: rgba(255, 255, 255, 0.5490196078);
}
.news-content .card-text .card-paragraph p {
  font-size: 14px;
}
@media screen and (min-width: 768px) {
  .news-content .card-text .card-paragraph p {
    font-size: calc(0vw + 14px);
  }
}
@media screen and (min-width: 1536px) {
  .news-content .card-text .card-paragraph p {
    font-size: 14px;
  }
}

.news-content .card-text small {
  font-family: "Noto Sans TC", sans-serif;
  font-style: normal;
  font-weight: 400;
  line-height: 1.57;
  letter-spacing: 0;
  color: rgba(255, 255, 255, 0.3490196078);
}
.news-content .card-text small {
  font-size: 14px;
}
@media screen and (min-width: 768px) {
  .news-content .card-text small {
    font-size: calc(0vw + 14px);
  }
}
@media screen and (min-width: 1536px) {
  .news-content .card-text small {
    font-size: 14px;
  }
}

</style>