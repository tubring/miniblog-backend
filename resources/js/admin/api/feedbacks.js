import axios from '../utils/request'

const requestFeedbacks = ()=>{
    return axios({
        url:'/feedbacks',
        method:'get'
    })
}

const requestFeedback = (id)=>{
    return axios({
        url:'/feedback/'+ id,
        method:'get'
    })
}

const deleteFeedback = (id)=>{
    return axios({
        url:'/feedbacks/' + id,
        method:'delete',
    })
}

const readFeedback = (id)=>{
    return axios({
        url:'/feedbacks/' + id + '/read',
        method:'get',
    })
}

export {requestFeedbacks, requestFeedback, deleteFeedback, readFeedback}