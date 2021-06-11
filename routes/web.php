<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return view('admin.master');
});
Route::get('/admin/{any?}', function () {
    return view('admin.master');
})->where('any', '(.*)');

Route::group(['namespace'=>'App\Http\Controllers\Home',],function(){
    Route::get('/', 'IndexController@index')->name('home.index');
    Route::get('/articles', 'ArticleController@index')->name('home.article.index');
    Route::get('/articles/{article}', 'ArticleController@show')->name('home.article.show');
    Route::post('/articles/{article}/like', 'ArticleController@like')->name('home.article.like');
    Route::get('/articles/{article}/comments', 'ArticleController@comments')->name('home.article.comments');

    Route::post('/articles/{article}/comments', 'CommentController@store')->name('home.comment.store');
    Route::put('/articles/{article}/comments/{comment}', 'CommentController@update')->name('home.comment.update');
    Route::delete('/articles/{article}/comments/{comment}', 'CommentController@destroy')->name('home.comment.delete');

    Route::get('/categories','CategoryController@index')->name('home.category.index');

    Route::get('/message','MessageController@index')->name('home.message.index');
    Route::post('/message','MessageController@store')->name('home.message.store');
    Route::get('/about','AboutController@index')->name('home.about.index');

    Route::get('/login','AuthController@index')->name('home.auth.index');
    Route::post('/login','AuthController@login')->name('home.auth.login');
    Route::get('/logout','AuthController@logout')->name('home.auth.logout');

    Route::get('wechat/login','WechatController@login')->name('home.wechat.login');
    Route::get('wechat/qrcode','WechatController@qrcode')->name('home.wechat.qrcode');
    Route::get('wechat/callback','WechatController@callback')->name('home.wechat.callback');

    // Route::post('comment/{article}','CommentController@store')->name('home.comment.store');

});

