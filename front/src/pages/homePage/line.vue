<template>
  <div class="tabs">
    <div class="tabs-title">周期尺度</div>
    <div :class="['tabs-item ',current==='price_3d'&&'active']" @click="changeData('price_3d')">3d</div>
    <div :class="['tabs-item ',current==='price_30d'&&'active']" @click="changeData('price_30d')">30d</div>
    <div :class="['tabs-item ',current==='price_3m'&&'active']" @click="changeData('price_3m')">3m</div>
  </div>
  <div id="lineChart" class="pieChart"></div>
</template>

<script lang="ts" setup>
import * as echarts from 'echarts';
import {onMounted, defineProps} from 'vue'
import {panelData, ITrend} from "@/pages/homePage/homePageTypes";

const props = defineProps<{ panel: panelData }>()
const current = ref<string>('price_3d') // 激活
const dateRange = ref<string[]>() // 时间轴
const lowPrice = ref<string[]>() // 底价
const avgPrice = ref<string[]>()// 均价
const volumes = ref<string[]>()
const myChart = ref();

/**
 * 切换数据
 * @param type
 */
const changeData = (type: string) => {
  current.value = type
  const data:any[] = props.panel?.[type as never]
  const newData =data.sort((a:any,b:any)=>{
    return (new Date(a.date).getTime()-new Date(b.date).getTime())
  })
  const {
    date_list,
    floor_price,
    avg_price,
    volume,
  } = formatData(newData)
  dateRange.value = date_list;
  lowPrice.value = floor_price
  avgPrice.value = avg_price
  volumes.value = volume
  // 绘制图表
  myChart.value.setOption({
    legend: {
      textStyle:{
        fontSize: 16,//字体大小
        color: '#ffffff'//字体颜色
      }
    },
    tooltip: {},
    xAxis: {
      data: dateRange.value,
      axisLine: {
        lineStyle: {
          color: '#fff', // 颜色
          width: 1 // 粗细
        }
      }

    },
    yAxis: [
      {
        type: 'value',
        name: 'Volume (ETH)',
        min: 0,
        //max: 250,
        position: 'right',

        axisLabel: {
          // formatter: '{value} ml'
        },
        axisLine: {
          lineStyle: {
            color: '#fff', // 颜色
            width: 1 // 粗细
          }
        }
      },
      {
        type: 'value',
        name: '地板價 (ETH)',
        min: 0,
        // max: 25,
        position: 'left',
        axisLabel: {
          // formatter: '{value} °C'
        },
        axisLine: {
          lineStyle: {
            color: '#fff', // 颜色
            width: 1 // 粗细
          }
        }
      }
    ],
    series: [

      {
        name: '地板价',
        type: 'bar',
        data: lowPrice.value,

      },
      {
        name: '平均价',
        data: avgPrice.value,
        type: 'line',
        stack: 'x',
      },
      {
        name: 'Volume',
        data: volumes.value,
        type: 'line',
        stack: 'x',
      }
    ]
  });
}

/**
 * 格式化数据
 * @param list
 */
const formatData = (list: ITrend[]) => {
  interface IFormatData {
    date_list: string[],
    floor_price: string[]
    avg_price: string[]
    volume: string[]
  }

  return list.reduce((prev: IFormatData, cur: ITrend) => {
    const {date, floor_price, avg_price, volume} = cur
    return {
      date_list: [...prev.date_list, date],
      floor_price: [...prev.floor_price, floor_price],
      avg_price: [...prev.avg_price, avg_price || 0],
      volume: [...prev.volume, volume]
    }
  }, {
    date_list: [],
    floor_price: [],
    avg_price: [],
    volume: []
  })
}

watch(() => props?.panel, () => {
  props?.panel?.price_3m && changeData('price_3d' as never)
}, {
  immediate: true,
  deep: true
})

onMounted(() => {
  const chartDom = document.getElementById('lineChart');
  myChart.value =  chartDom && echarts.init(chartDom);
})

</script>

<style scoped lang="less">
.pieChart {
  height: 427px;
}

.tabs {
  display: flex;
  justify-content: flex-end;
  font-weight: 700;
  font-size: 18px;
  color: #fff;
  margin-bottom: 15px;
  .tabs-title {
    flex: 1;
    font-weight: 700;
    font-size: 28px;
    height:30px;
  }
  .tabs-item {
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
  .active{
    background: linear-gradient(180deg, #8585FF 0%, #4A4AC4 100%);
  }
}

</style>
