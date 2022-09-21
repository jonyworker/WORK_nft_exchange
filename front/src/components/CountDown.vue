<template>

  <div class="card-time-wrap">
    <p class="count-down-day">{{ time?.days }}</p>
    <p class="count-down-hour">{{ time?.hours }}</p>
    <p class="count-down-min">{{ time?.minutes }}</p>
    <p class="count-down-sec">{{ time?.seconds }}</p>
  </div>
</template>

<script setup lang="ts">
import {defineProps} from "vue";
import {useCountdown} from "@utils/time";
  const {count_down_date} =defineProps<{count_down_date:string}>()

  const time = useCountdown(new Date(count_down_date))

</script>

<style scoped lang="less">

.minting-content .card-image .card-time-wrap {
  display: flex;
  gap: 8px;
  position: absolute;
  top: 40%;
  right: 30%;
}
.minting-content .card-image .card-time-wrap p {
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
.minting-content .card-image .card-time-wrap p {
  font-size: 18px;
}
@media screen and (min-width: 768px) {
  .minting-content .card-image .card-time-wrap p {
    font-size: calc(0vw + 18px);
  }
}
@media screen and (min-width: 1536px) {
  .minting-content .card-image .card-time-wrap p {
    font-size: 18px;
  }
}

</style>