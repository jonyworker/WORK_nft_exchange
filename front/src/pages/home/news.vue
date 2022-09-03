<template>
  <div class="container">
    <!--标题-->
    <div class="news_box">
      <div class="title">
        <div class="box">
          <div><img src="@/assets/images/icon_title_news.png" alt="logo"></div>
          <div class="tit">新聞&專欄</div>
        </div>
      </div>
      <div class="subtitle" @click="newsList()">前往查看</div>
    </div>
            <div class="news-content mt-10">
              <!-- 新聞 & 專欄卡片 -->
              <div class="row">
                <!-- 1st -->
                <div class="col-12 col-sm-6 col-lg-3">
                  <div class="card-item card-2" @click="toDetails(newList?.id)">
                    <!-- 卡片圖片 -->
                    <div class="card-image mb-10">
                      <img :src="newList?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-8">
                        <p>{{newList?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis mb-8">{{newList?.title}}</h3>
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
                    <div class="card-image mb-10">
                      <img :src="newListTwo?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-8">
                        <p>{{newListTwo?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis mb-8">{{newListTwo?.title}}</h3>
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
                    <div class="card-image mb-10">
                      <img :src="newListFree?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-8">
                        <p>{{newListFree?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis mb-8">{{newListFree?.title}}</h3>
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
                    <div class="card-image mb-10">
                      <img :src="newListFor?.photo_url" alt="">
                    </div>
                    <!-- 卡片內文 -->
                    <div class="card-text">
                      <div class="card-tag mb-8">
                        <p>{{newListFor?.ind}}</p>
                      </div>
                      <div class="card-title">
                        <h3 class="multiline-ellipsis mb-8">{{newListFor?.title}}</h3>
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
                <div class="btn btn-read-more btn-mobile btn-outline d-block d-sm-none" @click="newsList()">前往查看</div>
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
@import "./index.less";

</style>