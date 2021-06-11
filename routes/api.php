<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace'=>'App\Http\Controllers\Api',],function(){

    Route::group(['middleware'=>'auth:api'],function(){

        Route::get('articles','ArticleController@index')->name('api.articles.index');
        Route::get('articles/{article}','ArticleController@show')->name('api.articles.show');
        Route::get('articles/{article}/like','ArticleController@like')->name('api.articles.like');
        Route::get('articles/{article}/comments','ArticleController@comments')->name('api.articles.comments');
        Route::post('articles/{article}/comments','ArticleController@commentStore')->name('api.articles.commentstore');
        Route::get('articles/search','ArticleController@search')->name('api.articles.search');

        Route::get('account/user_info','AccountController@user_info')->name('api.users.info');

        Route::get('category','CategoryController@index')->name('api.category.index');
        Route::get('category/{category_id}/articles','CategoryController@articles')->name('api.category.articles');
    
        Route::post('comments/{article}','CommentController@store')->name('api.comments.store');
        Route::put('comments/{comment}','CommentController@update')->name('api.comments.update');
        Route::delete('comments/{comment}','CommentController@destory')->name('api.comments.delete');

        Route::get('index','IndexController@index')->name('api.index');


    });

    Route::get('app-info','IndexController@info')->name('api.app-info');

    Route::post('feedback','FeedbackController@store')->name('api.feedbacks.store');

    Route::get('banners','BannerController@index')->name('api.banners.index');

    Route::get('login/wechat','WechatLoginController@login')->name('api.login.wechat');

});

Route::group(['namespace'=>'App\Http\Controllers\Admin','prefix'=>'admin'],function(){
    
    Route::group(['middleware'=>'auth:admin-api'],function(){
        Route::get('dashboard','DashboardController@index')->name('admin.dashboard.index');

        Route::get('articles','ArticleController@index')->name('admin.articles.index');
        Route::post('articles','ArticleController@store')->name('admin.articles.store');
        Route::get('articles/{article}','ArticleController@show')->name('admin.articles.show');
        Route::put('articles/{article}','ArticleController@update')->name('admin.articles.update');
        Route::delete('articles/{article}','ArticleController@destroy')->name('admin.articles.destroy');
        Route::get('articles/{article}/active','ArticleController@active')->name('admin.articles.active');
        Route::get('articles/{article}/comments','ArticleController@comments')->name('admin.articles.comments');

        Route::get('banners','BannerController@index')->name('admin.banners.index');
        Route::post('banners','BannerController@store')->name('admin.banners.store');
        Route::get('banners/{banner}','BannerController@show')->name('admin.banners.show');
        Route::put('banners/{banner}','BannerController@update')->name('admin.banners.update');
        Route::delete('banners/{banner}','BannerController@destroy')->name('admin.banners.destroy');
        Route::get('banners/{banner}/active','BannerController@active')->name('admin.banners.active');

        Route::get('comments','CommentController@index')->name('admin.comments.index');
        Route::get('comments/{comment}','CommentController@show')->name('admin.comments.show');
        Route::get('comments/approved','CommentController@approved')->name('admin.comments.approved');
        Route::delete('comments/{comment}','CommentController@destroy')->name('admin.comments.destroy');

        Route::get('feedbacks','FeedbackController@index')->name('admin.feedbacks.index');
        Route::get('feedbacks/{feedback}','FeedbackController@show')->name('admin.feedbacks.show');
        Route::delete('feedbacks/{feedback}','FeedbackController@destroy')->name('admin.feedbacks.destroy');
        Route::get('feedbacks/{feedback}/read','FeedbackController@destroy')->name('admin.feedbacks.destroy');

        Route::post('file/upload','FileController@store')->name('admin.files.upload');
        Route::delete('file/delete','FileController@destroy')->name('admin.files.destroy');

        Route::resource('category','CategoryController',['only'=>['index','store','show','update','destroy']])->names('admin.category');

        Route::get('users','UserController@index')->name('admin.users.index');
        Route::get('users/admins','UserController@admins')->name('admin.users.admin');
        Route::delete('users/{user}','UserController@destroy')->name('admin.users.destroy');
        Route::get('users/{user}','UserController@show')->name('admin.users.show');
        Route::post('users/{$user}/admin','UserController@createAdmin')->name('admin.users.createadmin');
        Route::delete('users/{$user}/admin','UserController@destroyAdmin')->name('admin.users.deleteadmin');

        Route::get('settings','SettingController@index')->name('api.settings.index');
        Route::post('settings','SettingController@save')->name('api.settings.update');

    });



    

    Route::get('cache-reset','CacheController@opcache_reset');

    Route::post('login',[App\Http\Controllers\Admin\Auth\LoginController::class,'login'])->name('admin.login');
    Route::get('logout',[App\Http\Controllers\Admin\Auth\LoginController::class,'logout'])->name('admin.logout');

});

Route::fallback(function(){
    return response()->json(['message' => 'Error: Page Not Found.'], 404);
});

