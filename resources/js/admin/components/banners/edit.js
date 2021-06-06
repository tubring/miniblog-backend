import React from 'react'
import { Link, useParams } from 'react-router-dom'
import { postBanner, requestBanner, updateBanner } from '../../api/banners'
import { uploadFile } from '../../api/file'

export default (props) => {

    const [banner, setBanner] = React.useState({})

    const params = useParams()

    React.useEffect(()=>{
        let id = params.id
        if(id){
            requestBanner(id).then((res)=>{
                if(res.status==200){
                    setBanner(res.data)
                }
            })
        }
    },[])

    const handleUpload = (event)=>{
        let file = event.target.files[0]

        uploadFile(file,'banners').then((res)=>{
            console.log(res)
            if(res.status==201){
                setBanner({...banner,image:res.data.path})
            }
        })
    }

    const handleSubmit = ()=>{
        if(banner.id){
            updateBanner(banner.id,banner).then((res)=>{
                if(res.status==201){
                    props.history.push('/banners')
                }
            })
        }else{
            postBanner(banner).then((res)=>{
                if(res.status==200){
                    props.history.push('/banners')
                }
            })
        }
    }
    

    return(
        <div className="w-full py-5">

            <div className="border-b border-solid border-gray-500 py-10 px-10 flex items-center justify-between">
                <div className="flex items-center">
                    <Link to="/" className="text-gray-500 hover:text-blue-500 flex">
                        <svg className="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        首页
                    </Link> 
                    <svg className="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                    <Link to="/banners" className="text-gray-500 hover:text-blue-500">Banner管理</Link>
                    <svg className="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                    <span className="text-blue-500">编辑/添加Banner</span>
                </div>
                <div className='text-sm flex'>

                    <button className="bg-green-500 text-white hover:bg-green-200 text-white hover:bg-green-300 hover:border-none flex py-2 px-4 rounded ml-2" onClick={()=>{
                        handleSubmit()
                    }}>
                        <svg className="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                        </svg>
                        <span className="hidden md:block">保存</span>
                    </button>
                </div>
                
            </div>
            <div className="pl-10 py-5">
                <div className="flex flex-row pl-2 py-2 lg:w-2/3 items-center">
                    <label className="py-1 w-20">
                        名称
                    </label>
                    <input className="ml-5 px-2 py-1 border border-solid border-gray-500 rounded-md w-28" defaultValue={banner.name||''} onBlur={(event)=>{
                        setBanner({...banner,name:event.target.value})

                    }} />
                </div>

                <div className="flex flex-row pl-2 py-2 lg:w-1/2 items-center">
                    <label className="py-1 w-20">排序</label>
                    <input className="ml-5 px-2 py-1 border border-solid border-gray-500 rounded-md w-28" defaultValue={banner.sort_order||''} onBlur={(event)=>{
                        setBanner({...banner,sort_order:event.target.value})
                    }} />
                </div>

                <div className="flex flex-row pl-2 py-2 lg:w-2/3 items-center">
                    <label className="py-1 w-20">链接</label>
                    <input className="ml-5 px-2 py-1 border border-solid border-gray-500 rounded-md w-80" defaultValue={banner.link||''} onBlur={(event)=>{
                        setBanner({...banner,link:event.target.value})
                    }} />
                </div>

                <div className="flex lg:flex-row flex-col pl-2 py-2 w-full">
                    <label className="py-1 w-20">文案</label>
                    <textarea className="lg:ml-5 my-1 px-2 py-1 border border-solid border-gray-500 rounded-md shadow-sm w-1/2" rows="3" defaultValue={banner.copy||''} onBlur={(event)=>{
                        setBanner({...banner,description:event.target.value})

                    }}></textarea>  
                </div>

                <div className="flex lg:flex-row flex-col pl-2 py-2 w-full">
                    <label className="items-center py-1">
                        图片
                    </label>
                    <div className="lg:ml-5 mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md w-2/3">
                        <div className="space-y-1 text-center">
                            <svg className="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                            </svg>
                            <div className="flex text-sm text-gray-600">
                                <label htmlFor="file-upload" className="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="file-upload" name="file" type="file" className="sr-only" onChange={(event)=>handleUpload(event)} />
                                </label>
                                <p className="pl-1">or drag and drop</p>
                            </div>
                            <p className="text-xs text-gray-500">
                                PNG, JPG, GIF up to 200KB
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    
    )

}