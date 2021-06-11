import React from 'react';
import { Link, Redirect } from 'react-router-dom';
import { AuthContext,AuthProvider } from '../contexts/AuthContext'
import { Toast, showToast } from '../components/common/Toast'
 
export default class LoginPage extends React.Component{

    constructor(props){
        super(props)
        this.state = {username:'',password:'',remember_me:false,warning:false,toast:''};
    }
    

    render(){
        return(
            // <AuthProvider>
            <AuthContext.Consumer>
                {
                    value=>{
                        console.log("value in login",value)
                        let token = window.sessionStorage.getItem('token')
                        console.log('token in session',token)
                        if(!token){

                            return (
                                <div className="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
                                    <div className="max-w-md w-full space-y-8">
                                        <div>
                                            <img className="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow"/>
                                            <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
                                            后台登陆
                                            </h2>
                                        </div>
                                        <div className="mt-8 space-y-6">
                                            <input type="hidden" name="remember" value="true" />
                                            <div className="rounded-md shadow-sm -space-y-px">
                                                <div>
                                                    <label htmlFor="username" className="sr-only">用户名</label>
                                                    <input id="username" name="username" type="text" autoComplete="username" required className="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="用户名" value={this.state.username} onChange={(event)=>{
                                                        this.setState({username:event.target.value})
                                                    }} />
                                                </div>
                                                <div>
                                                    <label htmlFor="password" className="sr-only">密码</label>
                                                    <input id="password" name="password" type="password" autoComplete="current-password" required className="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="密码" value={this.state.password} onChange={(event)=>{
                                                        this.setState({password:event.target.value})
                                                    }} />
                                                </div>
                                            </div>

                                            <div className="flex items-center justify-between">
                                                <div className="flex items-center">
                                                    <input id="remember_me" name="remember_me" type="checkbox" className="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked={this.state.remember_me} onChange={(event)=>{
                                                        // console.log(event.target.checked)
                                                        // this.setState({remember_me:event.target.value})
                                                    }} />
                                                    <label htmlFor="remember_me" className="ml-2 block text-sm text-gray-900">
                                                        记住我
                                                    </label>
                                                </div>

                                                <div className="text-sm">
                                                    <Link to="#" className="font-medium text-indigo-600 hover:text-indigo-500">
                                                        忘记密码?
                                                    </Link>
                                                </div>
                                            </div>

                                            <div>
                                                <button type="submit" className="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onClick={()=>{
                                                    console.log('value',value)
                                                    value.userLogin({
                                                        username:this.state.username,
                                                        password:this.state.password
                                                    }).then((res)=>{
                                                        console.log('res:',res)
                                                        if(res.status==200){
                                                            value.setValue(res.data)
                                                            window.sessionStorage.setItem('token',res.data.token)
                                                            this.props.history.push('/index')
                                                        }
                                                        
                                                    },(error)=>{
                                                        console.log('error:',error)
                                                        let toast = <Toast type="warning" message="账号或密码错误！" />
                                                        this.setState({toast})
                                                        
                                                    })
                                                    

                                                }} >
                                                    <span className="absolute left-0 inset-y-0 flex items-center pl-3">
                                                        <svg className="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fillRule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clipRule="evenodd" />
                                                        </svg>
                                                    </span>
                                                    Sign in
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>{this.state.toast}</div>
                                </div>
                            )
                        }else{
                            return <Redirect to="/index" />
                        }
                    }

                }    
            </AuthContext.Consumer>
            // </AuthProvider>
        )    
        

    }
}
