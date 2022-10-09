import request from '../request/index'
import {panelData} from "@/pages/homePage/homePageTypes";


const homePageApi = {
    async getHomePoster(params: {collectionId:string}): Promise<panelData> {
        return await request.get('/api/collection/index',{params})
    }
}
export default homePageApi