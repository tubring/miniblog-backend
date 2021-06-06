import axios from '../utils/request'

const requestUsers = ()=>{
    return axios({
        url:'/users',
        method:'get'
    })
}

const requestUser = (id)=>{
    return axios({
        url:'/users/' + id,
        method:'get'
    })
}

const deleteUser = (id)=>{
    return axios({
        url:'/users/' + id,
        method:'delete',
    })
}

const requestAdmins = ()=>{
    return axios({
        url:'/users/admins',
        method:'get',
    })
}

//将用户设置为管理员
const postAdmin = (id)=>{
    return axios({
        url:'/users/' + id + '/admin',
        method:'post',
    })
}

const deleteAdmin = (id)=>{
    return axios({
        url:'/users/' + id + '/admin',
        method:'delete',
    })
}

export {requestUsers, requestUser, deleteUser, postAdmin, deleteAdmin}