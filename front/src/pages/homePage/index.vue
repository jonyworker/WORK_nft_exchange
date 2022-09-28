<template>
 <div>
    <div class="container">
      <div class="dialog-wrap mt-5">
        <div class="left">
          <el-switch v-model="price" />   過濾售出價格
        </div>
        <div class="center">
          售出價格區間 &nbsp&nbsp&nbsp&nbsp <el-icon><ArrowDownBold /></el-icon>
        </div>
        <div class="right">
          售出價格：低至高  &nbsp&nbsp&nbsp&nbsp
          <el-icon><ArrowDownBold /></el-icon>
        </div>
      </div>
      <div class="minting-content mt-5">
        <!-- 觀測站卡片 -->
        <div class="row">
          <!-- 1st -->
          <div class="col-12 col-sm-6 col-lg-3" v-for="(item,index) in dropsList" :key="index">
            <div class="card-item card-1" >
              <!-- 卡片圖片 -->
              <div class="card-image">
                <!--              <img :src="http + dropsOne?.background" alt="">-->
                <img src="@/assets/images/random_1.png" alt="">
              </div>
              <!-- 內文 -->
              <div class="card-text">
                <div class="card-text-wrap">
                  <div class="text">動態項目方名稱動態項目方名...</div>
                  <div class="image"><img src="@/assets/images/icon_favorite.png" alt=""></div>
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
 </div>
</template>

<script setup lang="ts">
import * as echarts from 'echarts';
import {onMounted, ref} from "vue";
import {homeApi} from "@/api";
type IInfo = {
  background:string;
  collection_url: string;
  collection: string;
  introduction: string;
  price: string;
  ori_date: string;
}
const dropsList = ref<IInfo[] | null>(null);
const price = ref(true)
const getHomePage = async () => {
  const res = await homeApi.getDrops({});
  const list = res.data.map((item: { shortTime: any; date: string; }) => {
    item.shortTime = item.date.split(' ')[1]
    return item
  })
  dropsList.value = list
}

onMounted(() => {
  getHomePage()
})
</script>

<style scoped lang="less">
:deep .el-icon{
  color:rgba(255, 255, 255, 0.4) !important;

}
.dialog-wrap{
  display: flex;
  justify-content: flex-end;
  font-size: 16px;
  .left{
    margin-right: 15px;
    line-height: 40px;
  }
  .center{
    margin-right: 15px;
    border: 1px solid rgba(68, 71, 226, 1);
    padding: 8px 15px;
    background: #1C1C24;
    height: 40px;
    border-radius: 8px;
  }
  .right{
    border: 1px solid rgba(68, 71, 226, 1);
    padding: 8px 15px ;
    background: #1C1C24;
    border-radius: 8px;
    height: 40px;
  }
}
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