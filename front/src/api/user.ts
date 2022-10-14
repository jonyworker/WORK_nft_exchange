import request from '../request/index'


const userApi = {
    async updatePersonal(params: any):Promise<any> {
            return await request.post('/api/member/profile/update',params)
    },

}
export default userApi