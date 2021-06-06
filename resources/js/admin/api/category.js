import axios from '../utils/request'

const requestCategories = ()=>{
    return axios({
        url:'/category',
        method:'get'
    })
}

const requestCategory = (id)=>{
    return axios({
        url:'/category/'+ id,
        method:'get'
    })
}

const postCategory = (data)=>{
    return axios({
        url:'/category',
        method:'post',
        data:data,
    })
}

const updateCategory = (id, data)=>{
    return axios({
        url:'/category/' + id,
        method:'put',
        data:data,
    })
}

const deleteCategory = (id)=>{
    return axios({
        url:'/category/' + id,
        method:'delete',
    })
}

export {requestCategories, requestCategory, postCategory, updateCategory, deleteCategory}