import axios from '../utils/request'

const requestArticles = ()=>{
    return axios({
        url:'/articles',
        method:'get'
    })
}

const requestArticle = (id)=>{
    return axios({
        url:'/articles/'+ id,
        method:'get'
    })
}

const postArticle = (data)=>{
    return axios({
        url:'/articles',
        method:'post',
        data:data,
    })
}

const updateArticle = (id, data)=>{
    return axios({
        url:'/articles/' + id,
        method:'put',
        data:data,
    })
}

const deleteArticle = (id)=>{
    return axios({
        url:'/articles/' + id,
        method:'delete',
    })
}

const activeArticle = (id)=>{
    return axios({
        url:'/articles/' + id + '/active',
        method:'get',
    })
}

const requestComments = (id)=>{
    return axios({
        url:'/articles/' + id + '/comments',
        method:'get',
    })
}

export {requestArticles, requestArticle, postArticle, updateArticle, deleteArticle, activeArticle, requestComments }