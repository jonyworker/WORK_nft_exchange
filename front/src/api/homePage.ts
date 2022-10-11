import request from '../request/index'
import {panelData} from "@/pages/homePage/homePageTypes";


const homePageApi = {
    async getHomePoster(params: {collectionId:string}): Promise<panelData> {
        return await request.get('/api/collection/index',{params})
    },
    async postHomeCard(params:any){
        return await request.post('/api/collection/nft ',params)
    }
}
export default homePageApi