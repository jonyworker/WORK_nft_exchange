<template>
  <div class="d-flex flex-column flex-lg-row mb-24">
    <div class="heading-B-3 mr-auto mb-lg-0 mb-8 color-white">周期尺度</div>
    <div class="d-flex gap-8">
      <div :class="['tag ',current==='price_3d'&&'active_tag']" @click="changeData(1)">3D</div>

      <div :class="['tag',current==='price_30d'&&'active_tag']" @click="changeData(2)">30D</div>

      <div :class="['tag',current==='price_3m'&&'active_tag']" @click="changeData(3)">3M</div>
    </div>

  </div>
  <div id="lineChart" class="lineChart"></div>
</template>

<script lang="ts" setup>
import * as echarts from 'echarts';
import {onMounted, ref} from 'vue'
import { ITrend} from "@/pages/homePage/homePageTypes";
import {homePageApi} from "@/api";
import {useRoute} from "vue-router";

const current = ref<string>('price_3d') // 激活
const dateRange = ref<string[]>() // 时间轴
const lowPrice = ref<string[]>() // 底价
const avgPrice = ref<string[]>()// 均价
const volumes = ref<string[]>()
const priceData = ref<ITrend[]>([])
const myChart = ref();
const route = useRoute()
const ind = ref(1)

const emit = defineEmits(['update:value']);
/**
 * 切换数据
 */
const changeData = async (index: number) => {
  ind.value = index
  await getPrice()
}

const renderData = () => {
  const newData = priceData.value.sort((a: any, b: any) => {
    return (new Date(a.date).getTime() - new Date(b.date).getTime())
  })
  const {
    date_list,
    floor_price,
    avg_price,
    volume,
  } = formatData(newData)
  dateRange.value = date_list;
  lowPrice.value = floor_price;
  avgPrice.value = avg_price;
  volumes.value = volume;
  // 绘制图表
  myChart.value.setOption({
    legend: {
      textStyle: {
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
        name: '地板價',
        data: lowPrice.value,
        type: 'line',

        stack: 'x',
      },

      {
        name: '平均價',
        data: avgPrice.value,
        type: 'line',
        stack: 'x',
      },
      {
        name: 'Volume',
        data: volumes.value,
        type: 'line',
        stack: 'x',
      },
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
//图表
const getPrice = async () => {
  const {id} = route.query
  const params = {
    collectionId: id as string,
    ind: ind.value
  }
  try {
    const res: { [key: string]: ITrend[] } = await homePageApi.priceHistory(params);
    priceData.value = res?.data || res?.price_3d || res?.price_30d || res?.price_3m;
    renderData()
  } catch (e) {

  }
}
onMounted(() => {
  const chartDom = document.getElementById('lineChart');
  myChart.value = chartDom && echarts.init(chartDom);
  getPrice()
})
</script>

<style scoped lang="less">
.lineChart {
  height: 427px;
  // overflow-x: auto;
}


</style>
