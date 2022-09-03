import request from '../request/index'


const homeApi = {
    //banner
    async getHomeBanner(params: any):Promise<{banners:any}> {
            return await request.get('api/index/banner',)
    },
    //r热门排行
    async getHotCollections (params: any):Promise<{hot_collections:any}>{
        return await request.get(`api/index/hotcollections?ind=${params}`)
    },
    //钱包
    async getWallet (params: any):Promise<{high_profit:any}>{
        return await request.get(`api/index/highprofit?ind=${params}`)
    },
    //minting
    async getDrops (params: any){
        return await request.get(`api/drops`,params)
    },
    //新闻
    async getNews (params: any){
        return await request.get(`api/news/list`,{params})
    },
    //新闻详情

    async getNewsDetail (id: number){
        return await request.get(`api/news/detail?id=${id}`,)
    },
    async getHotLists (params: any):Promise<{hot_collections:any}>{
        return await request.get(`api/nft/hotcollections`,{params})
    },
    //内页钱包
    async getProfitList (params: any):Promise<{high_profit:any}>{
        return await request.get(`api/nft/highprofit`,{params})
    },

}
export default homeApi