<template>
  <div id="pieChart" class="pieChart"></div>
</template>

<script lang="ts" setup>
import * as echarts from 'echarts';
import {onMounted, defineProps} from 'vue'
import {panelData} from "@/pages/homePage/homePageTypes";

const props = defineProps<{ panel: panelData }>()
const myPieChart = ref();

const initChart = (data: { value: number, name: string }[]) => {
  // 绘制图表
  myPieChart.value.setOption({
    title: {
      text: '持有數量分佈',

      textStyle:{
        color:'#fff',
        fontWeight:'400',
        fontSize:'16'
      }
    },
    legend: {
      bottom: '2%',
      textStyle:{
        // fontSize:0.8,
        color:'#FFF',
      }
    },
    series: [
      {
        name: 'legendData',
        type: 'pie',
        radius: ['50%', '70%'],
        avoidLabelOverlap: false,
        label: {
          show:false,
          position: 'center',
          color:'#fff'
        },
        emphasis: {
          itemStyle: {
            shadowBlur: 10,
            shadowOffsetX: 0,
          },
          label: {
            show: true,
            fontSize: '18',
            fontWeight: 'bold'
          }
        },
        labelLine: {
          show: false
        },
        data
      }
    ]
  });
}


watch(() => props?.panel, () => {
  if (props?.panel?.holder_stat) {
    const total = Object.values(props?.panel?.holder_stat).reduce((a,b)=>a+b)
    console.log("-> total", total);
    const data = Object.keys(props?.panel?.holder_stat).map((key: string) => {
      const value = props?.panel?.holder_stat[key]
      const percent = (value/total * 100).toFixed(2)
      return {name: `${key} -- ${percent}%` , value}
    })
    initChart(data)
  }
}, {
  immediate: true,
  deep: true
})

onMounted(() => {
  const chartDom = document.getElementById('pieChart');
  myPieChart.value = chartDom && echarts.init(chartDom);
})

</script>

<style scoped lang="less">
.pieChart {
  width: 600px;
  height: 427px;
}

.tabs {
  display: flex;
  font-weight: 700;
  font-size: 18px;
  color: #fff;

  .active {
    background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
  }

  div {
    border-radius: 15px;
    text-align: center;
    border: 1px solid;
    padding: 4px 16px;
    box-sizing: border-box;
    width: 58px;
    line-height: 22px;
    height: 30px;
    background: rgba(255, 255, 255, 0.1);
  }
}
@media screen and (max-width: 450px) {
  .pieChart {
    width: 356px !important;
    height: 427px;
  }
}
</style>
