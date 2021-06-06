import { event } from 'jquery';
import React from 'react'
import { Link, useParams } from 'react-router-dom';
import { updateCategory, requestCategory, postCategory} from '../../api/category'
import { uploadFile } from '../../api/file'

export default (props) => {

    const [category, setCategory] = React.useState({})

    const params = useParams()

    React.useEffect(()=>{
        let id = params.id
        if(id){
            requestCategory(id).then((res)=>{
                if(res.status==200){
                    console.log(res.data)
                    setCategory(res.data)
                }
            })
        }

    },[])

    const handleSubmit = ()=>{
        console.log(category)
        if(category.id){
            updateCategory(category.id,category).then((res)=>{
                if(res.status==201){
                    setCategory(res.data)
                    props.history.push('/category')
                }
            })
        }else{
            postCategory(category).then((res)=>{
                if(res.status==201){
                    setCategory(res.data)
                    props.history.push('/category')
                }
            })
        }
    }

    const handleUpload = (event)=>{

        console.log('filechange',event.target.files[0])
        let file = event.target.files[0]
        uploadFile(file,'category').then((res)=>{
            console.log(res)
            if(res.status==201){
                setCategory({...category,icon:res.data.path})
            }
        })
    }

    return (
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
                    <Link to="/category" className="text-gray-500 hover:text-blue-500">文章分类</Link>
                    <svg className="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                    <span className="text-blue-500">编辑/添加分类</span>
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
                        分类名称
                    </label>
                    <input className="ml-5 px-2 py-1 border border-solid border-gray-500 rounded-md w-28" defaultValue={category.name||''} onBlur={(event)=>{
                        setCategory({...category,name:event.target.value})

                    }} />
                </div>

                <div className="flex flex-row pl-2 py-2 lg:w-1/2 items-center">
                    <label className="py-1 w-20">排序</label>
                    <input className="ml-5 px-2 py-1 border border-solid border-gray-500 rounded-md w-28" defaultValue={category.sort_order||''} onBlur={(event)=>{
                        setCategory({...category,sort_order:event.target.value})
                    }} />
                </div>

                <div className="flex lg:flex-row flex-col pl-2 py-2 w-full">
                    <label className="py-1 w-20">描述</label>
                    <textarea className="lg:ml-5 my-1 px-2 py-1 border border-solid border-gray-500 rounded-md shadow-sm w-1/2" rows="3" defaultValue={category.description||''} onBlur={(event)=>{
                        setCategory({...category,description:event.target.value})

                    }}></textarea>  
                </div>


                <div className="flex lg:flex-row flex-col pl-2 py-2 w-full">
                    <label className="py-1 w-20">图片</label>
                    <div className="mt-2 ml-5 flex items-center">
                        <span className="inline-block h-24 w-24 rounded overflow-hidden bg-gray-100">
                            {category.icon?
                                <img className="h-full w-full text-gray-300" src={category.icon_url}/>
                                :
                                <svg className="h-full w-full text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            }
                            
                        </span>
                        <label htmlFor="file" className="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span>Change</span>
                            <input id="file" type="file" className="sr-only" onChange={(event)=>{handleUpload(event)}} />
                        </label>
                    </div>
                </div>


                
            </div>

        </div>
        
    )
}