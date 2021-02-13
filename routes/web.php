<?php

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

//トップページ
Route::get('/', 'MicropostsController@index');    

//ユーザー登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::group(['middleware' => ['auth']], function () {
    //フォロー　アンフォロー　フォロー一覧　フォロワー一覧　お気に入り一覧
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow'); 
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');   
    });

    //ユーザー一覧の表示　ユーザー詳細で投稿を表示
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);

    //お気に入り登録　お気に入り登録を解除
    Route::group(['prefix' => 'microposts/{id}'], function () {
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    //投稿の作成　投稿の削除
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});