import React from 'react'
import { Link } from 'react-router-dom'
import Paginator from '../common/Paginator'
import { requestUsers} from '../../api/users'

export default ()=>{

    const [users, setUsers] = React.useState([]);
    const [pagination, setPagination] = React.useState([]);

    React.useEffect(()=>{
        requestUsers().then((res)=>{
            setUsers(res.data.data)
            delete res.data.data
            setPagination(res.data)
        })
    },[])

    const renderList = users.map((user)=>{

        return (
            <tr key={user.id}>
                <td className="px-6 py-4 whitespace-nowrap">
                    <div className="flex items-center">
                    <div className="flex-shrink-0 h-10 w-10">
                        <img className="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="" />
                    </div>
                    <div className="ml-4">
                        <div className="text-sm font-medium text-gray-900">
                        {user.nickname}
                        </div>
                        <div className="text-sm text-gray-500">
                        {user.email}
                        </div>
                    </div>
                    </div>
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                   {user.username}
                </td>
                <td className="px-6 py-4 whitespace-nowrap">
                    {user.active==1?
                    <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Active
                    </span>
                    :''
                    }
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    Admin
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" className="text-indigo-600 hover:text-indigo-900">Edit</a>
                </td>
            </tr>
        )

    })

    return(
        <div>
            <div className="border-b border-gray-200 border-solid w-full py-10 items-center flex justify-between">
                <h1 className="ml-20 font-bold">用户列表</h1>
                <div className="mr-10 flex text-sm">
                    <Link to="#" className="bg-red-500 text-white px-4 py-2 rounded flex">
                        <svg className="h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span className="hidden md:block ml-1">删除</span>
                    </Link>
                </div>
            </div>

            <div className="flex flex-col">
                <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div className="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table className="min-w-full divide-y divide-gray-200">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>
                                    <th scope="col" className="relative px-6 py-3">
                                        <span className="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                
                                {renderList}

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <Paginator pagination={pagination}/>

        </div>
        )
}