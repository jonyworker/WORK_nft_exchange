<template>
<div>
  <div class="minting-content mt-5">
    <!-- 觀測站卡片 -->
    <div class="row">
      <!-- 1st -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card-item card-1" >
          <!-- 卡片圖片 -->
          <div class="card-image">
            <img :src="image" alt="">
          </div>
          <!-- 內文 -->
          <div class="card-text">
            <div class="card-text-wrap">
              <div class="text">{{title}}</div>
              <div class="image"><img :src="img" alt=""></div>
            </div>
            <div>
              #1234
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
const props = defineProps({
  image: {
    default: function() {
      return []
    },
    type: String
  },
  title:{
    default: function() {
      return []
    },
    type: String
  },
  img: {
    default: function() {
      return []
    },
    type: String
  },
})

</script>

<style scoped lang="less">
.card-image{
  img{
    border-radius: 16px 16px 0px 0px;
  }

}
.card-text{
  border-radius: 0px 0px 16px 16px;
  background: #1C1C24;
  border-color: rgba(255, 255, 255, 0.2);
  padding: 10px;
}
.card-text-wrap{
  display: flex;
  .text{
    width: 95%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow:ellipsis;
  }
}
</style>