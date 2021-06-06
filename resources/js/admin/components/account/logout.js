import React from 'react'
import { Redirect } from 'react-router-dom'
import { AuthContext } from '../../contexts/AuthContext'

export default ()=>{

    return (
        <AuthContext.Consumer>
            {
                value=>{
                    window.sessionStorage.removeItem('token')
                    // value.setValue(null)
                    return (
                        <Redirect to='/login' />
                    )
                }
            }

        </AuthContext.Consumer>
        
    )

}