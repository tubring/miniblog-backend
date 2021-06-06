import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route } from 'react-router-dom';
import IndexPage from './pages/IndexPage';
import LoginPage from './pages/LoginPage';
import { AuthContext, AuthProvider } from './contexts/AuthContext'

const App = props => (
    <AuthProvider>
    <BrowserRouter basename="/admin">
        <Route exact path="/login" component={LoginPage}></Route>
        <Route path="/" component={IndexPage} ></Route>
    </BrowserRouter>
    </AuthProvider>
)

if (document.getElementById('root')) {
    console.log('root');
    ReactDOM.render(<App />, document.getElementById('root'));
}