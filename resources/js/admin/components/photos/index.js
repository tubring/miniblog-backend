import React from 'react'
import {Toast, showToast }from '../common/Toast'
import Modal from '../common/Modal'

export default (props)=>{

    const [photos, setPhotos]=React.useState({})

    const [toast, setToast] = React.useState()
    const [modal, setModal] = React.useState()

    React.useEffect(()=>{
        let toast = <Toast type='danger' message='error' />
        showToast(toast,setToast)
    },[])

    const handleConfirm = ()=>{
        alert('messageConfirm')
    }

    const handleCancel = ()=>{
        //close modal
        setModal()
    }
    
    return (
        <div>
            <div className="border-b border-gray-200 border-solid w-full py-10 items-center flex justify-between">
                <h1 className="ml-20 font-bold">照片管理</h1>
                <div className="mr-10 flex text-sm">
                    <button className="bg-red-500 text-white px-4 py-2 rounded flex" onClick={
                        ()=>{
                            let modal = <Modal message={{title:'删除照片',content:'确定删除选中照片?请注意此操作不可逆！'}}  handleConfirm={handleConfirm} handleCancel={handleCancel} />
                            setModal(modal)
                        }
                    }>
                        <svg className="h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span className="hidden md:block ml-1">删除</span>
                    </button>
                    <button className="bg-red-500 text-white px-4 py-2 rounded flex ml-2" onClick={()=>{
                        let toast = <Toast type="success" message="operate successful" />
                        showToast(toast,setToast)
                    }}>
                        <svg className="h-5 w-5 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span className="hidden md:block ml-1">Toast测试</span>
                    </button>
                </div>
            </div>
            Photos
            <div id="toast">{toast}</div>
            <div id='modal'>{modal}</div>
        </div>
    )
}