import Axios from 'axios'
import apiConfig, {env, development, production} from '../api/api.config'

const baseURL = env=='development'?development.host:production.host

const axios = Axios.create({
    baseURL: baseURL,
})

axios.interceptors.request.use((config)=>{
    let token = window.sessionStorage.token;
    if(token){
        config.headers.Authorization = 'Bearer ' + token;
    }
    return config
},(error)=>{
    return Promise.reject(error);

})


axios.interceptors.response.use(function (response) {
    return response;
  }, function (error) {
    if (error.response.status === 401) {
        console.log('Error message:',error.response.data.message);
    }
    return Promise.reject(error);
  });

export default axios