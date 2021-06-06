import React from 'react';
import { Route } from 'react-router-dom';
import ContentHeader from './ContentHeader';
import ArticleIndex from './articles'
import ArticleDetail from './articles/detail'
import ArticleEdit from './articles/edit'
import CategoryIndex from './category'
import CategoryEdit from './category/edit'
import FeedbackIndex from './feedback'
import FeedbackDetail from './feedback/detail'
import CommentIndex from './comments'
import CommentDetail from './comments/detail'
import UserIndex from './users'
import BannerIndex from './banners'
import BannerEdit from './banners/edit'
import SettingIndex from './settings'
import Profile from './account/profile'
import Logout from './account/logout'
import PhotoIndex from './photos/index'
import DashboardIndex from './dashboard/index'

export default (props)=>(
    <div className="content w-full bg-gray-200 overflow-y-auto">
        <div className="w-full">
            <ContentHeader/>
        </div>
        <div className="bg-white m-3 rounded-md">
            
            <div>
                <Route path="/dashboard" component={DashboardIndex}></Route>

                <Route exact path="/articles" component={ArticleIndex}></Route>
                <Route path="/articles/detail/:id" component={ArticleDetail}></Route>
                <Route path="/articles/edit/:id" component={ArticleEdit}></Route>
                <Route exact path="/articles/edit" component={ArticleEdit}></Route>

                <Route exact path="/category" component={CategoryIndex}></Route>
                <Route path="/category/edit/:id" component={CategoryEdit}></Route>
                <Route exact path="/category/edit" component={CategoryEdit}></Route>

                <Route exact path="/feedback" component={FeedbackIndex}></Route>
                <Route path="/feedback/detail/:id" component={FeedbackDetail}></Route>

                <Route exact path="/comments" component={CommentIndex}></Route>
                <Route path="/comments/detail/:id" component={CommentDetail}></Route>

                <Route exact path="/users" component={UserIndex}></Route>

                <Route exact path="/photos" component={PhotoIndex}></Route>

                <Route exact path="/banners" component={BannerIndex}></Route>
                <Route path="/banners/edit/:id" component={BannerEdit}></Route>
                <Route exact path="/banners/edit" component={BannerEdit}></Route>

                <Route exact path="/settings" component={SettingIndex}></Route>
                
                <Route exact path="/profile" component={Profile} ></Route>
                <Route exact path="/logout" component={Logout} ></Route>


            </div>

        </div>
       
    </div>
)

