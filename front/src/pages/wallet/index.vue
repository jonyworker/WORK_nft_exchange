<template>
  <div class="container">
    <div class="wrap-title">連結你的錢包</div>
    <div class="wrap-subTitle">所有文章都通過 Mirror 發佈在區塊鏈上。 NFTotal 擁有文章的版權。NFTotal 擁有文章的版權。</div>
    <div class="wrap-tabs">
      <div v-for="(item,index) in walletList" :key="index" :class="['tags',type===item.id?'active_tags':'']" @click="chageTag(item.id)">
        <div> </div>
        <div>{{item.name}}</div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>

import {homeApi} from "@/api";
import {ref} from "vue";
const type = ref(4);
const walletList = ref([
    {id:1,name:'MetaMask',image:''},
  {id:2,name:'imToken',image:''},
  {id:3,name:'SafePal',image:''},
  {id:4,name:'Wallet Connect',image:''},
  {id:5,name:'Coinbase Wallet',image:''},
])
const chageTag = async (value: number) => {
  type.value = value

}
</script>

<style scoped lang="less">
@media screen and (min-width: 768px){
  .wrap-title{
    font-size: 30px !important;
    text-align: left !important;
  }
  .tags{
    font-size: 30px !important;
  }
  .wrap-subTitle{
    font-size: 16px !important;
    text-align: left !important;
  }
}
@media screen and (max-width: 450px){
  .wrap-title{
    font-size: 28px !important;
    text-align: left !important;
  }
  .tags{
    font-size: 28px !important;
  }
  .wrap-subTitle{
    font-size: 14px !important;
    text-align: left !important;
  }
}
.wrap-title{
  padding-top: 20px;
  text-align: center;
  //width: 1200px;
  //margin: auto;
  font-size: 32px;
}
.wrap-subTitle{
  text-align: center;
  font-size: 18px;
}
.wrap-tabs{
//width: 636px;
  margin:30px auto;
}
.tags{
  background: #121212;
  border: 2px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  height: 60px;
  line-height:60px;
  margin-bottom: 15px;
  text-align: right;
  padding-right: 40px;
  font-size: 32px;
}
.tags:hover{
  background: #414141;
  border: 2px solid #4447E2;
  border-radius: 20px;
}
.active_tags{
  background: #414141;
  border: 2px solid #4447E2;
  border-radius: 20px;
}
</style>