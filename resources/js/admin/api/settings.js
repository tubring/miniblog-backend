const { default: axios } = require("../utils/request")

const requestSettings = ()=>{

    return axios({
        url:'/settings',
        method:'get',
    })
}

const updateSetting = (data)=>{
    return axios({
        url:'/settings',
        method:'post',
        data:data,
    })
}

export {requestSettings, updateSetting}