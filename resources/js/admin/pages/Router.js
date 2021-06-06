import React from 'react'
import Sidebar from '../components/Sidebar'
import ContentRouter from '../components/ContentRouter'
import { AuthContext,AuthProvider } from '../contexts/AuthContext'

export default class IndexPage extends React.Component{

    constructor(props){
        super(props)
    }

    render(){
        return(
            <AuthContext.Consumer>
                {
                    value=>{
                        let token = window.sessionStorage.getItem('token')
                        if(token){
                            return (
                                <div className="flex flex-row w-full h-screen">
                                    <Sidebar />
                                    <ContentRouter />
                                </div>
                            )
                        }else{
                            <Redirect to="/login" />
                        }


                    }
                }
            
            </AuthContext.Consumer>
        )
        
    }
}
