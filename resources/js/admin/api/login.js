import axios from '../utils/request'

const _auth = {
    grant_type:'password',
    client_id:'925c767e-e8ce-4902-bd6a-0ecda0ea69ff',
    client_secret:'3ax5WRJ5N6M6a5a94h9ajmbR90eol9zMdzpXOonm',
}

const login = (data)=>{
    return axios({
        url:'/login',
        method:'post',
        data:data
    })
}


export {login}