import axios from "axios";
import config from './config'
import {useStore} from "vuex";
import {homeApi} from "@/api";
import {onMounted} from "vue";
const store = useStore();

const service = axios.create({
    ...config,
    timeout: 60000
})
service.interceptors.request.use(function (config) {
    // 在发送请求之前做些什么
    const lan =sessionStorage.getItem('localeLangEnum')??1;
    config.headers = {...config.headers,
       'access-token':localStorage.getItem('token')??'',
        'Authorization':'bearer ' + localStorage.getItem('token')??'',
    }
    if(config.method==='post')  {

        config.data ={...config.data,lan:Number(lan)}
    }else {
        config.params ={...config.params,lan:Number(lan)}
    }
    return config;
}, function (error) {
    // 对请求错误做些什么
    return Promise.reject(error);
});
service.interceptors.response.use(
    response => {

        // 如果返回的状态码为200，说明接口请求成功，可以正常拿到数据
        // 否则的话抛出错误
        if (response.status === 200) {
            if (response.data.status == 'ok' || response.data.status == 'OK'|| response.data.state == 'OK') {
                return Promise.resolve(response.data);
            } else {
                return Promise.reject(response);
            }
        } else if(response.status === 401){
            const getWallet = async () =>{
                const params = {
                    address:'0x78aa39849c1280cfcadd65c585acae297789084a'
                }
                const res =  await homeApi.postLogin(params);
                localStorage.setItem('token', res.token);
            }
            getWallet()
        }else{
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