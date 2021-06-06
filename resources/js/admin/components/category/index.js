import React from 'react'
import { Link } from 'react-router-dom'
import { deleteCategory, requestCategories } from '../../api/category'
import EmptyBody from '../common/EmptyBody'

export default ()=>{

    const [categories, setCategories] = React.useState([]);

    React.useEffect(()=>{
       requestData()
    },[])

    const requestData = ()=>{
        requestCategories().then((res)=>{
            if(res.status==200){
                setCategories(res.data)
            }
        })
    }

    const renderList = categories.map((category)=>{

        return(
            <tr key={category.id}>
                <td className="px-6 py-4 whitespace-nowrap">
                    <input id="article_id" name="id[]" type="checkbox" className="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-500 rounded" value={category.id} />
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                    {category.name}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <img src={category.image_url} />
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link to={"/category/edit/" + category.id} className="text-indigo-600 hover:text-indigo-900 mr-2">Edit</Link>
                    <button className="text-red-600 hover:text-red-900" onClick={()=>{
                        deleteCategory(category.id).then((res)=>{
                            requestData()
                        })
                    }}>Delete</button>
                </td>
            </tr>
        )
    })

    return(
        <div className="w-full">
            <div className="border-b border-gray-200 border-solid w-full py-10 items-center flex justify-between">
                <h1 className="ml-20 font-bold">文章分类</h1>
                <div className="items-center mr-10 flex">
                    <Link to="/category/edit" className="bg-blue-500 text-white px-4 py-2 mr-2 rounded items-center text-sm flex" title="添加分类">
                        <svg className="h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span className="hidden md:block ml-1">添加</span>
                    </Link>
                    <Link to="/category/delete" className="bg-red-500 text-white px-4 py-2 rounded items-center text-sm flex">
                        <svg className="h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span className="hidden md:block ml-1">删除</span>
                    </Link>
                </div>
            </div>
            <div className="flex flex-col">
                <div className="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table className="min-w-full divide-y divide-gray-200">
                        <thead className="bg-gray-50">
                            <tr>
                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input id="all" type="checkbox" className="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-500 rounded" />
                                </th>
                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    名称
                                </th>
                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    图标
                                </th>
                                <th scope="col" className="relative px-6 py-3">
                                    <span className="sr-only">Operation</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody className="bg-white divide-y divide-gray-200">

                            {
                                categories.length!=0?
                                renderList
                                :<EmptyBody colSpan={4}/>
                            }

                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    )
}