import axios from '../utils/request'

const requestBanners = ()=>{
    return axios({
        url:'/banners',
        method:'get'
    })
}

const requestBanner = (id)=>{
    return axios({
        url:'/banners/'+ id,
        method:'get'
    })
}

const activeBanner = (id)=>{
    return axios({
        url:'/banners/'+ id + '/active',
        method:'get'
    })
}

const postBanner = (data)=>{
    return axios({
        url:'/banners',
        method:'post',
        data:data,
    })
}

const updateBanner = (id, data)=>{
    return axios({
        url:'/banners/' + id,
        method:'put',
        data:data,
    })
}

const deleteBanner = (id)=>{
    return axios({
        url:'/banners/' + id,
        method:'delete',
    })
}

export {requestBanners, requestBanner, postBanner, updateBanner, deleteBanner, activeBanner}