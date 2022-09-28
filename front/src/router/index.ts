import {createRouter, createWebHashHistory, RouteRecordRaw} from "vue-router";

// 1. 定义路由组件.
// 也可以从其他文件导入


const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/pages/home/index.vue')
    },
    {
        path:'/index',
        name:'Index',
        component: () => import('@/pages/index/index.vue')
    },
    {
        path:'/hotRanking',
        name:'HotRanking',
        component: () => import('@/pages/hotRanking/index.vue')
    },
    {
        path:'/minting',
        name:'Minting',
        component: () => import('@/pages/minting/index.vue')
    },
    {
        path:'/news',
        name:'News',
        component: () => import('@/pages/news/index.vue')
    },
    {
        path:'/newsDetail',
        name:'NewsDetail',
        component: () => import('@/pages/newsDetail/index.vue')
    },
    {
        path:'/wallet',
        name:'Wallet',
        component: () => import('@/pages/wallet/index.vue')
    },
    {
        path:'/analysis',
        name:'Analysis',
        component: () => import('@/pages/analysis/index.vue')
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router