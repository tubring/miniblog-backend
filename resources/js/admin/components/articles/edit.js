import React from 'react'
import { Link, useLocation, useParams } from 'react-router-dom';
import { CKEditor } from '@ckeditor/ckeditor5-react';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {requestArticle, postArticle, updateArticle} from '../../api/articles'
import { uploadFile } from '../../api/file';
import UploadAdapter from '../common/UploadAdapter';
import { requestCategories } from '../../api/category';

export default (props) => {

    const [article, setArticle] = React.useState({
        id:null,
        title:'',
        author:'',
        category_id:'',
        desription:'',
        content:'',
        views:'',
    });

    const [categories, setCategories] = React.useState([])

    const params = useParams()

    React.useEffect(()=>{
        requestData()
        requestCates()

    },[])

    const requestCates = ()=>{
        requestCategories().then((res)=>{
            console.log(res)
            if(res.status==200){
                setCategories(res.data);
            }
        })
    }

    const requestData = ()=>{
        let id = params.id
        if(id){
            requestArticle(id).then((res)=>{
                console.log('request:',res)
                if(res.status==200){
                    setArticle(res.data)
                }
            })
        }
    }

    const handleSubmit = (id=null)=>{

        validateData(article)

        if(article.id){
            updateArticle(article.id,article).then((res)=>{
                console.log('update:',res)
                if(res.status==201){
                    setArticle(res.data)
                }

            })
        }else{
            postArticle(article).then((res)=>{
                console.log('post:',res)
                if(res.status==200){
                    setArticle(res.data)
                }
                props.history.push('/articles')

            })
        }

    }

    const handleUpload = (event)=>{
        let file = event.target.files[0]

        uploadFile(file,'articles').then((res)=>{
            console.log(res)
            if(res.status==201){
                setArticle({...article,image:res.data.path})
            }
        })
    }

    const validateData = ()=>{
        if(article.title.trim()==''){
            
        }
    }

    const renderCates = categories.map((item)=>{
        return (
            <option value={item.id} key={item.id} selected={item.id==article.category_id }>{item.name}</option>
        )
    })

    return (
        <div className="w-full py-5">
            <div className="border-b border-solid border-gray-500 py-10 px-10 flex items-center justify-between">
                <div className="flex items-center">
                    <Link to="/" className="text-gray-500 hover:text-blue-500 flex mr-1">
                        <svg className="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span className="ml-1 hidden md:block">首页</span>
                    </Link> 
                    <svg className="h-5 w-5 mr-1 hidden md:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                    <Link to="/articles" className="text-gray-500 hover:text-blue-500 hidden md:block">文章列表</Link>
                    <svg className="h-5 w-5 mr-1 hidden md:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                    <span className="text-blue-500">撰写新文章</span>
                </div>
                <div className='text-sm flex'>

                    <button className="bg-green-500 text-white hover:bg-green-200 hover:border-none flex py-2 px-4 rounded ml-2" onClick = {()=>{
                        console.log('button click:',article)
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
                    <label className="py-1">
                        标题
                    </label>
                    <input className="ml-5 p-1 border border-solid border-gray-500 rounded-md w-3/5"
                        defaultValue={article.title}  

                        onBlur ={(event)=>{

                            setArticle({...article, title:event.target.value})
                            console.log(article)
                        }} 
                    />
                </div>

                <div className="flex flex-row pl-2 py-2 lg:w-1/2 items-center">
                    <label className="items-center py-1">作者</label>
                    <input className="ml-5 p-1 border border-solid border-gray-500 rounded-md w-28"
                        defaultValue={article.author}
                        onBlur ={
                            (event)=>{
                                setArticle({...article, author:event.target.value})

                                console.log(article)
                            }
                        } 
                    />
                </div>

                <div className="flex flex-row pl-2 py-2 lg:w-1/2 items-center">
                    <label className="items-center py-1">分类</label>
                    <select id="category_id" name="category_id" className="ml-5 py-1 border border-solid border-gray-500 rounded w-28 sm:text-sm rounded-md" 
                    onChange = {
                        (event)=>{
                            setArticle({...article, category_id:event.target.value})

                            console.log(article)
                        }
                    }>
                        <option value="0">选择分类</option>
                        {renderCates}
                    </select>
                </div>

                <div className="flex flex-row pl-2 py-2 lg:w-1/2 items-center">
                    <label className="items-center py-1">状态</label>
                    <input id="active" name="active" type="radio" className="ml-5 my-1 border border-solid border-gray-500 rounded-md" onChange ={()=>{}} checked/>
                    <label htmlFor="active" className="active text-sm ml-2">立即发布</label>
                    <input type="radio" id="inactive" name="active" className="ml-5 my-1 border border-solid border-gray-500 rounded-md" onChange ={()=>{}} /> 
                    <label htmlFor="inactive" className="inactive text-sm ml-2">草稿</label>
                </div>

                <div className="flex lg:flex-row flex-col pl-2 py-2 w-full">
                    <label className="items-center py-1">简述</label>
                    <textarea className="lg:ml-5 my-1 border border-solid border-gray-500 rounded-md shadow-sm w-1/2 px-2 py-1" rows="3" 
                        defaultValue={article.description}
                        onBlur = {(event)=>{
                            setArticle({...article, description:event.target.value})

                            console.log('description',article)
                        }} 
                    ></textarea>  
                </div>

                <div className="flex lg:flex-row flex-col pl-2 py-2 w-full">
                    <label className="items-center py-1">正文</label>
                    <div className="lg:mx-5 my-1 shadow-sm lg:w-2/3">
                        <CKEditor
                            editor={ ClassicEditor }
                            data={article.content}
                            onReady={(editor)=>
                                {

                                    editor.plugins.get("FileRepository").createUploadAdapter = function(loader) {
                                       return new UploadAdapter(loader)
                                     };
                                    // requestData();
                                }
                            }
                            onChange = {(event,editor)=>{
                                // const content = editor.getData();
                                // setArticle({...article,content})//bug?:此处一旦setArticle，便只有article.content

                            }}

                            onBlur = {
                                (event,editor)=>{
                                    let data = editor.getData();
                                    setArticle({...article,content:data})
                                }
                            }

                        />
                    </div>                    
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