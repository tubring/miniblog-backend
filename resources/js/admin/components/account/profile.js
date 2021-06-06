import React from 'react'
import { AuthContext } from '../../contexts/AuthContext'

export default ()=>{

    return (
        <AuthContext.Consumer>
            {
                value=>{
                    console.log("value in profile", value.value.token)
                    let token = sessionStorage.getItem('token')
                    console.log('token in session',token)
                    let user = value.value.user
                    console.log('user',user)
                    return (
                        <div className="w-full px-5 py-2">
                            <div>
                                <div className="w-full">
                                    <div className="border-b border-gray-200 border-solid w-full py-10 items-center flex justify-between">
                                    <h1 className="ml-20 font-bold">用户资料</h1>
                                    <div className="mr-10 flex text-sm">
                                        <button className="bg-blue-500 text-white px-4 py-2 mr-2 rounded items-center flex" title="添加新文章">
                                            <svg className="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span className="hidden md:block ml-1">保存</span>
                                        </button>
                                    </div>
                                </div>

                                    <div className="mt-5 md:mt-0 md:col-span-2">
                                        <form action="#" method="POST">
                                            <div className="sm:rounded-md sm:overflow-hidden">
                                                <div className="px-4 py-5 bg-white space-y-6 sm:p-6">
                                                    <div className="grid grid-cols-3 gap-6">
                                                        <div className="col-span-3 sm:col-span-2">
                                                            <label htmlFor="nickname" className="block text-sm font-medium text-gray-700">
                                                            昵称
                                                            </label>
                                                            <div className="mt-1 flex rounded-md shadow-sm">
                                                                <input type="text" name="nickname" id="nickname" className="p-2 border border-solid focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="John Doe" defaultValue={user.nickname} />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div className="grid grid-cols-3 gap-6">
                                                        <div className="col-span-2 sm:col-span-2">
                                                            <label htmlFor="gender" className="block text-sm font-medium text-gray-700">
                                                            性别
                                                            </label>
                                                            <div className="mt-1 flex rounded-md">
                                                                <select className="p-2 border border-solid rounded-md">
                                                                    <option>男</option>
                                                                    <option>女</option>
                                                                    <option>其他</option>
                                                                    <option>保密</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div className="grid grid-cols-3 gap-6 flex">
                                                        <div className="col-span-2 sm:col-span-2">
                                                            <label htmlFor="email" className="block text-sm font-medium text-gray-700">
                                                            邮箱
                                                            </label>
                                                            <div className="mt-1 flex rounded-md shadow-sm">
                                                                <input type="text" name="email" id="email" className="p-2 border border-solid focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" defaultValue={user.email||''} placeholder="www.example.com" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label htmlFor="about" className="block text-sm font-medium text-gray-700">
                                                            个人简介
                                                        </label>
                                                        <div className="mt-1">
                                                            <textarea id="about" name="about" rows="3" className="p-2 border border-solid shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com" defaultValue={user.about}></textarea>
                                                        </div>
                                                        <p className="mt-2 text-sm text-gray-500">
                                                            Brief description for your profile. 
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <label className="block text-sm font-medium text-gray-700">
                                                            头像
                                                        </label>
                                                        <div className="mt-2 flex items-center">
                                                            <span className="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                                                {
                                                                user.avatar?
                                                                <img className="w-full h-full" src={user.avatar_url} />
                                                                :
                                                                <svg className="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                                </svg>
                                                                }
                                                            </span>
                                                            <label htmlFor='file' className="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            Change
                                                                <input id='file' type="file" name='file' className="sr-only" />
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <label className="block text-sm font-medium text-gray-700">
                                                            密码
                                                        </label>
                                                        <div className="mt-2 flex items-center">
                                                            <button type="button" className="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            修改密码
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                               
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>
                    )
                }
            }

        </AuthContext.Consumer>
        
    )

}