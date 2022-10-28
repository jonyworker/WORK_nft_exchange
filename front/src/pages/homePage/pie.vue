<template>
  <div class="heading-B-3 mb-24">持有數量分佈</div>
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
      // text: '持有數量分佈',

        textStyle:{
          color:'#fff',
          fontWeight:'400',
          fontSize:'16'
        }
      },
      legend: {
        bottom: '0',
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
      const data = Object.keys(props?.panel?.holder_stat).map((key: string) => {
        const value = props?.panel?.holder_stat[key as never]
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
.title{
  font-weight: 700;
  font-size: 28px;
  height:30px;
  margin-bottom: 15px;
}
.pieChart {
  height: 427px;
}

</style>
