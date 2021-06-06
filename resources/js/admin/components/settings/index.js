import React from 'react'
import { Link } from 'react-router-dom'
import {requestSettings, updateSetting} from '../../api/settings'
import {Toast, showToast} from '../common/Toast'
import Switch from '../common/Switch'
import { set } from 'lodash'
import { comment } from 'postcss'

export default ()=>{

    const [settings, setSettings] = React.useState([]);
    const [toast, setToast] = React.useState();
    const [showEditor, setShowEditor] = React.useState(false);
    const [commentable, setCommentable] = React.useState();

    React.useEffect(()=>{
        requestData()
    },[])

    const requestData = ()=>{
        requestSettings().then((res)=>{
            console.log(res)
            setSettings(res.data)
            setCommentable(res.data['app.commentable']==1)
        })
    }

    return(
        <div>
            <div className="border-b border-gray-200 border-solid w-full py-10 items-center flex justify-between">
                <h1 className="ml-20 font-bold">站点设置</h1>
                
            </div>
            
            <div className="border-t border-gray-200">
                <dl>
                    <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">
                        站点名称
                        </dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <input className="px-2 py-1 border-b border-solid border-gray-500 w-28" defaultValue={settings['app.name']||''} name="app.name" onBlur={(event)=>{
                                let value = event.target.value
                                if(value.trim() != settings['app.name'] ){
                                    let data ={key:'app.name',value:event.target.value}
                                    updateSetting(data).then((res)=>{
                                        if(res.status==201){
                                            setSettings({...settings,'app.name':res.data.value})
                                            let toast = <Toast type='success' message='修改成功' />
                                            showToast(toast,setToast)
                                        }
                                    })

                                }
                               

                            }} />
                        
                        </dd>
                    </div>
                    <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">
                        网站Logo
                        </dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        
                        </dd>
                    </div>
                    <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">
                        二维码
                        </dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        
                        </dd>
                    </div>

                    <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">
                        Slogan
                        </dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <input className="px-2 py-1 border-b border-solid border-gray-500 w-80" defaultValue={settings['app.slogan']||''} name="app.slogan" onBlur={(event)=>{
                                    let value = event.target.value
                                    if(value.trim() != settings['app.slogan'] ){
                                        let data ={key:'app.slogan',value:event.target.value}
                                        updateSetting(data).then((res)=>{
                                            if(res.status==201){
                                                setSettings({...settings,'app.slogan':res.data.value})
                                                let toast = <Toast type='success' message='修改成功' />
                                                showToast(toast,setToast)
                                            }
                                        })

                                    }
                            }} />
                        </dd>
                    </div>
                
                    <div className="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">
                        关于
                        </dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                        {!showEditor?
                            <div className="px-2 py-1 border-b border-solid border-gray-500"  dangerouslySetInnerHTML={{__html:settings['app.about']}} onClick={()=>{
                                setShowEditor(!showEditor)
                            }} ></div>
                            :
                            <textarea className="px-2 py-1 border-b border-solid border-gray-500 w-80" defaultValue={settings['app.about']||''} name="app.about" onBlur={(event)=>{
                                console.log('on Blur')

                                let value = event.target.value
                                if(value.trim() != settings['app.about'] ){
                                    let data ={key:'app.about',value:event.target.value}
                                    updateSetting(data).then((res)=>{
                                        if(res.status==201){
                                            setSettings({...settings,'app.about':res.data.value})
                                            let toast = <Toast type='success' message='修改成功' />
                                            showToast(toast,setToast)
                                        }
                                    })
                                    
                                }
                                setShowEditor(!showEditor)
                                console.log('here')
                            }}></textarea>
                        }

                        </dd>
                    </div>
                    <div className="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500" title="开启/关闭整站评论功能">
                        评论功能
                        </dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                            <Switch 
                                enable={commentable} 
                                handleSwitch={(value)=>{
                                    console.log('value::',value)
                                    let data = {key:'app.commentable', value:value}
                                    updateSetting(data).then((res)=>{
                                        if(res.status==201){
                                            console.log(res.data)
                                            setSettings({...settings,'app.commentable':res.data.value})
                                            setCommentable(value)
                                            let message = '站点评论功能'+(res.data.value==1?'已开启':'已关闭')
                                            let toast = <Toast type='success' message={message} />
                                            showToast(toast,setToast)
                                        }
                                })
                            }}></Switch>

                        </dd>
                    </div>
                </dl>
            </div>

            <div>{toast}</div>

        </div>
        )
}