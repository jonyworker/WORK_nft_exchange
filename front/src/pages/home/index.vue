<template>
  <div>
    <HeaderCard/>
    <Special :textList="textList"/>
    <Wallet :textList="textList"/>
    <Minting />
    <News/>
  </div>
</template>

<script setup lang="ts">
import {  ref } from 'vue';
import {onMounted } from 'vue';
import HeaderCard from './banner.vue';
import Special from './special.vue';
import Wallet from './wallet.vue';
import Minting from './minting.vue';
import News from './news.vue';
import {homeApi} from '../../api';
interface IText {
  name: string
  value: string
}
const textList = ref<IText[]>();
const getTextList = async() =>{
  const res = await homeApi.getText();
  textList.value = res.period
}

onMounted(() => {
  getTextList()
})
</script>

