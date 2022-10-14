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
        // if(isNaN(params.ind)){return }
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
    //
    async getText ():Promise<{period:any ,tab:any ,newstab:any,tabTime:any}>{
        return await request.get(`api/index/text`)
    },
    //链接钱包登录
    async postLogin (data: any):Promise<{token:any,username:string,status:string}>{
        return await request.post(`api/login`,data)
    },
    //退出
    async postLogout (data: any){
        return await request.post(`api/logout`,data)
    },
    //api/member/collection/add.將項目加入追蹤清單
    async addCollection (params: any){
        return await request.post(`api/member/collection/add`,{params})
    },
    //api/member/collection/index追从项目
    async getCollection (){
        return await request.get(`api/member/collection/index`,)
    },
    //会员追从Nft清单
    async postMember(){
        return await request.get(`api/member/nft/index`)
    }
}
export default homeApi