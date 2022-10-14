<template>
  <div class="common-layout">
    <el-container>
      <div>
        <Header/>
      </div>
      <div class="page-body">
        <router-view/>
      </div>
      <el-footer>
        <Footer/>
      </el-footer>
      
    </el-container>
  </div>
</template>
<script lang="ts" setup>
import Header from './Header.vue';
import Footer from "./Footer.vue";
</script>

<style scoped>

.page-body {
  min-height: calc(100vh - 58px);

}

/*.common-layout {*/
/*  width: 1296px;*/
/*  margin: auto;*/
/*}*/

</style>