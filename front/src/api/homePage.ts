import request from '../request/index'
import {ITrend, panelData} from "@/pages/homePage/homePageTypes";


const homePageApi = {
    async getHomePoster(params: {collectionId:string}): Promise<panelData> {
        return await request.get('/api/collection/index',{params})
    },
    async postHomeCard(params:any){
        return await request.post('/api/collection/nft ',params)
    },
    //將NFT加入追蹤清單
    async addNft(params:any){
        return await request.post('/api/member/nft/add ',params)
    },
    //將NFT從追蹤清單移除
    async removeNft(params:any){
        return await request.post(`api/member/nft/remove`,params)
    },
    //会员清單
    async addColl(params:any){
        return await request.post('/api/member/collection/add ',params)
    },
    //会员移除
    async removeColl(params:any){
        return await request.post('/api/member/collection/remove',params)
    },
    //周期图
    async priceHistory (params: {collectionId:string}): Promise<{[key:string]:ITrend[]}>{
        return await request.post('/api/collection/pricehistory',params)
    }
}
export default homePageApi