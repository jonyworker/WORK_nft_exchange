<script lang="ts">
import Layout from "./components/layout.vue";

export default {
  components: {Layout}
}
</script>

<template>
  <el-config-provider :locale='locale'>
    <Layout/>
  </el-config-provider>
</template>

<style scoped>


</style>
