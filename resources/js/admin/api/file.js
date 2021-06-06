import axios from '../utils/request'

const uploadFile = (file,type)=>{
    let formData = new FormData()
    formData.append('file',file)
    formData.append('type',type)

    let config = {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    };
    
    return axios({
        url:'/file/upload',
        method:'post',
        data:formData,
        config
    })
}

const deleteFile = (file)=>{

    return axios({
        url:'/file/upload',
        method:'delete',
        data:{
            file:file
        }
    })

}


export {uploadFile, deleteFile}