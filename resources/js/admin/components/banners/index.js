import React from 'react'
import { Link } from 'react-router-dom'
import Paginator from '../common/Paginator';
import {deleteBanner, requestBanners} from '../../api/banners'
import EmptyBody from '../common/EmptyBody';

export default (props)=>{

    const [banners, setBanners] = React.useState([]);

    React.useEffect(()=>{
        requestData()
    },[])

    const requestData = ()=>{
        requestBanners().then((res)=>{
            if(res.status==200){
                console.log(res)
                setBanners(res.data)
            }
        })
    }
    

    const renderList = banners.map((banner)=>{
        return (
            <tr key={banner.id}>
                <td className="px-6 py-4 whitespace-nowrap">
                    <input id="article_id" name="id[]" type="checkbox" className="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-500 rounded" />
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                    {banner.name}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <img src={banner.image_url} />
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                    {
                        banner.active==1?
                            <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                            </span>
                            :
                            <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-500 text--800">
                            Inactive
                            </span>
                    }
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {banner.sort_order}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {banner.link}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link to={"/banners/edit/"+banner.id} className="p-1 text-indigo-600 hover:text-indigo-900 mr-2">Edit</Link>
                    <button className="text-red-600 hover:text-red-900" onClick={()=>{
                        deleteBanner(banner.id).then((res)=>{
                            if(res.status==204){
                                requestData()
                            }
                        })
                    }}>Delete</button>
                </td>
            </tr>
        )
    })

    return(
        <div className="w-full">
            <div className="border-b border-gray-200 border-solid w-full py-10 items-center flex justify-between">
                <h1 className="ml-20 font-bold">Banner列表</h1>
                <div className="mr-10 flex text-sm">
                    <Link to="/banners/edit" className="bg-blue-500 text-white px-4 py-2 mr-2 rounded items-center flex" title="添加">
                        <svg className="h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span className="hidden md:block ml-1">添加</span>
                    </Link>
                    <button className="bg-red-500 text-white px-4 py-2 rounded ml-2 flex">
                        <svg className="h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span className="hidden md:block ml-1">删除</span>
                    </button>
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
                                    图片
                                </th>
                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    状态
                                </th>
                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    排序
                                </th>
                                <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    链接
                                </th>
                                <th scope="col" className="relative px-6 py-3">
                                    <span className="sr-only">Operation</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody className="bg-white divide-y divide-gray-200">
                            {banners.length!=0?
                                renderList
                                :<EmptyBody colSpan={7} />
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