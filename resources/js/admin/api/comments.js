import axios from '../utils/request'

const requestComments = ()=>{
    return axios({
        url:'/comments',
        method:'get'
    })
}

const requestComment = (id)=>{
    return axios({
        url:'/comments/'+ id,
        method:'get'
    })
}

const approveComment = (id)=>{
    return axios({
        url:'/comments/'+ id + '/approved',
        method:'get'
    })
}

const deleteComment = (id)=>{
    return axios({
        url:'/comments/' + id,
        method:'delete',
    })
}

export {requestComments, requestComment, approveComment, deleteComment}