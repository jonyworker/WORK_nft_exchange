<template>
  <div class="container">
    <div class="wrap-title">連結你的錢包</div>
    <div class="wrap-subTitle">所有文章都通過 Mirror 發佈在區塊鏈上。 NFTotal 擁有文章的版權。NFTotal 擁有文章的版權。</div>
    <div class="wrap-tabs">
      <div v-for="(item,index) in walletList" :key="index" :class="['tags',type===item.id?'active_tags':'']" @click="chageTag(item.id)">
        <div class="image"><img :src="item.image" alt=""> </div>
        <div class="name">{{item.name}}</div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>

import {homeApi} from "@/api";
import {onMounted, ref} from "vue";
const type = ref(4);
const getImage = (url:any) =>{
  return new URL(url,import.meta.url).href;
}
const walletList = ref([
    {id:1,name:'MetaMask',image:getImage("../../assets/images/metamask.png")},
  {id:2,name:'imToken',image:getImage("../../assets/images/minting_1.png")},
  {id:3,name:'SafePal',image:getImage("../../assets/images/minting_2.png")},
  {id:4,name:'Wallet Connect',image:getImage("../../assets/images/minting_3.png")},
  {id:5,name:'Coinbase Wallet',image:getImage("../../assets/images/minting_4.png")},
])
const chageTag = async (value: number) => {
  type.value = value

}
const getWallet = async () =>{
  const params = {
    address:'0x78aa39849c1280cfcadd65c585acae297789084a'
  }
  const res =  await homeApi.postLogin(params);
  localStorage.setItem('token', res.token);
}
onMounted(() => {
  getWallet()
})
</script>

<style scoped lang="less">
@media screen and (min-width: 768px){
  .wrap-title{
    font-size: 30px !important;
    text-align: left !important;
  }
  .tags{
    font-size: 30px !important;
    display: flex;
    justify-content: space-between;
    .image{
      padding-left: 20px;
      img{
        width:40px;
        height:40px;
        margin-top:-12px;
      }
    }
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
    display: flex;
    justify-content: space-between;
    .image{
      padding-left: 20px;
      img{
        width:30px;
        height:30px;
        margin-top:-12px;
      }
    }
  }
  .wrap-subTitle{
    font-size: 14px !important;
    text-align: left !important;
  }
}
.wrap-title{
  padding-top: 50px;
  text-align: center !important;
  padding-bottom: 10px;
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