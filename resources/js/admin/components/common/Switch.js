import React from 'react'

export default (props)=>{

    const enable = props.enable??false

    const handleSwitch = props.handleSwitch??(()=>{})

    return(
        <div className="mb-2">                
            <div className="relative select-none w-12 mr-2 leading-normal inline-block align-middle">

                <input type="checkbox" name="" id="switch" className="hidden" checked={enable} onChange={(event)=>{
                    console.log('event',event.target.checked)
                    handleSwitch(event.target.checked)
                }} />
                <label className={"block overflow-hidden cursor-pointer bg-gray-500 border border rounded-full h-6 shadow-inner" + (enable?' bg-green-500 shadow-none':'')} htmlFor="switch"><div className={"h-6 w-6 rounded-full bg-white" + (enable?' absolute right-0':'')}></div></label>
            </div>
            <label className="text-xs text-grey-dark" htmlFor="switch">{enable?'已开启':'已关闭'}</label>
        </div>
    )
}