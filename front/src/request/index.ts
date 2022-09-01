import axios from "axios";

import config from './config'

const service = axios.create({
    ...config,
    timeout: 60000
})
service.interceptors.response.use(
    response => {

        // 如果返回的状态码为200，说明接口请求成功，可以正常拿到数据
        // 否则的话抛出错误
        if (response.status === 200) {
            if (response.data.status == 'ok' || response.data.status == 'OK') {
                return Promise.resolve(response.data);
            } else {
                return Promise.reject(response);
            }
        } else {
            return Promise.reject(response);
        }
    },
    error => {

        if (error.response.status) {
            switch (error.response.status) {
                // 401: 未登录
                // 未登录则跳转登录页面，并携带当前页面的路径
                // 在登录成功后返回当前页面，这一步需要在登录页操作。
                case 401:

                    break;
                case 403:

                    break;

                // 404请求不存在
                case 404:

                    break;
                // 其他错误，直接抛出错误提示
                default:

            }
            return Promise.reject(error.response);
        }
    })
export default service;