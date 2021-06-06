import React from 'react'
import { uploadFile } from '../../api/file'

// export default (props) => {

//     const upload = ()=>{

//     }

//     const abort = () =>{
//         alert('qqq')
//     }

//     return  props.file
// }

export default class UploadAdapter{
    constructor(loader){
        this.loader = loader
    }

    upload(){
        // this.loader.uploadType(true)
        return this.loader.file
        .then((file)=>{
            return new Promise(async(resolve,reject)=>{
                let res = await uploadFile(file,'articles')
                console.log(res)
                resolve({default:"http://miniblog.com/storage/"+res.data})
            })
            
        })
    }

    abort(){
        console.log("abort")
    }


}