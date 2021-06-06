import React, { createContext } from 'react'
import {login} from '../api/login'

export const AuthContext = createContext(null)

export const AuthProvider = (props) =>{

    const [value, setValue] = React.useState({
        token:null,
        user:null,
    })

    const userLogin = (loginInfo)=>{
        return login(loginInfo)
    }

    const logOut = ()=>{

    }

    React.useEffect(()=>{
        
    },[])

    return (
        <AuthContext.Provider value={{value,setValue,userLogin,logOut}}>
            {props.children}
        </AuthContext.Provider>
    )

}