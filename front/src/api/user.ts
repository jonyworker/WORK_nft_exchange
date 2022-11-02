import request from '../request/index'


const userApi = {
    async updatePersonal(params: any):Promise<any> {
            return await request.post('/api/member/profile/update',params)
    },
    async search (params: any){
        return await request.post(`api/collection/search`,params)
    },

}
export default userApi