<template>
  <div @click="selectStar()"
       :class="[heightType==1?'height80':'',
         heightType==2?'height60':'',
         isSelected?'selected':'select_item']">
    <div class="title">{{ title }}</div>
    <div class="subTitle" v-if="subTitle">{{ subTitle }}</div>
  </div>
</template>
<script lang="ts" setup>
defineProps({
  title: {
    type: [String],
    default() {
      return ''
    }
  },
  subTitle: {
    type: [String],
    default() {
      return ''
    }
  },
  heightType: {
    type: [Number],
    default() {
      return 1
    }
  },
  isSelected: {
    type: [Boolean],
    default() {
      return false
    }
  },
})
const emit = defineEmits(['on-click'])
const selectStar = () => {
  emit('on-click')
}

// setup 代码
</script>
<!--export default {
    name:'SelectItem',
    emits: ['on-click'],
    methods:{

    },
    props:{
        title:{ 
            type:[String],
            default(){
                return ''
            }
        },
        subTitle:{
            type:[String],
            default(){
                return ''
            }
        },
        heightType:{
            type:[Number],
            default(){
                return 1
            }
        },
        isSelected:{
            type:[Boolean],
            default(){
                return false
            }
        },
    }
}-->

<style lang="less" scoped>
.select_item {
  width: 106px;
  border: 1px solid $border-color;
  // border-radius: 10px;
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;

  .title {
        width: 100%;
        font-size: 28px;
        font-weight: 600;
        color: #1F1F1F;
    }
    .subTitle{  
        font-size: 22px;
        font-weight: 400;
        color: #AEAEAE;
        margin-top: 6px;
    }
}
.selected{
    background: #FFF9EC;
    border: 1px solid #FF5A00;
    width: 106px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    .title{
        width: 100%;
        font-size: 28px;
        font-weight:600;
        color: #FF5A00;
    }
    .subTitle{  
        font-size: 22px;
        font-weight: 400;
        color: #FFFFFF;
        margin-top: 6px;
    }
}
.height80{
    height: 60px;
}
.height60{
    height: 60px;
}
</style>