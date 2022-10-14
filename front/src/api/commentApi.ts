import request from '../request/index'
import {panelData} from "@/pages/homePage/homePageTypes";
export const commonApi ={
    async uploadImgAction(params: any): Promise<panelData> {
        return await request.post('/api/upload/image',{params})
    },
    uploadImg:'/api/upload/image',
    uploadFile:''
}
